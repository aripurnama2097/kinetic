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
           ");
  

    return view('schedule_tentative.index',compact('data'));
  }

  public function importCSV(Request $request) 
  {
        
    $files = $request->file();

    foreach ($files as $value => $file) {
        $file->store('uploads'); // Menyimpan file pada direktori 'storage/app/uploads'
    }

    return redirect()->back()->with('success', 'File berhasil diunggah.');

  }


  public function importSB98(Request $request) 
  {
      
      // $file = $request->input('file');
      // return request()->file('file');
      $data =  Excel::import(new ImportSB98, request()->file('file'));

    

    // if ($validator->fails()) {
      
    //     return redirect()->back()->withErrors($validator->errors());
    // }

      // return $data;


    //     $validator = Validator::make($request->all(), [
    //       'file' => 'required|mimes:xls,xlsx,csv,tsv'
    //   ]);

    // if ($validator->fails()) {
    //     // Tangani jika validasi gagal
    //     return redirect()->back()->withErrors($validator->errors());
    // }
  }


  public function importSA90() 
  {
      

      // return request()->file('file');
      $data =  Excel::import(new ImportSA90, request()->file('file'));
      return redirect()->back()->with('oke', 'Upload SA90 Success');
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

      // ->max('created_at');    
      // Jika tidak ada file yang diupload pada tanggal saat ini, set urutan menjadi 1
      // Jika ada file yang diupload pada tanggal saat ini, tambahkan 1 pada urutan terakhir

      $order = $lastOrder ? $lastOrder + 1 : 1;
      
      // Generate unique number berdasarkan tanggal dan urutan
      $uniqueNumber = $dateAsNumber . str_pad($order, 5, '0', STR_PAD_LEFT);
      
      $result = DB::connection('sqlsrv')
                ->select("INSERT into schedule(schcode,custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
                partname,demand,input_user) 
                select	'{$uniqueNumber}', a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,  a.demand,'{$user}' from schedule_temp as a
                                left join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
                where a.dest != 'PAKISTAN'
                UNION ALL
                select	 '{$uniqueNumber}',a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
                                a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,  a.demand, '{$user}' from schedule_temp as a 
                                left join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
                where a.dest ='PAKISTAN'
                order by vandate asc ");
    }



      //     SELECT c.partnumber, c.qty, a.*  FROM schedule_temp as a
      //   left join tblSB98 as c ON    a.custcode = c.cust_code AND a.custpo = c.cust_po AND  a.partno = c.partnumber AND a.demand = c.qty
      //   where a.dest != 'PAKISTAN'
      //   UNION ALL
      // SELECT	d.partnumber, d.qty,a.*  FROM schedule_temp as a
      //   left join tblSA90 as d ON    a.model = d.modelname  AND a.prodno = d.prodNo  AND a.partno = d.partnumber AND  a.demand = d.qty
      //   where a.dest ='PAKISTAN'
    
  


   

}
