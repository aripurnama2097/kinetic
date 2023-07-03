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
                      ->select("SELECT distinct a.id, a.custcode, a.dest,a.model,a.prodno,a.jkeipodate,a.vandate,a.partlist_no,a.orderitem,a.custpo,a.partno,a.partname,a.mcshelfno, a.demand, a.stdpack,b.scan_issue, 
                                    a.tot_scan,a.balance_issue , b.unique_id, b.label, b.idnumber
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
                                  a.tot_scan,a.balance_issue , b.unique_id, b.label, b.idnumber
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

    public function inputData(Request $request){

        $scan_nik = $request->scan_nik;
        $mcLabel = $request->mc_label;
        $kitLabel = $request->kit_label;

        // GET PARAM FROM KIT LABEL
        $label_scan = substr($mcLabel,0,11);
        $partno = substr($kitLabel, 0,11);
        $qty    = substr($kitLabel, 17,19);

        // $data = "K2K-0165-02:KNOB assy:40:JK NAGANO:9344785::2306260005";
        $data = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $data);

    
    
        // STEP 1.CEK LABEL SCAN PADA SCAN IN
        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT * FROM scanin_repacking where label_mc ='{$mcLabel}' or
                            label_kit ='{$kitLabel}'");

      
        if($cek_label){
            return response()
                ->json([
                    'success' => false,
                    'message' => 'DOUBLE SCAN...'
                ]);
        }
        // END CEK LABEL SCAN


        // ambil part dari list repacking
        $selectPart = DB::connection('sqlsrv')
        ->select("SELECT top 1 * from repacking_list
                  where  partno = '{$label_scan}'
                  and demand >= (coalesce(act_receive,0) + $qty)
                  order by custpo asc");

        // dd($selectPart);

        // STEP 2.INSERT INTO REPACKING SCAN IN
        DB::connection('sqlsrv')
        ->insert("INSERT into scanin_repacking(custpo,partno, partname, qty_receive,dest,label_mc,label_kit,scan_nik) 
                  SELECT  '{$custpo}', '{$partno}','{$partname}','{$qty}', '{$dest}', '{$mcLabel}','{$kitLabel}', '{$scan_nik}'
                ");



         // STEP 3.UPDATE IN REPACKING LIST     
     $update =    DB::connection('sqlsrv')
        ->update("UPDATE repacking_list 
                                SET act_receive = ( select sum(qty_receive )
                                    from scanin_repacking  as b where 
                                b.partno = repacking_list.partno  and b.custpo = repacking_list.custpo),
                                    bal_receive = repacking_list.demand - (repacking_list.act_receive + {$qty})
                                    from scanin_repacking as b  where
                                repacking_list.id = '{$selectPart[0]->id}' ") ;

        // return $update;

        // -- // UPDATE partlist
        // -- //                 set tot_scan = (
        // -- //                     SELECT sum(scan_issue) FROM partscan as b where
        // -- //                     b.partno = partlist.partno and b.custpo = partlist.custpo
        // -- //                 ),
        // -- //                 status_scan ='1',
        // -- //                 balance_issue = partlist.demand - (partlist.tot_scan + {$qty})
        // -- //             from partscan as b where
        // -- //             partlist.id = '{$selectPart[0]->id}'

         return response()
                ->json([
                    'success' => true,
                    'message' => 'Scan success...'
                ]);  
    
    }

    public function scanCombine(){

        return view('repacking.scanCombine');
    }


    public function kitdata(){
        $data = DB::connection('sqlsrv')
            ->select("SELECT  b.*,a.qty_receive, a.act_receive,a.bal_receive  from repacking_list as a
                    inner join partlist as b 
                    on a.partno = b.partno and a.custpo = b.custpo  order by id desc");
        
        return view('repacking.kitdata',compact('data'));
    }

}
