<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinishGoodController extends Controller
{
    public function index()
    {


        $prodno = DB::connection('sqlsrv')
            ->select("SELECT distinct prodno from schedule");

        return view('finishgood.index', compact('prodno'));
    }


    public function scanout_box(Request $request)
    {

        $nik        = $request->scan_nik;
        $packing_no = $request->packing_no;
        $boxno      = $request->box_no;
        $prodno     = $request->prodno;
        $kitLabel   = $request->kit_label;



        // GET PARAM FROM KIT LABEL
        $data = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $data);


        // STEP 1. CEK LABEL KIT DI SCAN OUT
        $cek_label = DB::connection('sqlsrv')
            ->select("SELECT * FROM scanout where kit_label ='{$kitLabel}'");

        if ($cek_label) {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'DOUBLE SCAN...'
                ]);
        }
        // END CEK LABEL SCAN


        // ambil part dari  finishgoodlist -> kondisi part apabila  part dan custpo di list = custpo  pada kit label
        $selectPart = DB::connection('sqlsrv')
            ->select("SELECT top 1 * from finishgood_list
                   where  partno = '{$partno}'
                   and custpo ='{$custpo}'
                   and demand >= (coalesce(act_running,0) + $qty)
                   order by custpo asc");
        // return $selectPart;


        if ($selectPart == true) {
            // STEP 2.INSERT INTO SCAN OUT
            DB::connection('sqlsrv')
                ->insert("INSERT into scanout(custpo,prodno,partno, partname, qty_running,kit_label,packing_no,box_no,scan_nik) 
                    SELECT  '{$custpo}','{$prodno}','{$partno}','{$partname}','{$qty}',  '{$kitLabel}','{$packing_no}','{$boxno}', '{$nik}'
                    ");

            // STEP 3.UPDATE IN FINISH GOOD LIST     
            $update =    DB::connection('sqlsrv')
                ->update("UPDATE finishgood_list 
                                 -- SET packing_no = b.packing_no   from scanout as b where
                                 -- finishgood_list.id = '{$selectPart[0]->id}',
                                 --     box_no = b.box_no   from scanout as b where
                                 -- finishgood_list.id = '{$selectPart[0]->id}',
                                     set act_running = ( select sum(qty_running )
                                     from scanout as b where 
                                 b.partno = finishgood_list.partno  and b.custpo = finishgood_list.custpo),
                                     bal_running = finishgood_list.demand - (finishgood_list.act_running + {$qty})
                                     from scanout as b  where
                                 finishgood_list.id = '{$selectPart[0]->id}' ");

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Scan success...'
                ]);
        } else {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'Part Not Match...'
                ]);
        }
    }

    public function printid_box(Request $request)
    {
        $nik        = $request->scan_nik;
        $packing_no = $request->packing_no;
        $boxno      = $request->box_no;
        $prodno     = $request->prodno;
        

        // GET PARAM CONTENT
        $param = DB::connection('sqlsrv')
            ->select("SELECT distinct dest,shipvia,vandate from schedule where prodno ='{$prodno}'");

        $param['boxno'] = $boxno;
        $param['packing_no'] = $packing_no;

        // return view('finishgood.printid', compact('packing_no', 'boxno', 'param'));
        return view('finishgood.printid',compact('param'));


        // return redirect('finishgood/printid')->with('success');
    }

    public function scanout_data(){

        $data = DB::connection('sqlsrv')
        ->select("SELECT distinct a.prodno, a.custcode,a.custpo,a.vandate, a.orderitem,a.jkeipodate, a.model, a.partno,a.partname,
                    a.dest,a.demand,a.act_running,a.bal_running,b.box_no,b.skid_no  from finishgood_list as a
                    left join scanout as b 
                    on a.partno = b.partno and a.custpo = b.custpo  order by vandate asc");

        return view('finishgood.scanoutData',compact('data'));

    }
}
