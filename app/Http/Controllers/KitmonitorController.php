<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Problemfound;
use Carbon\Carbon;

class KitmonitorController extends Controller
{
    public function index()
    {
        $data = DB::connection('sqlsrv')
        ->select("SELECT a.*, b.* from problemfound as b
                    inner join finishgood_list as a on a.partno = b.part_no and a.custpo = b.cust_po");

        return view('kitmonitoring.index',compact('data'));
    }
}
