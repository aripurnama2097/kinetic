<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Problemfound;
use Carbon\Carbon;

class KitmonitorController extends Controller
{

    public function index(){

        $data= DB::select("EXEC disp_kitmonitor ");
        return view('kitmonitoring.index',compact('data'));


        // return view ('picking.index',compact('data','get_location'))->with('i', (request()->input('page', 1) -1) * $pagination);   

    }


    public function index_COPY()
    {

        // STEP 1. JOIN SCHEDULE DAN PARTLIST
        $data = DB::connection('sqlsrv')
        ->select("SELECT  -- distinct * 
                        a.custcode,a.dest,a.model,a.prodno
                        ,sum(a.demand) as lot_qty
                        ,a.jkeipodate,a.vandate,a.etd,a.eta,a.shipvia,a.orderitem
                        ,sum(b.tot_scan) as mc_issue
                        ,sum(b.balance_issue) as balance_mc
                        ,sum(d.tot_input) as input_inhouse
                        ,sum(d.balance) as balance_inhouse		
                        ,sum(c.act_running) as kit_output
                        ,sum(c.bal_running) as balance_kit
                        ,(select count(box_no) from finishgood_list  
                            where prodno = a.prodno
                        ) as total_box
                        --,(select count(*) from (select distinct skid_no from finishgood_list where prodno = a.prodno and demand = a.demand ) as a) as total_skid
                        ,c.skid_no 
                        ,e.partno,e.symptom,f.invoice_no
                        from schedule as a
                        left join partlist as b on a.prodno = b.prodno and b.demand = a.demand
                        left join finishgood_list as c on a.prodno = c.prodno  and c.demand = a.demand
                        left join inhouse_list as d on a.prodno = d.lotno and d.shipqty = a.demand
                        left join borrow as e on a.prodno = e.prodno
                        left join tbl_invoice as f on a.prodno = f.prodno
                        --where a.prodno ='NA494'
                        group by
                        a.custcode,a.dest,a.model,a.prodno,a.jkeipodate,a.vandate,a.etd,a.eta,a.shipvia,a.orderitem,c.skid_no
                        ,e.symptom,e.prodno,e.partno,f.invoice_no ");

                        return view('kitmonitoring.index',compact('data'));
    }
   

    public function update_invoice(request $request,$prodno){

        $inv = $request->invoice;
        $pic = $request->pic;

        DB::connection('sqlsrv')
            ->insert("INSERT into tbl_invoice(prodno,invoice_no,created_by)
                    select '{$prodno}','{$inv}', '{$pic}'");
    }


    public function view_shippedout(){

        $data= DB::select("EXEC disp_kitsso"); 
        
        return view('kitmonitoring.shippout',compact('data'));
    }
}
