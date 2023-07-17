<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ScheduleController extends Controller
{
    public function index(){

        $data = DB::connection('sqlsrv')
                ->select ("SELECT a.* , b.stdpack, b.vendor, b.jknshelf from schedule as a
                inner  join std_pack as b 
                ON  a.partno = b.partnumber
                order by a.vandate asc");

        $data2=DB::connection('sqlsrv')
        ->select("SELECT distinct (prodno) from schedule ");

        $data3=DB::connection('sqlsrv')
        ->select("SELECT distinct (prodno) from schedule where dest !='PAKISTAN' ");

        return view('schedule.index', compact('data','data2','data3'));
    }


    public function filter(Request $request){

        $prodNo = $request->input('prodno');

        $data = DB::table('schedule')
        ->where('prodno','=',  $prodNo)
        ->get();

         return response()->json($data);
    }


    public function partlist(Request $request){


        $user = $request->input('input_user');
        $prodNo = $request->input('prodno');
        $custcode = DB::connection('sqlsrv')
        ->select("SELECT distinct custcode  from schedule where prodno ='{$prodNo}' ");

        $partlistno = $prodNo . $custcode[0]->custcode;

         DB::connection('sqlsrv')
        ->insert("INSERT into partlist(custcode, dest,model,prodno,jkeipodate,vandate,partlist_no,orderitem,
                  custpo,partno,partname, demand, stdpack,balance_issue,mcshelfno,vendor,input_user)
                  SELECT a.custcode,a.dest, a.model, a.prodno,a.jkeipodate,a.vandate,'{$partlistno}', a.orderitem,
                  a.custpo, a.partno, a.partname,  a.demand,
                  b.stdpack,a.demand, a.shelfno,b.vendor, '{$user}' from schedule as a
                  left join std_pack as b  ON a.partno = b.partnumber
                  where a.prodno ='{$prodNo}'
                  order by a.vandate desc");



        // DB::connection('sqlsrv')
        // ->select("INSERT into repacking_list(custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
        //                             partname,shelfno,demand) 
        //             select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
        //                             a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno, a.demand from schedule_temp as a
        //                             inner join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
        //             where a.dest != 'PAKISTAN'
        //             UNION ALL
        //             select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
        //                             a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno,a.demand, from schedule_temp as a 
        //                             inner join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
        //             where a.dest ='PAKISTAN'
        //             order by vandate asc ");

                  return redirect()->back()->with('success', 'Generate partlist success ');


    }

}
