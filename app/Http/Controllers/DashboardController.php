<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){      

      $data =  DB::connection('sqlsrv2')
        ->table('tblPartlist')
        ->get();

        // return $data;
        return view('dashboardMenu.index', compact('data'));
    }
}
