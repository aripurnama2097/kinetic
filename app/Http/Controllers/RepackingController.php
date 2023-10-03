<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\LogPrintKit;
class RepackingController extends Controller
{
    public function index(){

            $assy = DB::table('inhouse_scanin')
                        ->where('model',"!=",NULL)
            ->get();

            $data = DB::table('partlist')
            ->get();

        //    -> latest()->paginate(10);

        return view('repacking.index', compact('data','assy'));
    }

    public function view(){
        $assy = DB::table('inhouse_scanin')
        ->where('model',"!=",NULL)
                ->get();
        return view('repacking.view',compact('assy'));
    }





    public function startPrint(Request $request){



        return view('repacking.startPrint');

    }

     // PROCESS PRINT LABEL KIT
     public function printlbl_kit(Request $request){

        $scan_nik = $request ->scan_nik;
        $scan_label = $request->scan_label;

        //PARAM LABEL
        $label_scan = substr($scan_label,0,15);
        $qty = substr($scan_label, 24,5);
        $unique = substr($scan_label,28,49);

        // STEP 1. CEK STATUS PRINT PADA PART

        $cek_status = DB::connection('sqlsrv')
                        ->select(" SELECT * FROM  partscan
                                    where label = '{$scan_label}'
                                  ");

       
        if (!$cek_status ){
            echo "<p style =font-size:20px;font-weight:bold;text-color:red > Part Before Scan, MC Issue</p>";
        }


        else if($cek_status[0]->after_print == 1 ){
            echo "<p style =font-size:20px;font-weight:bold;text-color:red > Label After Print, Please Check Log Print !</p>";
        }


        else if($cek_status == TRUE  ){
          
                        // GET PARAM BASE SCAN LABEL
                        $partlist   =   $cek_status[0]->partlist_no;
                        $partno     =   $cek_status[0]->partno;
                        $prodno     =   $cek_status[0]->prodno ;


                        //STEP 2. SEND DATA UNTUK CONTENT PRINT LABEL SELAIN STATUS CONTINUE
                        $param2 = DB::connection('sqlsrv')
                        ->select("SELECT * from partscan 
                                    where 	 prodno ='{$prodno}' 
                                    and partno ='{$partno}' 
                                    and after_print is null
                                    and ( status_print is null or status_print='loosecarton')
                                ");

                            if($param2 == TRUE){
                                
                                        // STEP 3. INSERT TO PRINT LOG
                                    $logPrint = DB::connection('sqlsrv')
                                        ->insert(" INSERT
                                                        into log_print_kit_original (idnumber,partno,partname,qty_scan,dest,custpo,shelfno,  prodno)
                                                        SELECT distinct
                                                        idnumber,partno,partname,scan_issue,dest,custpo,shelfno, prodno
                                                                    from partscan 
                                                        where 	 prodno ='{$prodno}' 
                                                        and partno ='{$partno}'  
                                                        and after_print is null
                                                        and ( status_print is null or status_print='loosecarton')
                                                    ");

                                    

                                    // STEP 4. UPDATE COLUMN AFTER PRINT DI PARTSCAN/ PELRIU DI IMPROVE
                                    $update = DB::connection('sqlsrv')
                                        ->update("UPDATE partscan  set after_print = 1 
                                                    where partno ='{$partno}'
                                                    and prodno ='{$prodno}'    
                                                    and after_print is null
                                                    and (status_print is null or status_print='loosecarton')
                                        ");

                                    return view('repacking.original', compact('param2'));

                            }

                            else{
                                echo "<p style =font-size:20px;font-weight:bold;text-color:red > Error! Loading Content Print Label/p>";

                            }           
        }
    }


    // PROCESS PRINT LABEL KIT
    public function printlbl_kitbackup(Request $request){

        $scan_nik = $request ->scan_nik;
        $scan_label = $request->scan_label;

        //PARAM LABEL
        $label_scan = substr($scan_label,0,15);
        $qty = substr($scan_label, 24,5);
        $unique = substr($scan_label,28,49);

        // STEP 1. CEK STATUS PRINT PADA PART

        $cek_status = DB::connection('sqlsrv')
                        ->select(" SELECT * FROM  partscan
                                    where partno = '{$label_scan}'
                                    and after_print is null
                                    and ( status_print is null or status_print ='loosecarton')
                                  ");

        if(!$cek_status ){
            echo "<p style =font-size:20px;font-weight:bold;text-color:red > Label After Print, Please Check Log Print !</p>";
        }

        if($cek_status == TRUE  ){
            // STEP 2. AMBIL PARAMETER LABEL QR dari partlist
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


            //STEP 2. SEND DATA UNTUK CONTENT PRINT LABEL SELAIN STATUS CONTINUE
            $param2 = DB::connection('sqlsrv')
            ->select("SELECT distinct a.id,a.custcode, a.dest,a.model,a.prodno,a.jkeipodate,a.vandate,a.partlist_no,
                        a.orderitem,a.custpo,a.partno,a.partname,a.mcshelfno, a.demand, a.stdpack,b.scan_issue,
                        a.tot_scan,a.balance_issue , b.unique_id, b.label, b.idnumber
                                from partlist as a
                        inner join partscan as b on a.partno = b.partno and a.demand = b.demand
                        where 	 a.custpo ='{$custpo}' 
                        and a.partno ='{$partno}' 
                        and b.after_print is null
                        and ( b.status_print is null or b.status_print='loosecarton')
                    ");


            // STEP 3. INSERT TO PRINT LOG
            $logPrint = DB::connection('sqlsrv')
                ->insert(" INSERT
                               into log_print_kit_original (idnumber,partno,partname,qty_scan,dest,custpo,shelfno,  prodno)
                                SELECT distinct
                                b.idnumber,a.partno,a.partname,  b.scan_issue,a.dest,a.custpo,a.mcshelfno, a.prodno
                                            from partlist as a
                                inner join partscan as b on a.partno = b.partno and a.demand = b.demand
                                where 	 a.custpo ='{$custpo}' 
                                and a.partno ='{$partno}'  
                                and b.after_print is null
                                and ( b.status_print is null or b.status_print='loosecarton')
                            ");

            

            // STEP 4. UPDATE COLUMN AFTER PRINT DI PARTSCAN
            $update = DB::connection('sqlsrv')
                ->update("UPDATE partscan  set after_print = 1 
                            where partno ='{$partno}'   
                            and after_print is null
                            and (status_print is null or status_print='loosecarton')
                ");

            return view('repacking.original', compact('param2'));
        }
  

    }

    public function printlbl_kitcombine(Request $request){

        $scan_nik = $request ->scan_nik;
        $scan_label = $request->scan_label_mc;

        //PARAM LABEL
        $label_scan = substr($scan_label,0,15);
        $qty = substr($scan_label, 24,5);
        $unique = substr($scan_label,28,49);

        // STEP 1. CEK STATUS PRINT PADA PART

        
            // STEP 1. AMBIL PARAMETER LABEL QR
            $content = DB::connection('sqlsrv')
                            ->select("SELECT * FROM  partscan
                                        where label = '{$scan_label}'
                                   ");
            if (!$content){
                echo "<p style =font-size:20px;font-weight:bold;text-color:red > Part Before Scan, MC Issue</p>";
            }


            else if($content[0]->after_print == 1 ){
                echo "<p style =font-size:20px;font-weight:bold;text-color:red > Label After Print, Please Check Log Print !</p>";
            }


            else if($content == TRUE  ){
            // GET content BASE SCAN LABEL
            $partlist   =   $content[0]->partlist_no;
            $partno     =   $content[0]->partno;
            $prodno    =   $content[0]->prodno;

            $getid = DB::connection('sqlsrv')
                            ->select("SELECT idnumber from partscan where label = '{$scan_label}'");

            //STEP 2. SEND DATA UNTUK CONTENT PRINT LABEL
            $content2 = DB::connection('sqlsrv')
            ->select("	SELECT 
                          unique_continue,partno,partname,custpo, sum(scan_issue) as scan_issue,dest,prodno,shelfno,after_print,idnumber
                                 from
                        partscan
                                where 	prodno ='{$prodno}'
                                and partno ='{$partno}'
                                and after_print is null
                                and unique_continue is not null
                                and status_print <> 'loosecarton'
                    group by partno,partname,custpo,dest,prodno,shelfno,unique_continue,after_print,idnumber
            ");


            // STEP 3. INSERT TO PRINT LOG
             $logPrint = DB::connection('sqlsrv')
                ->insert(" INSERT
                                into log_print_kit_original (unique_continue,partno,partname,qty_scan,dest,custpo,shelfno, prodno,idnumber)
                                SELECT 
                                        unique_continue,partno,partname, sum(scan_issue) as scan_issue,dest,custpo,shelfno,prodno,idnumber
                                                from
                                        partscan
                                                where 	prodno ='{$prodno}'
                                                and partno ='{$partno}'
                                                and after_print is null
                                                and unique_continue is not null
                                                and status_print <> 'loosecarton'
                                    group by partno,partname,custpo,dest,prodno,shelfno,unique_continue,after_print,idnumber
                            ");


                
            // STEP 4. UPDATE COLUMN AFTER SCAN DI PARTSCAN
            DB::connection('sqlsrv')
                ->update("UPDATE  partscan
                            SET
                            after_print = 1
                            where 	prodno ='{$prodno}'
                            and partno ='{$partno}'
                            and after_print is null
                            and unique_continue is not null
                            and status_print <> 'loosecarton'
                        ");


            return view('repacking.originalsumm', compact('content2'));
        
            }

            else{
                echo "<p style =font-size:20px;font-weight:bold;text-color:red > Error! Loading Content Combine Label/p>";

            }      

    }


    public function logPrintOrg(request $request){

        // $data = DB::table('log_print_kit_original')
        // ->get();


        $pagination = 10;
        $keyword= $request->keyword;

        $data = LogPrintKit::where('idnumber', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('prodno', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('partno', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('partname', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('custpo', 'LIKE', '%'.$keyword.'%')
                        ->latest()->paginate(10);
                        $data->appends($request->all());

     return view ('/repacking.logPrintOrg',compact(
                                            'data'
                                           ))->with('i', (request()->input('page', 1) -1) * $pagination
                 );


        // return view('repacking.logprintOrg', compact('data'));
    }

    public function scanIn(){

       


        return view('repacking.scanin');
    }

    public function inputData(Request $request){

        $scan_nik = $request->scan_nik;
        $mcLabel = $request->mc_label;
        $kitLabel = $request->kit_label;

        // GET PARAM FROM KIT LABEL

        $label_scan = substr($mcLabel,0,15);
        $partno = substr($kitLabel, 0,11);

        
        $qty2    = substr($kitLabel, 17,19);
        $qty = trim($qty2);

        // $data = "K2K-0165-02:KNOB assy:40:JK NAGANO:9344785::2306260005";
        $data = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $data);

        $lenght = $request->lenght;
        $widht = $request->widht;
        $height = $request->height;
        $gw = $request->gw;

        // dd($qty);

      

        // if($cek_stdpack[0]->stdpack != $qty){
        //     echo'isi gross weight';
        //     return response()
        //         ->json([
        //             'success' => false,
        //             'message' => 'ISI GROSS WEIGHT...'
        //         ]);
        // }

                $valid = DB::connection('sqlsrv')
                ->select("SELECT * from partscan
                                where label ='{$mcLabel}'                        
                        ");

        // CEK DATA PADA REPACKING

            // dd($valid);
            if($valid == null){
                return response()
                    ->json([
                        'success' => false,
                        'message' => 'BEFORE SCAN MC'
                    ]);
                }
    

        // STEP 1.CEK LABEL SCAN PADA SCAN IN
        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT * FROM scanin_repacking 
                                where label_mc ='{$mcLabel}' or
                                        label_kit ='{$kitLabel}'");


        if($cek_label){
            return response()
                ->json([
                    'success' => false,
                    'message' => 'DOUBLE SCAN...'
                ]);
        }
        // END CEK LABEL SCAN


        $cek_total = DB::connection('sqlsrv')
                    ->select("SELECT  * from repacking_list
                                where  partno = '{$partno}'
                                 and custpo = '{$custpo}'  
                                 and act_receive != demand
                                order by custpo asc
                                ");

    // dd($cek_total);

            $sum = array($cek_total[0]->act_receive, $qty);
            $act_qty = array_sum($sum);

            // dd($act_qty);

            if (($act_qty  > $cek_total[0]->demand)) {
                return response()
                    ->json([
                        'success' => false,
                        'message' => 'OVER QTY...',

                    ]);
            }

        // ambil part dari list repacking
        $selectPart = DB::connection('sqlsrv')
        ->select("SELECT top 1 * from repacking_list
                where  partno = '{$partno}' and custpo ='{$custpo}'
                and demand >= (coalesce(act_receive,0) + $qty)
                order by custpo asc");

            if(!$selectPart){
                return response()
                    ->json([
                        'success' => false,
                        'message' => 'PART NOT EXIST IN SCHEDULE...'
                    ]);
            }



          //AMBIL CONTENT GROSS WEIGHT
          $get_stdpack = DB::connection('sqlsrv')
          ->select("SELECT * FROM std_pack 
                      where 
                      partnumber ='{$partno}'
                 ");


            if(!$get_stdpack){
                return response()
                    ->json([
                        'success' => false,
                        'message' => 'ERROR GET DATA STDPACK, PART NOT EXIST IN MASTER...',

                    ]);
            }


        // STEP 2.INSERT INTO REPACKING SCAN IN
        DB::connection('sqlsrv')
        ->insert("INSERT into scanin_repacking(custcode,custpo,partno, partname, qty_receive,dest,label_mc,label_kit,scan_nik,gw,lenght,widht,height)
                select top 1  custcode, '{$custpo}', '{$partno}','{$partname}','{$qty}', '{$dest}','{$mcLabel}','{$kitLabel}', '{$scan_nik}','{$get_stdpack[0]->weight}','{$get_stdpack[0]->lenght}','{$get_stdpack[0]->widht}','{$get_stdpack[0]->height}'
                from repacking_list
                    where partno = '{$partno}' 
                    and custpo ='{$custpo}'
                    and  (coalesce(act_receive,0)+{$qty}) <= demand
                    order by custpo asc
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


        $get_prodno = DB::connection('sqlsrv')
        ->select("SELECT prodno from repacking_list where partno ='{$partno}'
                    and custpo ='{$custpo}'");

        // DB::connection('sqlsrv')
        // ->insert("INSERT into tblheadercombine(prodno,carton_no)
        //             select '{$get_prodno[0]->prodno}','{$carton_no}'
             
        //             ");
     
        $sum = array($selectPart[0]->act_receive, $qty);
        $act_qty = array_sum($sum);



        $viewdata = DB::connection('sqlsrv')
                        ->select("SELECT * from repacking_list where custpo ='{$custpo}' ");

                        if (($act_qty  == $selectPart[0]->demand)) {
                            return response()
                                ->json([
                                    'success' => false,
                                    'message' => 'FINISH SCAN...',
                                    'data'    => $viewdata

                                ]);
                        }

         return response()
                ->json([
                    'success' => true,
                    'message' => 'Scan success...',
                    'data'    => $viewdata
                ]);

    }

    public function scanCombine(){

        $combine = DB::table('tblcombine_no')
        // ->where('box_no')
        ->max('combine_no');
  
        $currentDate = Carbon::now();
        $dateAsNumber = $currentDate->format('Ymd');
        $lastOrder = DB::table('tblcombine_no')
                         ->whereDate('created_at',$currentDate)
                         ->max('id');
                         $order = $lastOrder ? $lastOrder + 1 : 1;
                         $uniqueNumber = $dateAsNumber . str_pad($order, 5, '0', STR_PAD_LEFT);
                         $combine_no = substr($uniqueNumber,12,1);              


        // $combine_no = + 1;

        return view('repacking.scanCombine', compact('combine_no'));
    }

    public function inputCombine(Request $request){

        $scan_nik = $request->scan_nik;
        $mcLabel = $request->mc_label;
        $kitLabel = $request->kit_label;

        // GET PARAM FROM KIT LABEL
        $label_scan = substr($mcLabel,0,15);
        $status_print = 'combine';

       
        $datakit = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $datakit);

        $lenght = $request->lenght;
        $widht = $request->widht;
        $height = $request->height;
        $gw = $request->gw;
        $combine_no = $request->combine_no;



      
        // STEP 1.CEK LABEL SCAN PADA SCAN IN
        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT * FROM scanin_repacking 
                            where label_mc ='{$mcLabel}' or
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
        if(empty($cek_label)){
            $selectPart = DB::connection('sqlsrv')
                            ->select("SELECT top 1 * from repacking_list
                                        where  partno = '{$partno}' and custpo ='{$custpo}'
                                        and demand >= (coalesce(act_receive,0) + $qty)
                                        order by custpo asc");

                if(!$selectPart){
                    return response()
                        ->json([
                            'success' => false,
                            'message' => 'PART NOT EXIST IN SCHEDULE...'
                        ]);
                }
                             
            // STEP 2.INSERT INTO REPACKING SCAN IN
            DB::connection('sqlsrv')
                    ->insert("INSERT into 
                                        scanin_repacking(combine_no,custpo,partno, partname, qty_receive,dest,label_mc,label_kit,scan_nik,gw,lenght,widht,height)
                                SELECT  '{$combine_no}','{$custpo}', '{$partno}','{$partname}','{$qty}', '{$dest}', '{$mcLabel}','{$kitLabel}', '{$scan_nik}','{$gw}','{$lenght}','{$widht}','{$height}'
                                ");



             // STEP 3.UPDATE IN REPACKING LIST
           $update =  DB::connection('sqlsrv')
                                ->update("UPDATE repacking_list
                                SET
                                    act_receive = ( select sum(qty_receive )
                                    from scanin_repacking  as b where
                                             b.partno = repacking_list.partno  and b.custpo = repacking_list.custpo),
                                    bal_receive = repacking_list.demand - (repacking_list.act_receive + {$qty})
                                    from scanin_repacking as b  where
                                            repacking_list.id = '{$selectPart[0]->id}' ") ;


            // STEP  MASUKAN DATA KE TEMP PRINT
            //         1. GET CONTENT UNTUK TEMP PRINT COMBINE LABEL
            $get_qty = DB::connection('sqlsrv')
                            ->select("SELECT act_receive from repacking_list where partno ='{$partno}'
                                        and custpo ='{$custpo}'");

            $get_prodno = DB::connection('sqlsrv')
                            ->select("SELECT prodno from repacking_list where partno ='{$partno}'
                                         and custpo ='{$custpo}'");
            
            $cek_part = DB::connection('sqlsrv')
                             ->select("SELECT  count(partno) as tot_part from temp_print 
                                     ");

          
            // GET SEQUENCE NO
            $currentDate = Carbon::now();
            $dateAsNumber = $currentDate->format('Ymd');
            $lastOrder = DB::table('temp_print')
                             ->whereDate('created_at',$currentDate)
                             ->max('id');

            $order = $lastOrder ? $lastOrder + 1 : 1;
            $uniqueNumber = $dateAsNumber . str_pad($order, 5, '0', STR_PAD_LEFT);
            $sequence_no = substr($uniqueNumber,12,1);
            $seq = $get_prodno[0]->prodno . '-'  . $combine_no . '-' . $sequence_no;

            // dd($seq);
            // END SEQUENCE

            //CEK CUST PO       
            $cek_po = DB::connection('sqlsrv')
                            ->select("SELECT  count(custpo) as custpo from temp_print where custpo ='{$custpo}'");
                    // 2. MASUKAN DATA KE TEMP PRINT JIKA PO MASIH BELUM ADA PADA TABLE
                        if($cek_po[0]->custpo == 0  ){
                            // INSERT DATA TO TEMP PRINT TABLE
                            DB::connection('sqlsrv')
                                    ->insert("INSERT INTO temp_print
                                                            (custpo,dest,prodno,partno,partname,shelfno,qty,combine_no,sequence_no)
                                                    select '{$custpo}','{$dest}','{$get_prodno[0]->prodno}', '{$partno}','{$partname}','{$shelfno}', '{$qty}','{$combine_no}','{$seq}'
                                            ");
                                               $sum = array($selectPart[0]->act_receive, $qty);
                                               $act_qty = array_sum($sum);


                                               $viewdata = DB::connection('sqlsrv')
                                                               ->select("SELECT * from repacking_list where custpo ='{$custpo}' ");

                                                               if (($act_qty  == $selectPart[0]->demand)) {
                                                                   return response()
                                                                       ->json([
                                                                           'success' => false,
                                                                           'message' => 'FINISH SCAN...',
                                                                           'data'    => $viewdata

                                                                       ]);
                                                               }
                        }

                        else{

                            $update =  DB::connection('sqlsrv')
                                        ->update("UPDATE temp_print
                                                    SET
                                                    qty = (qty + {$qty}) where 
                                                    custpo ='{$custpo}' 
                                                ") ;

                            $sum = array($selectPart[0]->act_receive, $qty);
                            $act_qty = array_sum($sum);
                            $viewdata = DB::connection('sqlsrv')
                                            ->select("SELECT * from repacking_list where custpo ='{$custpo}' ");

                                            if (($act_qty  == $selectPart[0]->demand)) {
                                                return response()
                                                    ->json([
                                                        'success' => false,
                                                        'message' => 'FINISH SCAN...',
                                                        'data'    => $viewdata

                                                    ]);
                                            }

                        }


                   
                            return response()
                                        ->json([
                                            'success' => true,
                                            'message' => 'Scan success...',
                                            'data'    => $viewdata
                                        ]);

                    }

    }


    public function kitdata(){
        $data = DB::connection('sqlsrv')
            ->select("SELECT  b.*, a.act_receive,a.bal_receive  from repacking_list as a
                    inner join partlist as b
                    on a.partno = b.partno and a.custpo = b.custpo  order by id desc");

        return view('repacking.kitdata',compact('data'));
    }


    // PRINT MASTER LABEL(COMBINE LABEL)
    public function printMaster(request $request){


        // $combine_no  = DB::table('tblcombine_no')
        //                    ->max('combine_no');
        
      $combine_no = $request->combine_no;
        // $combine_no = $lastOrder ? $lastOrder + 1 : 1;
      $param= DB::connection('sqlsrv')
                     ->select("SELECT distinct custpo, prodno,partno,partname,dest,shelfno, qty,combine_no,sequence_no 
                                FROM temp_print");

      $totalItem = DB::table('temp_print')->distinct('custpo')->count('custpo');

       // STEP 2. INSERT INTO TBLIDBOX
       DB::connection('sqlsrv')
            ->insert("INSERT into tblcombine_no(prodno,combine_no)
                            select '{$param[0]->prodno}','{$combine_no}'
                        ");
 


        return view('repacking.combine', compact('param','totalItem','combine_no'));
    }



    //  PRINT LOG KIT
     public function get_Print(Request $request, $id){

    
        $pic = $request->pic_print;
        $id = $request->id;
        $currentDate = Carbon::now();


        $dateAsNumber = $currentDate->format('Ymd');
        $date = substr($dateAsNumber,2,8);


        $get_id = DB::table('log_print_kit_original')
                    ->whereDate('created_at',$currentDate)
                    ->max('id');




        $order = $get_id ? $get_id + 1 : 1;
        $idnumber = $date . str_pad($order, 4, '0', STR_PAD_LEFT);


        //GET PARAM UNTUK PRINT LOG
        $param = DB::connection('sqlsrv')
        ->select(" SELECT distinct	a.idnumber,a.partno, a.partname, a.qty_scan, a.dest, a.custpo, a.shelfno,  a.prodno,a.balance_issue
                        from	log_print_kit_original as a
                        where a.id = '{$id}' ");


     // STEP 3. UPDATE STATUS PRINT
        $update_status = DB::connection('sqlsrv')
                            -> update("UPDATE log_print_kit_original set status_print = 2, pic_print = '{$pic}',
                                        last_print = '{$currentDate}'
                                        where id ='{$id}' ");


         return view('repacking.logprintkit', compact('param','idnumber'));

    }


    public function view_cancel_scanin(){


        return view('repacking.cancel');
    }


    public function cancel_scanin(Request $request){

        // return $request;
        $nik = $request->scan_nik;
        $kitLabel = $request->kit_label;
        // $data = "K2K-0165-02:KNOB assy:40:JK NAGANO:9344785::2306260005";
        $datakit = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $datakit);

        $deleted = DB::table('scanin_repacking')->where('label_kit', '=', $kitLabel)
                      ->delete();


        // $update = DB::table('repacking_list')
        //               ->where('partno', '=', $partno)
    //               ->orWhere('custpo', '=', $custpo)
        //               ->update(['actual_receive' => 'actual_receive' - $qty]);



        $update =    DB::connection('sqlsrv')
        ->update("UPDATE repacking_list
                                SET act_receive = (act_receive - '{$qty}'), bal_receive = (bal_receive + '{$qty}')
                                    where
                                 partno = '{$partno}'  and  custpo = '{$custpo}'

                                         ") ;


        $deleted = DB::table('temp_print')->where('partno', '=', $partno)
                                          ->orWhere('custpo', '=', $custpo)
                                          ->delete();

        $viewdata = DB::connection('sqlsrv')
                                          ->select("SELECT * from repacking_list where custpo ='{$custpo}' ");
        return response()->json([
                                'success'=> TRUE,
                                'message'=>'CANCEL DATA SUCCESS',
                                'data'   => $viewdata
                            ]);
    }


    public function view_scanassy(){

        return view('repacking.view_scanassy');
    }

    public function inputassy_mecha(Request $request){

        $scan_nik = $request->scan_nik;
        $kitLabel = $request->kit_label;
        $data = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $data);

        $lenght = $request->lenght;
        $widht = $request->widht;
        $height = $request->height;
        $gw = $request->gw;


        // STEP 1.CEK LABEL SCAN PADA SCAN IN
        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT * FROM scanin_repacking where
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
                    where  partno = '{$partno}' and custpo ='{$custpo}'
                    and demand >= (coalesce(act_receive,0) + $qty)
                    order by custpo asc");


        if(!$selectPart){
            return response()
                ->json([
                    'success' => false,
                    'message' => 'PART NOT EXIST IN SCHEDULE...'
                ]);
        }

         //AMBIL CONTENT GROSS WEIGHT
         $get_stdpack = DB::connection('sqlsrv')
         ->select("SELECT * FROM std_pack 
                     where 
                     partnumber ='{$partno}'
                ");


           if(!$get_stdpack){
               return response()
                   ->json([
                       'success' => false,
                       'message' => 'ERROR GET DATA STDPACK, PART NOT EXIST IN MASTER...',

                   ]);
           }

        DB::connection('sqlsrv')
        ->insert("INSERT into scanin_repacking(custcode,custpo,partno, partname, qty_receive,dest,label_kit,scan_nik,gw,lenght,widht,height)
                            select top 1  custcode, '{$custpo}', '{$partno}','{$partname}','{$qty}', '{$dest}', '{$kitLabel}', '{$scan_nik}','{$get_stdpack[0]->weight}','{$get_stdpack[0]->lenght}','{$get_stdpack[0]->widht}','{$get_stdpack[0]->height}'
                            from repacking_list
                    where
                     partno = '{$partno}' and custpo ='{$custpo}'
                    and  (coalesce(act_receive,0)+{$qty}) <= demand
                    order by custpo asc
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

                 $viewdata = DB::connection('sqlsrv')
                                ->select("SELECT * from repacking_list where custpo ='{$custpo}' ");


                                $sum = array($selectPart[0]->act_receive, $qty);
                                $act_qty = array_sum($sum);

                                // TAMPILKAN DATA HASIL SCANIN
                                if (($act_qty  == $selectPart[0]->demand)) {
                                    return response()
                                        ->json([
                                            'success' => false,
                                            'message' => 'FINISH SCAN...',
                                            'data'    => $viewdata

                                        ]);
                                }



                return response()
                        ->json([
                            'success' => true,
                            'message' => 'Scan success...',
                            'data'    => $viewdata
                        ]);

    }


      //  PRINT ASSY KIT - INPUT
    public function printassy(Request $request, $id){


        $pic = $request->pic_print;
        $id = $request->id;

//STEP 1. GET PARAM UNTUK PRINT DATA DARI INHOUSE TABLE
            $param = DB::connection('sqlsrv')
                        ->select("SELECT top 1 a.custcode,a.custpo,a.partno,a.partname,a.dest,a.shelfno,a.prodno, b.id,b.idnumber,b.qty_input from schedule as a
                                    inner join inhouse_scanin as b on a.partno = b.model          
                                    where b.id = '{$id}' 
                                ");

            $stdpack= DB::connection('sqlsrv')
                        ->select(" SELECT  *  from std_pack
                                    where partnumber = '{$param[0]->partno}'
                                ");

       

            if (!$param) {
                echo('Part Not Exist In Schedule');
                return response()->json([
                    'success' => false,
                    'message' => 'Part Not Exist In Schedule',

                ]);
            }
     // STEP 2. INSERT KE LOG PRINT
            DB::connection('sqlsrv')
                ->insert("INSERT into log_print_kit_original(idnumber,partno,partname,qty_scan,dest,custpo,shelfno,prodno)
                    select '{$param[0]->idnumber}', '{$param[0]->partno}','{$param[0]->partname}','{$param[0]->qty_input}',
                            '{$param[0]->dest}',
                            '{$param[0]->custpo}','{$param[0]->shelfno}','{$param[0]->prodno}'

                    ");


                return view('repacking.printassy', compact('param','stdpack'));

    }


     // PROCESS PRINT LABEL KIT
     public function printlbl_assy(Request $request){


        $pic = $request ->pic;
        $assylabel = $request->assy_label;

        //PARAM LABEL
        $partno = substr($assylabel,0,11);
        $qty    = substr($assylabel,11,3);
        $prodno    = substr($assylabel,16,4);



            //SEND DATA UNTUK CONTENT PRINT LABEL
            $param = DB::connection('sqlsrv')
            ->select(" SELECT  *  from inhouse_scanin
                        where partno ='{$partno}'
                        and lotno='{$prodno}'
                        and type ='scanin' ");



            // // STEP 1. INSERT TO PRINT LOG
            // $logPrint = DB::connection('sqlsrv')
            //     ->insert(" INSERT
            //                     into log_print_kit_original (idnumber,partno,partname,qty_scan,dest,custpo,shelfno,  prodno)
            //                     SELECT distinct
            //                     b.idnumber,a.partno,a.partname,  b.scan_issue,a.dest,a.custpo,a.mcshelfno, a.prodno
            //                                 from partlist as a
            //                     inner join partscan as b on a.partno = b.partno and a.demand = b.demand
            //                     where 	 a.custpo ='{$custpo}' and a.partno ='{$partno}'
            //                 ");

            return view('repacking.printassy_scan', compact('param'));


    }


    public function view_borrow_cancelation(){

       $data= DB::connection('sqlsrv')
            ->select("SELECT * FROM tblhistory_cancelation");

        return view('repacking.canceloutput',
                    compact('data'));
    }


    public function printNewlabel(request $request){


        $pic = $request->pic_print;
        $id = $request->id;

        //STEP 1. GET PARAM UNTUK PRINT DATA DARI INHOUSE TABLE
        $param = DB::connection('sqlsrv')
        ->select("SELECT * from tblhistory_cancelation
                     where id = '{$id}' ");


        // STEP 2. INSERT KE LOG PRINT
        DB::connection('sqlsrv')
            ->insert("INSERT into log_print_kit_original(idnumber,partno,partname,qty_scan,dest,custpo,shelfno,prodno)
                select  '{$param[0]->idnumber}','{$param[0]->partno}', '{$param[0]->partname}', '{$param[0]->qty}', '{$param[0]->dest}','{$param[0]->custpo}',
                        '{$param[0]->shelfno}',  '{$param[0]->prodno}'
                ");


         return view('repacking.printNew', compact('param'));

    }


    function reset_tbltmp(){

        DB::table('temp_print')->truncate();

        return redirect()->back()->with('delete', 'All records have been deleted.');
    }




    public function inputassy_panel(Request $request){

        $input_nik = $request->input_nik;
        $qr_panel = $request->qr_panel;
        $qr_kit = $request->qr_kit;
        $data = $qr_kit;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $data);

        $panjang = $request->panjang;
        $lebar = $request->lebar;
        $tinggi = $request->tinggi;
        $berat = $request->berat;


        // STEP 1.CEK LABEL SCAN PADA SCAN IN
        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT * FROM scanin_repacking where
                            label_kit ='{$qr_kit}'");


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
                    where  partno = '{$partno}' and custpo ='{$custpo}'
                    and demand >= (coalesce(act_receive,0) + $qty)
                    order by custpo asc");


        if(!$selectPart){
            return response()
                ->json([
                    'success' => false,
                    'message' => 'PART NOT EXIST IN SCHEDULE...'
                ]);
        }


         //AMBIL CONTENT GROSS WEIGHT
         $get_stdpack = DB::connection('sqlsrv')
         ->select("SELECT * FROM std_pack 
                     where 
                     partnumber ='{$partno}'
                ");


           if(!$get_stdpack){
               return response()
                   ->json([
                       'success' => false,
                       'message' => 'ERROR GET DATA STDPACK, PART NOT EXIST IN MASTER...',

                   ]);
           }

        DB::connection('sqlsrv')
        ->insert("INSERT into scanin_repacking(custcode,custpo,partno, partname, qty_receive,dest,label_panel,label_kit,scan_nik,gw,lenght,widht,height)
                            select top 1  custcode, '{$custpo}', '{$partno}','{$partname}','{$qty}', '{$dest}', '{$qr_panel}','{$qr_kit}', '{$input_nik}','{$get_stdpack[0]->weight}','{$get_stdpack[0]->lenght}','{$get_stdpack[0]->widht}','{$get_stdpack[0]->height}'
                            from repacking_list
                    where
                     partno = '{$partno}' and custpo ='{$custpo}'
                    and  (coalesce(act_receive,0)+{$qty}) <= demand
                    order by custpo asc
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



                 $viewdata = DB::connection('sqlsrv')
                                ->select("SELECT * from repacking_list where custpo ='{$custpo}' ");


                                $sum = array($selectPart[0]->act_receive, $qty);
                                $act_qty = array_sum($sum);

                                // TAMPILKAN DATA HASIL SCANIN
                                if (($act_qty  == $selectPart[0]->demand)) {
                                    return response()
                                        ->json([
                                            'success' => false,
                                            'message' => 'FINISH SCAN...',
                                            'data'    => $viewdata

                                        ]);
                                }



                return response()
                        ->json([
                            'success' => true,
                            'message' => 'Scan success...',
                            'data'    => $viewdata
                        ]);

    }


}
