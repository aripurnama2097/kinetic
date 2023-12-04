<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Problemfound;
use Carbon\Carbon;
use App\Models\Invoice;

class KitmonitorController extends Controller
{
    public function index(request $request)
    {   $page = 1; 
        $pagination = 10;
        $custcode= $request->custcode;
        $prodno= $request->prodno;
        $vandate= $request->vandate;

        // STEP 1. JOIN SCHEDULE DAN PARTLIST
        $data = DB::table('schedule as a')
        ->select(
            'a.custcode', 'a.dest', 'a.model', 'a.prodno', 'a.vandate', 'a.etd', 'a.eta', 'a.shipvia', 'a.orderitem',
            DB::raw('(select count(tot_scan) from partlist where a.prodno = prodno and tot_scan = demand) as mc_issue'),
            DB::raw('(a.orderitem - (select count(balance_issue) from partlist where a.prodno = prodno and balance_issue = 0)) as bal_mc'),
            DB::raw('(select count(act_receive) from repacking_list where a.prodno = prodno and act_receive = demand) as kit_output'),
            DB::raw('(a.orderitem - (select count(bal_receive) from repacking_list where a.prodno = prodno and bal_receive = 0)) as bal_kit'),
            DB::raw('(select count(act_running) from finishgood_list where a.prodno = prodno and act_running = demand) as fg_output'),
            DB::raw('(a.orderitem - (select count(bal_running) from finishgood_list where a.prodno = prodno and bal_running = 0)) as bal_fg'),
            DB::raw('(select count(box_no) from scanout where prodno = a.prodno) as total_box'),
            DB::raw('(select COUNT(DISTINCT skid_no) FROM scanout where prodno = a.prodno) as total_skid'),
            'e.partno', 'e.symptom', 'f.invoice_no'
        )
            ->leftJoin('partlist as b', function ($join) {
                $join->on('a.prodno', '=', 'b.prodno')->on('b.demand', '=', 'a.demand');
            })
            ->leftJoin('finishgood_list as c', function ($join) {
                $join->on('a.prodno', '=', 'c.prodno')->on('c.demand', '=', 'a.demand');
            })
            ->leftJoin('inhouse_list as d', function ($join) {
                $join->on('a.prodno', '=', 'd.lotno')->on('d.shipqty', '=', 'a.demand');
            })
            ->leftJoin('borrow as e', 'a.prodno', '=', 'e.prodno')
            ->leftJoin('tbl_invoice as f', 'a.prodno', '=', 'f.prodno')
            ->whereNull('f.invoice_no')
            ->groupBy('a.custcode', 'a.dest', 'a.model', 'a.prodno', 'a.vandate', 'a.etd', 'a.eta', 'a.shipvia', 'a.orderitem', 'b.prodno', 'e.symptom', 'e.prodno', 'e.partno', 'f.invoice_no')
            ->orderByDesc('a.vandate')
            ->get();
   

        return view ('kitmonitoring.index',compact('data'));
                                        
                //                         )->with('i', (request()->input('page', 1) -1) * $pagination
                // );
    }
   

    public function update_invoice(request $request,$prodno){

        $inv = $request->invoice;
        $pic = $request->pic;

        $invoice = new Invoice([
            'prodno' => $prodno,
            'invoice_no' => $inv,
            'created_by' => $pic,
        ]);
        
        $invoice->save();

        return redirect()->back()->with('success', 'Update Invoice Success');
    }


    public function view_shippedout(){

        $data= DB::select("EXEC disp_kitsso"); 
        
        return view('kitmonitoring.shippout',compact('data'));
    }
}
