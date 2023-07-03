<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RepackingController extends Controller
{
    public function index(){

            $data = DB::table('partlist')
            ->get();
          
        //    -> latest()->paginate(10);

        return view('repacking.index', compact('data'));
    }



    // public function printOriginal(Request $request, $id){

    //     $nik = $request->sorting_by;
    //     $id = $request->id;
    //     $raw_nik = substr($nik, 2,5);
    //     $currentDate = Carbon::now();     

    //     // Mendapatkan format tanggal sebagai angka
    //     $dateAsNumber = $currentDate->format('Ymd'); 
        
    //     $date = substr($dateAsNumber,2,8);

        
    //     $get_id = DB::table('log_print_kit_original')
    //                 ->whereDate('created_at',$currentDate)
    //                 ->max('id');
  



    //     $order = $get_id ? $get_id + 1 : 1;
      
    //        // Generate unique number berdasarkan tanggal dan urutan
    //     $idnumber = $date . str_pad($order, 4, '0', STR_PAD_LEFT);

    //     // dd($idnumber);

    //     // STEP 1. INSERT TO PRINT LOG
    //     DB::connection('sqlsrv')
    //                         ->insert(" INSERT 
    //                                         into log_print_kit_original (idnumber,partno,partname,tot_scan,dest,custpo,shelfno,  prodno, balance_issue)
    //                                    SELECT 	'{$idnumber}',a.partno, a.partname, a.tot_scan, a.dest, a.custpo, a.mcshelfno,  a.prodno,a.balance_issue
    //                                         from	partlist as a                                 
    //                                     where 	id = '{$id}' ");

    //     // STEP 2. AMBIL PARAMETER LABEL QR
    //     $param = DB::connection('sqlsrv')
    //                         ->select(" SELECT 	partno, partname, tot_scan, dest, custpo, mcshelfno,  prodno,balance_issue,stdpack
    //                                         from	partlist                                 
    //                                     where 	id = '{$id}' ");


    //  // STEP 3. UPDATE STATUS PRINT
    //     $update_status = DB::connection('sqlsrv')
    //                         -> update("UPDATE partlist set status_print = 2
    //                                     where id ='{$id}' ");


    //      return view('repacking.original', compact('param','idnumber'));
      
    // }

    public function startPrint(Request $request){


      
        return view('repacking.startPrint');

    }


    public function printlbl_kit(Request $request){


        $scan_nik = $request ->scan_nik;
        $scan_label = $request->scan_label;

        //PARAM LABEL
        $label_scan = substr($scan_label,0,11);
        $qty = substr($scan_label, 24,5);
        $unique = substr($scan_label,28,49);




         // STEP 2. AMBIL PARAMETER LABEL QR
        $param = DB::connection('sqlsrv')
                      ->select("SELECT distinct a.id, a.custcode, a.dest,a.model,a.prodno,a.jkeipodate,a.vandate,a.partlist_no,a.orderitem,a.custpo,a.partno,a.partname,a.mcshelfno, a.demand, a.stdpack,b.scan_issue, a.tot_scan,a.balance_issue , b.unique_id, b.label
                                        from partlist as a
                                inner join partscan as b on a.partno = b.partno and a.demand = b.demand                              
                                where 	b.label = '{$scan_label}' ");
        
        // GET PARAM BASE SCAN LABEL
        $partlist   =   $param[0]->partlist_no;           
        $partno     =   $param[0]->partno;
        $custpo     =   $param[0]->custpo ;


        $param2 = DB::connection('sqlsrv')
                        ->select("SELECT distinct a.id,a.custcode, a.dest,a.model,a.prodno,a.jkeipodate,a.vandate,a.partlist_no,
                                  a.orderitem,a.custpo,a.partno,a.partname,a.mcshelfno, a.demand, a.stdpack,b.scan_issue, 
                                  a.tot_scan,a.balance_issue , b.unique_id, b.label
                                            from partlist as a
                                  inner join partscan as b on a.partno = b.partno and a.demand = b.demand                                  
                                  where 	 a.custpo ='{$custpo}' and a.partno ='{$partno}'");
        

        $currentDate = Carbon::now();     
        $dateAsNumber = $currentDate->format('Ymd');    
        $date = substr($dateAsNumber,2,8);

        
        $get_id = DB::table('log_print_kit_original')
                    ->whereDate('created_at',$currentDate)
                    ->max('id');
  
        $order = $get_id ? $get_id + 1 : 1;
      
           // Generate unique number berdasarkan tanggal dan urutan
        $idnumber = $date . str_pad($order, 4, '0', STR_PAD_LEFT);



        // STEP 1. INSERT TO PRINT LOG
        // DB::connection('sqlsrv')
        //                     ->insert(" INSERT 
        //                                     into log_print_kit_original (idnumber,partno,partname,tot_scan,dest,custpo,shelfno,  prodno, balance_issue)
        //                                SELECT 	'{$idnumber}',a.partno, a.partname, a.tot_scan, a.dest, a.custpo, a.mcshelfno,  a.prodno,a.balance_issue
        //                                     from	partlist as a                                 
        //                                 where 	id = '{$id}' ");

    
        return view('repacking.original', compact('param2','idnumber'));
    

    }


    public function logPrintOrg(){

        $data = DB::table('log_print_kit_original')
        ->get();

        return view('repacking.logprintOrg', compact('data'));
    }

    public function scanIn(){

        return view('repacking.scanin');
    }

    public function scanCombine(){

        return view('repacking.scanCombine');
    }
}
