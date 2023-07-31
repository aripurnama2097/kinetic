<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Problemfound;
use Carbon\Carbon;

class KitmonitorController extends Controller
{

    public function index(){

        $data = DB::connection('sqlsrv')
        ->select("SELECT  
                        a.custcode,a.dest,a.model,a.prodno
                        ,sum(a.demand) as lot_qty
                        ,a.jkeipodate,a.vandate,a.etd,a.eta,a.shipvia,a.orderitem
                        ,(select count(tot_scan) from partlist 
                                where a.prodno = prodno  and tot_scan = demand
                        ) as mc_issue
                        ,a.orderitem - (select count(balance_issue) from partlist
                                where a.prodno = prodno  and balance_issue = 0
                        ) as bal_mc

                        ,(select count(tot_input) from inhouse_list
                                where a.prodno = lotno  and tot_input = shipqty
                        ) as inhouse_output
                        ,a.orderitem - (select count(balance) from inhouse_list
                                where a.prodno = lotno  and balance = 0
                        ) as bal_inhouse


                        ,(select count(act_running) from finishgood_list 
                                where a.prodno = prodno  and act_running = demand
                        ) as kit_output
                        ,a.orderitem - (select count(bal_running) from finishgood_list
                                where a.prodno = prodno  and bal_running = 0
                        ) as bal_kit
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
                            left join test_scan as f on a.prodno = f.prodno
                        group by
                            a.custcode,a.dest,a.model,a.prodno,a.jkeipodate,a.vandate,a.etd,a.eta,a.shipvia,a.orderitem,c.skid_no
                            ,e.symptom,e.prodno,e.partno,f.invoice_no,b.prodno
                        order by max(a.vandate) ");



        return view('kitmonitoring.index',compact('data'));

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
                        left join test_scan as f on a.prodno = f.prodno
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
            ->insert("INSERT into test_scan(prodno,invoice_no,created_by)
                    select '{$prodno}','{$inv}', '{$pic}'");
    }
}
