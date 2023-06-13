<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchskdNGController extends Controller
{
    public function index(){
    
    
        $data = DB::connection('sqlsrv')
                    ->select(" SELECT	d.*,a.* from schedule_temp as a
                                left join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
                                where dest ='PAKISTAN'
                                order by d.modelname asc
                    ");
     return view('schedule_tentative.skdPart', compact('data'));
    }
}
