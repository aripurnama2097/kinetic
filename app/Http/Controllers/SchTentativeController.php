<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\ImportScheduleTemp;
use App\Imports\ImportSB98;
use App\Imports\ImportSA90;
use App\Imports\InhouseImport;
use App\Exports\FormatHeaderSchExport;
use App\Models\ScheduleTemp;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SchTentativeController extends Controller
{
  public function index(){
    $data =  [];


     $data = DB::connection('sqlsrv')
   ->select("SELECT c.partnumber, c.qty, a.*  FROM schedule_temp as a
                left join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
                where a.dest != 'PAKISTAN'
                   UNION ALL
             SELECT	d.partnumber, d.qty,a.*  FROM schedule_temp as a
                left join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
                where a.dest ='PAKISTAN'

                order by a.vandate asc
           ");
  

    return view('schedule_tentative.index',compact('data'));
  }

  public function view_tempschedule(){

   $data =  DB::table('schedule_temp')
    ->get();

    return view('schedule_tentative.temp_masterSch',compact('data'));
  }

  public function importsch_temp(Request $request) 
  {
        
   
    $data =  Excel::import(new ImportScheduleTemp, request()->file('file'));
 
    return redirect()->back()->with('success', 'Upload Excell Schedule Success');

  }

  public function reset_mastersch(){

    DB::table('schedule_temp')->truncate();

    return redirect()->back()->with('delete', 'All records have been deleted.');

  }


  public function view_sb98(){

    $data = DB::table('tblSB98')
            ->get();

    return view('schedule_tentative.sb98', compact('data'));
  }


  public function importSB98(Request $request){
    $pic = $request->uploadby;

      $data =  Excel::import(new ImportSB98, request()->file('file'));

        return redirect()->back()->with('success', 'Upload Excell Schedule Success');

  }

  public function sumSB98(){
    

    $param1 = auth()->user()->name;

    try {
      $result = DB::select("EXEC insSb98sum $param1 ");
     
      if ($result) {
          return redirect()->back()->with('success', 'Stored procedure oke');
      } else {
          return redirect()->back()->with('error', 'failed store procedure.');
      }
    } 
    
    catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
    }
  }

  public function reset_sb98(){

    DB::table('tblSB98')->truncate();
    DB::table('tblSB98temp')->truncate();

    return redirect()->back()->with('delete', 'All records have been deleted.');

  }


  public function view_sa90(){

    $data = DB::table('tblsa90')
            ->get();

    return view('schedule_tentative.sa90', compact('data'));
  }


  public function importSA90(Request $request) 
  {
      $pic = $request->uploadby;
    
      $data =  Excel::import(new ImportSA90, request()->file('file'));

    //  $update =  DB::connection('sqlsrv')
    //   ->insert("INSERT INTO schedule_temp(input_user) select '{$pic}' 
    //            '");

    //   return $update;

      return redirect()->back()->with('oke', 'Upload SA90 Success');
  }

  public function view_inhouse(){
    $data = DB::table('masterinhouse')
    ->get();

   return view('schedule_tentative.inhouse', compact('data'));
  }

  public function import_Inhouse(Request $request){
    $data =  Excel::import(new InhouseImport, request()->file('file'));

     return redirect()->back()->with('oke', 'Upload file Success');
  }

















  public function filter(Request $request)
    {
        $filter = $request->input('filter');

        $data2 = ScheduleTemp::where('filter', $filter)->get();

        return view('schedule.table', compact('data2'));
    }














  public function SKDall(){  //SKD -OK

    $data = DB::connection('sqlsrv')
    ->select("SELECT	d.*,a.* from schedule_temp as a
              inner join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
              where a.model is not null
              order by a.vandate asc
      ");
     return view('schedule_tentative.index', compact('data'));
  
  }

  public function SKDmodel(){ //SKD - NG

   
    $data = DB::connection('sqlsrv')
    ->select("SELECT	d.*,a.* from schedule_temp as a
            right join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
            where a.model is null
            order by d.modelname asc
      ");
     return view('schedule_tentative.index', compact('data'));
  }


  public function serviceNG(){ //SERVICE - NG

   
    $data = DB::connection('sqlsrv')
    ->select("SELECT c.*,a.* FROM schedule_temp as a
              left join tblSB98 as c ON    a.custcode = c.custcode AND a.custpo = c.custpo 
              AND  a.partno = c.partnumber AND a.demand = c.qty
              order by a.vandate desc
      ");

      return view('schedule_tentative.serviceNG', compact('data'));
  
    }



    public function serviceOK(){ //SERVICE OK

      $data = DB::connection("sqlsrv")
      ->select("SELECT c.*, a.* from schedule_temp as a
                inner join tblSB98 as c ON    a.custcode = c.custcode AND a.custpo = c.custpo AND  a.partno = c.partnumber AND a.demand = c.qty
                order by a.vandate desc
             ");

            //  echo "Schedule Service Oke";
   
       return view('schedule_tentative.index', compact('data'));
    }

  

    // GENERATE SCHEDULE RELEASE/ INSERT INTO REPACKING LIST OR FG LIST
    public function generate(){

      $user = auth()->user()->name;

      $currentDate = Carbon::now();     
      // Mendapatkan format tanggal sebagai angka
      $dateAsNumber = $currentDate->format('Ymd');      
      // Mendapatkan urutan terakhir dari file yang diupload pada tanggal saat ini
      $sub = DB::table('schedule')
      ->select('schcode')
      ->get();

      $substring = substr($sub,12);

      $lastOrder = DB::table('schedule')
      ->whereDate('created_at',$currentDate)
      ->max('id');

      $order = $lastOrder ? $lastOrder + 1 : 1;
      
      // Generate unique number berdasarkan tanggal dan urutan
      $uniqueNumber = $dateAsNumber . str_pad($order, 5, '0', STR_PAD_LEFT);
      
            DB::connection('sqlsrv')
                ->insert("INSERT into schedule(schcode,custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
                          partname,shelfno,demand,input_user) 
                          select	'{$uniqueNumber}', a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                          a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno, a.demand,'{$user}' from schedule_temp as a
                                          inner join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
                          where a.dest != 'PAKISTAN'
                          UNION ALL
                          select	 '{$uniqueNumber}',a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                          a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno,a.demand, '{$user}' from schedule_temp as a 
                                          inner join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
                          where a.dest ='PAKISTAN'
                          order by vandate asc ");




            // INSERT INTO REPACKING LIST
            DB::connection('sqlsrv')
            ->insert("INSERT into repacking_list(custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
                                           partname,shelfno,demand) 
                      select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                      a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno, a.demand from schedule_temp as a
                                      inner join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
                      where a.dest != 'PAKISTAN'
                      UNION ALL
                      select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                      a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno,a.demand from schedule_temp as a 
                                      inner join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
                      where a.dest ='PAKISTAN'
                      order by vandate asc ");

                      
          //  INSERT INTO FG LIST
          // DB::connection('sqlsrv')
          //   ->insert("INSERT into finishgood_list(custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
          //                                 partname,shelfno,demand) 
          //             select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
          //                             a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno, a.demand from schedule_temp as a
          //                             inner join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
          //             where a.dest != 'PAKISTAN'
          //             UNION ALL
          //             select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
          //                             a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno,a.demand, from schedule_temp as a 
          //                             inner join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
          //             where a.dest ='PAKISTAN'
          //             order by vandate asc ");

        return redirect()->back()->with('success', 'Generate schedule success');

    }

    public function headersch(){
          $date = Carbon::now()->format('Y-m-d');
          $filename = 'Format_Headersch' . $date . '.csv';
     
      return Excel::download(new FormatHeaderSchExport, $filename, \Maatwebsite\Excel\Excel::CSV);
    }


  
   

}
