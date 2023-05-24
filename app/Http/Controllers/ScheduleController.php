<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\ImportScheduleTemp;
use App\Imports\ImportSB98;
use App\Imports\ImportSA90;
use App\Exports\FormatHeaderExport;
use App\Models\ScheduleTemp;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleController extends Controller
{
  public function index(Request $request){
    $data =  DB::connection('sqlsrv')
    ->table('schedule_temp')
    ->get();

    $prodno = $request->input('prodno');

    $data2 = ScheduleTemp::where('prodno', $prodno)->get();


    
      return view('schedule.index', compact('data','data2'));
  }

  public function importCSV() 
  {
        

          // return request()->file('file');
        $data =  Excel::import(new ImportScheduleTemp, request()->file('file'));

        // dd($data);

          return redirect()->back()->with('success', 'Upload Excell Schedule Success');

  }

  public function importSB98() 
  {
      

      // return request()->file('file');
      $data =  Excel::import(new ImportSB98, request()->file('file'));



      return $data;
  }

  public function sumSB98(){
    

    $param1 = auth()->user()->name;

    try {
      $result = DB::select("EXEC insSb98sum $param1 ");
     
      if ($result) {
          return redirect()->back()->with('success', 'Stored procedure berhasil dijalankan!');
      } else {
          return redirect()->back()->with('error', 'Terjadi kesalahan saat menjalankan stored procedure.');
      }
    } 
    
    catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
    }
  }


  public function importSA90() 
  {
      

      // return request()->file('file');
      $data =  Excel::import(new ImportSA90, request()->file('file'));
      return redirect()->back()->with('oke', 'Upload SA90 Success');
  }




  public function generate(){


    $result = DB::connection('sqlsrv')
              ->select("INSERT into schedule(custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
                        partname,demand,stdpack,vendor)
                        select distinct a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                        a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,  a.demand from schedule_temp as a
                        left join tblSB98 as c ON   a.custcode = c.custcode AND a.custpo = c.custpo AND a.partno = c.partno AND a.demand = c.demand
                        order by vandate desc");


  }

  public function filter(Request $request)
    {
        $prodno = $request->input('prodno');

        $items = ScheduleTemp::where('prodno', $prodno)->get();

        return view('schedule.index', compact('items'));
    }


}
