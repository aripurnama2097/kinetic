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

                    // return $problem;
      
        
        return view('dashboardMenu.index',compact('data','problem'));
    }
}
