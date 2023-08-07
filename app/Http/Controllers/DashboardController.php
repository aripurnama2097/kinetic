<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){      

      $data = DB::connection('sqlsrv')
      ->select("SELECT  b.*, a.act_receive,a.bal_receive  from repacking_list as a
              inner join partlist as b 
              on a.partno = b.partno and a.custpo = b.custpo  order by id desc");

     
                    
         $problem = DB::table('problemfound')
                    ->where('status','=','waiting')->count('status');

         $dataproblem = DB::connection('sqlsrv')
                    ->select("SELECT a.*, b.* from problemfound as b
                                inner join finishgood_list as a on a.partno = b.part_no and a.custpo = b.cust_po");


        $databorrow = DB::connection('sqlsrv')
        ->select("SELECT * from  borrow");
        
         $borrow = DB::table('borrow')
                    ->count('custpo');
                
                    

                    // return $problem;
      
        
        return view('dashboardMenu.index',
                    compact('data','problem','borrow','dataproblem','databorrow'));
    }
}
