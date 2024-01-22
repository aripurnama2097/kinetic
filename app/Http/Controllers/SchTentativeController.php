<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\ImportScheduleTemp;
use App\Imports\ImportScheduleSkd;
use App\Imports\ImportSB98;
use App\Imports\ImportSA90;
use App\Imports\InhouseImport;
use App\Exports\FormatHeaderSchExport;
use App\Models\ScheduleTemp;
use App\Models\Schedule;
use App\Models\RepackingList;
use App\Models\FinishGoodList;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SchTentativeController extends Controller
{
  public function index(){
      $data =  [];
      $data = DB::table('schedule_temp as a')
                  ->leftJoin('tblSB98 as c', function ($join) {
                      $join->on('a.custcode', '=', 'c.cust_code')
                          ->on('a.custpo', '=', 'c.cust_po')
                          ->on('a.partno', '=', 'c.partnumber')
                          ->on('a.demand', '=', 'c.qty');
                  })
                  ->where('a.dest', '!=', 'PAKISTAN')
                  ->select('c.partnumber', 'c.qty', 'a.*')
                  ->unionAll(
                      DB::table('schedule_temp as a')
                          ->leftJoin('tblSA90 as d', function ($join) {
                              $join->on('a.model', '=', 'd.modelname')
                                  ->on('a.prodno', '=', 'd.prodNo')
                                  ->on('a.partno', '=', 'd.partnumber')
                                  ->on('a.demand', '=', 'd.qty');
                          })
                          ->where('a.dest', '=', 'PAKISTAN')
                          ->select('d.partnumber', 'd.qty', 'a.*')
                  )
                  // ->orderBy('a.vandate', 'asc')
                  ->get();
  

    return view('schedule_tentative.index',compact('data'));
  }

  public function view_tempschedule(){

      $data =  DB::table('schedule_temp')
              ->where('dest','!=','PAKISTAN')
              ->get();


      $result = ScheduleTemp::select('tblSB98.*', 'schedule_temp.*')
                ->leftJoin('tblSB98', function ($join) {
                    $join->on('schedule_temp.custcode', '=', 'tblSB98.cust_code')
                        ->on('schedule_temp.custpo', '=', 'tblSB98.cust_po');
                })
                ->where('schedule_temp.dest', '!=', 'PAKISTAN')
                ->get();

    return view('schedule_tentative.temp_masterSch',compact('data','result'));
  }

  public function skdpart(){

    $data =  DB::table('schedule_temp')
                ->where('dest','PAKISTAN')
                ->orWhere('dest','JVIC')
                ->get();

    $result = DB::table('schedule_temp as a')
                ->leftJoin('tblSA90 as c', function ($join) {
                    $join->on('a.model', '=', 'c.modelname')
                        ->on('a.prodno', '=', 'c.prodNo')
                        ->on('a.partno', '=', 'c.partnumber')
                        ->on('a.demand', '=', 'c.qty');
                })
                ->select('c.*', 'a.*')
                ->where(function ($query) {
                    $query->where('a.dest', 'PAKISTAN')
                        ->orWhere('a.dest', 'JVIC');
                })
                ->get();

    return view('schedule_tentative.skdpart',compact('data','result'));
  }

  public function import_skd( request $request){
    $req = $request->uploadby;
    $data =  Excel::import(new ImportScheduleSkd, request()->file('file'));

    // dd($data);

     DB::connection('sqlsrv')
      ->update("UPDATE schedule_temp
                SET input_user = '{$req}'
               
               ");
 
    return redirect()->back()->with('success', 'Upload Schedule Success, Please Compare result check');

  }

  public function importsch_temp(Request $request) 
  {
        
    $req = $request->uploadby;
    $data =  Excel::import(new ImportScheduleTemp, request()->file('file'));

    // dd($data);

     DB::connection('sqlsrv')
      ->update("UPDATE schedule_temp
                SET input_user = '{$req}'
               
               ");
 
    return redirect()->back()->with('success', 'Upload Schedule Success, Please Compare result check');

  }

  public function reset_mastersch(){

    DB::table('schedule_temp')
            ->where('dest','!=','PAKISTAN')
            ->where('dest','!=','JVIC')
            ->delete();

    return redirect()->back()->with('error', 'All records have been deleted.');

  }

  public function deleteskd(){
    DB::table('schedule_temp')
      ->where('dest','=','PAKISTAN')
      ->where('dest','=','JVIC')
      ->delete();

    return redirect()->back()->with('error', 'All records have been deleted.');
  }


  public function view_sb98(){

    $data = DB::table('tblSB98')
            ->get();

    return view('schedule_tentative.sb98', compact('data'));
  }


  public function importSB98(Request $request){

      DB::table('tblSB98temp')->truncate();
      DB::table('tblSB98')->truncate();

      $pic = $request->uploadby;
      // $data =  Excel::import(new ImportSB98, request()->file('file'));
      // $file = $request->file;

      Excel::import(new ImportSB98, request()->file('file'), 'public',  \Maatwebsite\Excel\Excel::CSV);

      try {
        $result = DB::select("EXEC insSb98sum $pic ");
       
        if ($result) {
          return redirect()->back()->with('success', 'Upload SB98 Schedule Success');
            return redirect()->back()->with('success', 'Stored procedure oke');
        } else {
            return redirect()->back()->with('error', 'failed store procedure.');
        }
      } 
      
      catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
      }
        
      
  return redirect()->back()->with('success', 'Upload SB98 Schedule Success');

  }

 

  public function reset_sb98(){

    DB::table('tblSB98temp')->truncate();
    DB::table('tblSB98')->truncate();

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

      return redirect()->back()->with('success', 'Upload SA90 Success');
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

  // GENERATE SCHEDULE RELEASE/ INSERT INTO REPACKING LIST OR FG LIST
  public function generateschedule(Request $request){

      // return $request;
      $pic = $request->nik;
      $prodno = $request->prodno;

      // GET SCHEDULE CODE
      $currentDate = Carbon::now();     
      $dateAsNumber = $currentDate->format('Ymd');      
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
      // END GET


      // STEP 1. CEK PRODNO PADA SCHEDULE
       $cekprodno =  DB::connection('sqlsrv')
                          ->select("SELECT distinct prodno from schedule where prodno='{$prodno}'
                                      UNION ALL
                                    SELECT distinct prodno from repacking_list where prodno='{$prodno}'
                                  
                                  ");
      Schedule::where('prodno')->select('prodno')->distinct();
      if($cekprodno == null){
            DB::connection('sqlsrv')
                    ->insert("INSERT into schedule(schcode,custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
                              partname,shelfno,demand,input_user) 
                              select	'{$uniqueNumber}', a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                              a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno, a.demand,'{$pic}' from schedule_temp as a
                                              inner join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
                              where a.dest != 'PAKISTAN'
                              and a.prodno ='{$prodno}'
                              UNION ALL
                              select	 '{$uniqueNumber}',a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                              a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno,a.demand, '{$pic}' from schedule_temp as a 
                                              inner join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
                              where a.dest ='PAKISTAN'
                              or a.dest ='JVIC'
                              and a.prodno ='{$prodno}'

                             
                              order by vandate asc ");



            DB::connection('sqlsrv')
                    ->insert("INSERT into repacking_list(custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
                                           partname,shelfno,demand,bal_receive) 
                      select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                      a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno, a.demand,a.demand from schedule_temp as a
                                      inner join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
                      where a.dest != 'PAKISTAN'
                      and a.prodno ='{$prodno}'
                      UNION ALL
                      select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                              a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno,a.demand,a.demand from schedule_temp as a 
                                              inner join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
                              where a.dest ='PAKISTAN'
                              or a.dest ='JVIC'
                              and a.prodno ='{$prodno}'
                     
                      order by vandate asc ");


  //  STEP 3.INSERT INTO FG LIST
          DB::connection('sqlsrv')
            ->insert("INSERT into finishgood_list(custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
                                          partname,shelfno,demand,bal_running) 
                      select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                      a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno, a.demand,a.demand from schedule_temp as a
                                      inner join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
                      where a.dest != 'PAKISTAN'
                      and a.prodno ='{$prodno}'
                      UNION ALL
                      select	a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                        a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,a.shelfno,a.demand,a.demand from schedule_temp as a 
                                        inner join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
                      where a.dest ='PAKISTAN'      
                      or a.dest ='JVIC'
                      and a.prodno ='{$prodno}'           
                      order by vandate asc ");
                      
                      return redirect()->back()->with('success', 'Generate schedule success');
      }

      else{

        return redirect()->back()->with('error', 'Prodno Exist Release Schedule');

      }

  }


  public function generateInhouse(request $request){

      $pic = $request->nik;
      
            // DB::connection('sqlsrv')
            //         ->insert("INSERT into inhouse_list(model,lotno,shipqty,jknpo,balance,pic_release)
            //                     select model,lotno,shipqty,jknpo,shipqty,'{$pic}' from masterinhouse"
            //                 );
        DB::table('inhouse_list')->insert(
            DB::table('masterinhouse')
                  ->select(['model', 'lotno', 'shipqty', 'jknpo', 'shipqty as balance', DB::raw("'{$pic}' as pic_release")])
                  ->get()
                  ->toArray()
            );
 
        
         DB::table('masterinhouse')->truncate(); 
                      
                      return redirect()->back()->with('success', 'Generate Inhouse success');
    
  }

  public function headersch(){
          $date = Carbon::now()->format('Y-m-d');
          $filename = 'Format_Headersch' . $date . '.csv';
     
      return Excel::download(new FormatHeaderSchExport, $filename, \Maatwebsite\Excel\Excel::CSV);
  }

  public function result(){

              $dataprodno = ScheduleTemp::distinct('prodno')
                            ->get(['prodno']);
                            
              $data  = DB::table('schedule_temp as a')
                  ->select('c.partnumber', 'c.qty', 'a.*')
                  ->join('tblSB98 as c', function ($join) {
                      $join->on('a.custcode', '=', 'c.cust_code')
                          ->on('a.custpo', '=', 'c.cust_po')
                          ->on('a.partno', '=', 'c.partnumber')
                          ->on('a.demand', '=', 'c.qty');
                  })
                  ->where('a.dest', '!=', 'PAKISTAN')
                  ->orWhere('a.dest', '=', 'JVIC');
                  // ->orderBy('a.vandate', 'asc');

              $secondResults = DB::table('schedule_temp as a')
                  ->select('d.partnumber', 'd.qty', 'a.*')
                  ->join('tblSA90 as d', function ($join) {
                      $join->on('a.model', '=', 'd.modelname')
                          ->on('a.prodno', '=', 'd.prodNo')
                          ->on('a.partno', '=', 'd.partnumber')
                          ->on('a.demand', '=', 'd.qty');
                  })
                  ->where('a.dest', '=', 'PAKISTAN')
                  ->orWhere('a.dest', '=', 'JVIC');
                // ->orderBy('a.vandate', 'asc');

            $data = $data->unionAll($secondResults)->get();
         return view('schedule_tentative.result',compact('data','dataprodno'));
  }

  public function viewstdpack(request $request){

    $prodno = $request->prodno;
    $data = ScheduleTemp::select('schedule_temp.*', 'std_pack.stdpack', 'std_pack.vendor')
                        ->leftJoin('std_pack', 'schedule_temp.partno', '=', 'std_pack.partnumber')
                        ->where('schedule_temp.prodno', '=', $prodno)
                        ->whereNull('std_pack.stdpack')
                        ->get();

    return view('schedule_tentative.check_stdpack',compact('data'));
  }

  public function deleteInhouse(){

    DB::table('masterinhouse')
        ->truncate();   
  }

  
   

}
