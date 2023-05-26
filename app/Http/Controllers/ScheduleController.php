<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ScheduleController extends Controller
{
    public function index(){

        $data = DB::table('schedule')
        ->get();

        $data2=DB::connection('sqlsrv')
        ->select("SELECT distinct (prodno)from schedule ");

        return view('schedule.index', compact('data','data2'));
    }
}
