<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ScheduleController extends Controller
{
    public function index(){

        $data = DB::table('schedule')
      
        ->orderByRaw('id', 'ASC')
        ->get();

        $data2=DB::connection('sqlsrv')
        ->select("SELECT distinct (prodno) from schedule ");

        $data3=DB::connection('sqlsrv')
        ->select("SELECT distinct (prodno) from schedule where dest !='PAKISTAN' ");
        // return $data;

        return view('schedule.index', compact('data','data2','data3'));
    }


    public function filter(Request $request){

        // return $request;

        $prodNo = $request->input('prodno');
        
        $data = DB::table('schedule')
        ->where('prodno','=',  $prodNo)    
        ->get();




         return response()->json($data);
    }


    public function partlist(Request $request){


        // return $request;

        $user = $request->input('input_user');
        $prodNo = $request->input('prodno');
        
        // $data = DB::table('schedule')
        // ->where('prodno','=',  $prodNo)    
        // ->get();

        $parlist = DB::connection('sqlsrv')
        ->select("INSERT into tblpartlist(custcode, dest,model,prodno,vandate,orderitem,
                  custpo,partno,partname, demand, stdpack,vendor,input_user)
                  SELECT a.custcode,a.dest, a.model, a.prodno,a.vandate, a.orderitem, 
                  a.custpo, a.partno, a.partname,  a.demand,
                  b.stdpack, b.vendor, '{$user}' from schedule as a 
                  left join std_pack as b  ON a.partno = b.partnumber    
                  where a.prodno ='{$prodNo}'                 
                  order by a.vandate desc");
                  
                  return redirect()->back()->with('success', 'success generate');
    }

}