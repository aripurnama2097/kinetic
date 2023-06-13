<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchServiceNGController extends Controller
{
    

    public function index(){

        $data = DB::connection('sqlsrv')
                    ->select("SELECT c.*,a.* FROM schedule_temp as a
                                left join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
                                where a.dest != 'PAKISTAN'
                                order by a.vandate asc 
                    ");

        return view('schedule_tentative.servicePart', compact('data'));
    }
}
