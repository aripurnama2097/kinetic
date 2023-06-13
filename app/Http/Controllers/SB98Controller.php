<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblSB98;
use Yajra\DataTables\DataTables;

class SB98Controller extends Controller
{
    public function index(){


        


        if (request()->ajax()) {
            $data = TblSB98::query();
            return DataTables::of($data)
            ->addIndexColumn()

                ->make(true);
        }
        return view('/schedule_tentative.SB98');
        
   
    }
}
