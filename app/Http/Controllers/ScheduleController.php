<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\ImportScheduleTemp;
use App\Imports\ImportSB98;
use App\Exports\FormatHeaderExport;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleController extends Controller
{
  public function index(){
    $data =  DB::connection('sqlsrv')
    ->table('schedule_temp')
    ->get();

    

    
      return view('schedule.index', compact('data'));
  }

  public function importCSV(Request $request) 
  {
        

          // return request()->file('file');
        $data =  Excel::import(new ImportScheduleTemp, request()->file('file'));

        // dd($data);

          return redirect()->back()->with('success', 'Upload Master Alteration Success');

  }

  public function importSB98(Request $request) 
  {
      

      // return request()->file('file');
      $data =  Excel::import(new ImportSB98, request()->file('file'));



      return $data;
  }
}
