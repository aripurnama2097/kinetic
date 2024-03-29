<?php

namespace App\Http\Controllers;

use App\Models\Partlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Models\PartScan;
class PartlistController extends Controller
{
    public function index()
    {

        $data = DB::table('partlist')
            ->get();

        $dataprodno = DB::connection('sqlsrv')
            ->select("SELECT distinct  (prodno),(created_at) 
                                from partlist 
                    order by created_at desc");

        $datajkeipo = DB::connection('sqlsrv')
            ->select("SELECT distinct (jkeipodate) from partlist");

        $qrcode = DB::connection('sqlsrv')
            ->select("SELECT top 1 * from partlist");

        $sch_mc = DB::connection('sqlsrv')
            ->select(" SELECT
                        DISTINCT
                        partlist_no,custcode,prodno,orderitem,vandate,created_at as release_date
                    FROM
                        partlist
                        order by release_date asc");

        $partlistno = DB::connection('sqlsrv')
            ->select("SELECT distinct(partlist_no) from partlist ");


        return view('partlist.index', compact('data', 'dataprodno', 'qrcode', 'partlistno', 'sch_mc'));
    }


    public function filterProdno(Request $request)
    {


        $prodNo = $request->input('prodno');
        $jkeipo = $request->input('jkeipodate');

        $data = DB::table('partlist')
            ->distinct('prodno')
            ->where('prodno', '=',  $prodNo)
            ->get();


        $qr = $data[0]->partlist_no;


        // dd($distinct);

        $dataNew = [$data, $qr];


        return response()->json([

            "data" => $data,
            "qr" => $qr
        ]);
    }

    public function filter_scan(Request $request)
    {


        $partlistNo = $request->partlist_no;

        $data = DB::table('partlist')
            ->where('partlist_no', '=',  $partlistNo)
            ->get();

        // $data = Partlist::with('user')->
        // where('partlist_no','=',  $partlistNo)
        // ->paginate(1);

        $cek_partlist = DB::connection('sqlsrv')
            ->select("SELECT * FROM partlist where partlist_no ='{$partlistNo}'");


        if (empty($cek_partlist)) {
            return response()->json([
                'success' => false,
                'message' => 'Part list Not Available...'
            ]);
        } else {

            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Partlist Oke'
            ]);
        }
    }

    public function scan_issue(Request $request, $status_print = null)
    {

        $nik = $request->scan_nik;
        $scan_nik   =  substr($nik, 2,5); 
        $partlist_no = $request->partlist_no;
    

        $scan_label = $request->scan_label;
        $label_scan = substr($scan_label, 0, 15);
        $trim_label = trim($label_scan);

        if (strlen($scan_label) == 76) {
                $qty2 = substr($scan_label, 24, 5);
                $qty = trim($qty2);
                $unique = substr($scan_label, 28, 49);

          
    
            }
        else {
                $qty2 = substr($scan_label, 16, 4);
                $qty = trim($qty2);
                $unique = substr($scan_label, 20, 10);
            }

        
        // STEP 1. CEK ISI PART NO DIPARTLIST
        $cek_stdpack = DB::connection('sqlsrv')
                              ->select("SELECT * FROM std_pack 
                                                    where partnumber ='{$label_scan}'");

        if (!$cek_stdpack) {
                        return response()->json(['success' => false,
                                                 'message' => 'PART NOT EXIST STDPACK'
                                                ]);
                    }

        // STEP 2. CEK ISI PART NO DIPARTLIST
        $cek_part = DB::connection('sqlsrv')
            ->select("SELECT * FROM partlist 
                        where partlist_no ='{$partlist_no}'
                         and  partno ='{$label_scan}'
                    
                    ");


        if (!$cek_part) {
            return response()->json([
                'success' => false,
                'message' => 'WRONG PART'
            ]);
        }
        //--------------END CEK-----------------


        // STEP 2. CEK LABEL/UNIQUE ID PART PADA PARTSCAN TABLE
        $cek_label = DB::connection('sqlsrv')
            ->select("SELECT unique_id from partscan where unique_id ='{$unique}'");

        if ($cek_label) {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'DOUBLE SCAN...',

                ]);
        }
        //--------------END CEK-----------------


        //  // STEP 3. CEK TOTAL BERDASARKAN PARTNO
         $cek_balance = DB::connection('sqlsrv')
                       ->select ("SELECT count(partno) as partnot_clear
                                                    from partlist
                                    where  partlist_no ='{$partlist_no}'
                                    and partno ='{$label_scan}'  
                                    and  balance_issue <> 0
																	
                                ");

                            //  dd($cek_balance[0]->partnot_clear);

                    if($cek_balance[0]->partnot_clear ==0){
                        return response()
                        ->json([
                            'success' => false,
                            'message' => 'OVER DEMAND...',
                        ]);
                    }

        // STEP 4. CEK TOTAL SCAN UNTUK KONDISI DOUBLE PARTNO(PO BERBEDA) DALAM 1 PRODNO
                    // (KONSEP : UPDATE DATA 1 PO  DULU SAMPAI CLEAR,BARU KE PO SELANJUTNYA)
        $cek_total = DB::connection('sqlsrv')
            ->select("SELECT  * from partlist
                        where partlist_no ='{$partlist_no}'
                        and   partno = '{$label_scan}'                
                        and tot_scan != demand
                        order by custpo asc
                        ");

        // dd($cek_total);

        $sum = array($cek_total[0]->tot_scan, $qty);
        $act_qty = array_sum($sum);


        if (($act_qty  > $cek_total[0]->demand)) {
            return response()
            ->json([
                'success' => false,
                'message' => 'QTY OVER FROM STDPACK...',

            ]);
        }
         // ENDSTEP 3
        // STEP 4.PILIH PART UNTUK DI MASUKAN KE TRANSAKSI SCANISSUE
        $selectPart = DB::connection('sqlsrv')
            ->select("SELECT top 1 * from partlist
                                    where  partlist_no ='{$partlist_no}'
                                    and  partno = '{$label_scan}'                             
                                    and demand >= (coalesce(tot_scan,0) + $qty)
                                    order by custpo asc");


                if ($qty < $selectPart[0]->stdpack && $status_print == null) {
                    return response()
                        ->json([
                            'success' => false,
                            'message' => 'Loose Carton ?'
                        ]);
                }
                else if($qty > $selectPart[0]->stdpack  && $status_print == null)
                    {
                        return response()
                        ->json([
                            'success' => false,
                            'message' => 'QTY OVER FROM STDPACK...',

                        ]);
                    }


                else if ($selectPart[0]->stdpack == null && $status_print == null) {
                    return response()
                        ->json([
                            'success' => false,
                            'message' => 'Loose Carton ?'
                        ]);
                }
        //--------------END CEK-----------------

        // GET ID NUMBER PRINT LABEL KIT
        $currentDate = Carbon::now();
        $dateAsNumber = $currentDate->format('Ymd');
        $date = substr($dateAsNumber, 2, 8);

        // dd($date);
        $get_id = DB::table('partscan')
                    ->whereDate('scan_date', $currentDate)
                    ->orderBy('id', 'desc')
                    ->limit(1)
                    ->value('dailyno');
        
        // TAMBAHKAN KONDISI KETIKA GET ID MASIH KOSONG => GET ID = DATE
        if($get_id == null){
            $order = $get_id ? $get_id + 1 : 1;
            $dailyno = $date . str_pad($order, 3, '0', STR_PAD_LEFT);
            $idnumber = 'I' . $dailyno;   
        }

        else if($get_id != null){
            $get_dailyno = DB::table('partscan')
                                ->whereDate('scan_date', $currentDate)
                                ->max('dailyno');
            $dailyno  = $get_dailyno + 1;
            $idnumber = 'I' . $dailyno;
        }

        //STEP 6. SIMPAN DATA  ke partscan + UPDATE STATUS PRINT
        if (!empty(@$status_print)) {
             $scan_nik   =  substr($nik, 2,5); 
             $get_lastuniq = DB::table('partscan')
                            ->max('unique_continue');
    
             $uniq_cont = $get_lastuniq;
            if($status_print != 'continue_combine'){// STATUS PRINT = START COMBINE OR LOOSE CARTON
                $uniq_cont = $get_lastuniq ? $get_lastuniq + 1 : 1;

                $idnumbercont = 'I' . $dailyno; // IDNUMBER UNTUK STATUS PRINT LOOSE, DAN START CONTINUE
                // dd($idnumbercont);
            }

            // compare stdpack dg part continue
            if($status_print == 'continue_combine'){

                $get_num = DB::table('partscan')
                        ->where('status_print', 'start_combine')
                        ->where('partno', $label_scan)
                        ->whereDate('scan_date',$date )
                        ->orderBy('id', 'desc')
                        ->take(1)
                        ->pluck('dailyno')
                        ->first();

                // dd($get_num);
                //MASIH PROBLEM UNTUK DAPATKAN GET NUM NULL
                if($get_num == null){
                    return response()
                        ->json([
                            'success' => false,
                            'message' => 'PART BEFORE START COMBINE...'                     

                        ]);
                }

                $dailyno        = $get_num;
                $idnumbercont   = 'I' . $get_num;     
                $compare_stdpack = DB::connection('sqlsrv')->select("SELECT stdpack, (sum(scan_issue))+$qty as scan_issue
                                                                        from partscan
                                                                        where partno ='{$label_scan}'
                                                                        and dailyno = '{$dailyno}'
                                                                        group by stdpack");
                $comparing = $compare_stdpack[0];
                if($comparing->scan_issue > $comparing->stdpack){
                    return false;
                }
            }

            DB::connection('sqlsrv')
                ->insert("INSERT into partscan(dailyno,custcode, dest,model, prodno, vandate, dateissue,partlist_no
                                     ,orderitem,custpo,partno,partname,shelfno,label,demand,unique_id,stdpack,scan_issue, scan_nik,
                                      status_print,idnumber,unique_continue)
                          select top 1 '{$dailyno}',custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                                    orderitem,custpo,partno, partname,mcshelfno,'{$scan_label}', demand,'{$unique}', stdpack,'{$qty}', '{$scan_nik}','{$status_print}','{$idnumbercont}','{$uniq_cont}'
                                    from partlist
                                    where partlist_no ='{$partlist_no}'
                                    and partno = '{$label_scan}'                                
                                    and  (coalesce(tot_scan,0)+{$qty}) <= demand
                                    order by custpo asc ");

            // update partlist
            DB::connection('sqlsrv')
                ->update("UPDATE partlist
                                set tot_scan = (
                                    SELECT sum(scan_issue) FROM partscan as b where
                                    b.partno = partlist.partno and b.custpo = partlist.custpo
                                ),
                                status_scan ='1',
                                balance_issue = partlist.demand - (partlist.tot_scan + {$qty})
                            from partscan as b where
                            partlist.id = '{$selectPart[0]->id}'
                            ");


            // TAMPILKAN DATA PARTLIST HASIL SCAN
            $param = DB::connection('sqlsrv')
                ->select("SELECT * from partlist 
                           where   partlist_no ='{$partlist_no}'
                           and
                                  partno ='{$label_scan}'");


            // GET PARTLIST NO
            $partlistno =   $param[0]->partlist_no;
            $data       = DB::connection('sqlsrv')
                ->select("SELECT * from partlist 
                                where partlist_no ='{$partlist_no}'
                                and partno ='{$label_scan}' and tot_scan != 0");

            // return $data;

            $sum        = array($selectPart[0]->tot_scan, $qty);
            $act_qty    = array_sum($sum);

            // TAMPILKAN DATA HASIL SCANIN
                if (($act_qty  == $selectPart[0]->demand)) {
                    return response()
                        ->json([
                            'success' => false,
                            'message' => 'DEMAND COMPLETE...',
                            'data'    => $data

                        ]);
                }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Scan Succesfully',
                    'data'     => $data

                ]);
        }
        //--------------END STEP-----------------

        //STEP 7. SIMPAN DATA  ke partscan + TANPA UPDATE STATUS PRINT
        else {
            DB::connection('sqlsrv')
                ->insert("INSERT into partscan(dailyno,custcode, dest,model, prodno, vandate, dateissue,partlist_no
                    ,orderitem,custpo,partno,partname,shelfno,label,demand,unique_id,stdpack,scan_issue, scan_nik,idnumber)
                    select top 1 '{$dailyno}',custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                    orderitem,custpo,partno, partname,mcshelfno,'{$scan_label}', demand,'{$unique}', stdpack,'{$qty}', '{$scan_nik}','{$idnumber}'
                    from partlist
                    where  partlist_no ='{$partlist_no}'
                    and  partno = '{$label_scan}'                   
                    and  (coalesce(tot_scan,0)+{$qty}) <= demand
                    order by custpo asc ");

            // update partlist
            DB::connection('sqlsrv')
                ->update("UPDATE partlist
                                set tot_scan = (
                                    SELECT sum(scan_issue) FROM partscan as b where
                                    b.partno = partlist.partno and b.custpo = partlist.custpo
                                ),
                                status_scan ='1',
                                balance_issue = partlist.demand - (partlist.tot_scan + {$qty})
                            from partscan as b where
                            partlist.id = '{$selectPart[0]->id}'
                            ");


            // TAMPILKAN DATA PARTLIST HASIL SCAN
            $param = DB::connection('sqlsrv')
                ->select("SELECT * from partlist 
                           where   partlist_no ='{$partlist_no}'
                           and
                                  partno ='{$label_scan}'");


            // GET PARTLIST NO
            $partlistno   =   $param[0]->partlist_no;



    

                $data = DB::connection('sqlsrv')
                ->select("SELECT * from partlist where partlist_no ='{$partlist_no}'
                                                    and partno ='{$label_scan}' and tot_scan != 0");
            // return $data;
            $sum = array($selectPart[0]->tot_scan, $qty);
            $act_qty = array_sum($sum);

            // TAMPILKAN DATA HASIL SCANIN
                if (($act_qty  == $selectPart[0]->demand)) {
                    return response()
                        ->json([
                            'success' => false,
                            'message' => 'DEMAND COMPLETE...',
                            'data'    => $data

                        ]);
                }



            return response()
                ->json([
                    'success' => true,
                    'message' => 'Scan Succesfully',
                    'data'     => $data

                ]);
        }
        //--------------END STEP-----------------
    }

    // INSERT KE PARTSCAN DAN CEK LOOSE CARTON LAGI
    public function looseCarton(Request $request)
    {

        return $this->scan_issue($request, "loosecarton");

        $nik = $request->scan_nik;
        $scan_nik   =  substr($nik, 2,5); 
        $partlist_no = $request->partlist_no;
        $scan_label = $request->scan_label;

        //PARAM LABEL
        $label_scan = substr($scan_label, 0, 15);

        $data = DB::connection('sqlsrv')
                ->select("SELECT * from partlist where partlist_no ='{$partlist_no}'
                                                    and partno ='{$label_scan}' and tot_scan != 0");
        return response()
            ->json([
                'success' => true,
                'message' => 'Scan Succesfully',
                'data'     => $data

            ]);
    }
    public function scan_continue(Request $request)
    {
        $this->scan_issue($request, "start_combine");

        $nik = $request->scan_nik;
        $scan_nik   =  substr($nik, 2,5); 
        $partlist_no = $request->partlist_no;
        $scan_label = $request->scan_label;

        //PARAM LABEL
        $label_scan = substr($scan_label, 0, 15);

        $data = DB::connection('sqlsrv')
                ->select("SELECT * from partlist where partlist_no ='{$partlist_no}'
                                                    and partno ='{$label_scan}' and tot_scan != 0");

        // return $data;

        return response()
            ->json([
                'success' => true,
                'message' => 'Scan Succesfully',
                'data'     => $data

            ]);
    }
    public function scan_end_continue(Request $request)
    {
        $issuing = $this->scan_issue($request, "continue_combine");
        if($issuing == false){
            return response()->json([
                'success' => false,
                'message' => 'LARGER QTY THAN STDPACK !!!'

            ]);
        }
        
        $currentDate = Carbon::now();
        $dateAsNumber = $currentDate->format('Ymd');
        $date = substr($dateAsNumber, 2, 8);

        $nik = $request->scan_nik;
        $scan_nik   =  substr($nik, 2,5); 
        $partlist_no = $request->partlist_no;
        $scan_label = $request->scan_label;

        //PARAM LABEL
        $label_scan = substr($scan_label, 0, 15);


        $get_num = DB::table('partscan')
                        ->where('status_print', 'start_combine')
                        ->where('partno', $label_scan)
                        ->whereDate('scan_date',$date )
                        ->orderBy('id', 'desc')
                        ->take(1)
                        ->pluck('dailyno')
                        ->first();

                //MASIH PROBLEM UNTUK DAPATKAN GET NUM NULL
                if($get_num == null){
                    return response()
                        ->json([
                            'success' => false,
                            'message' => 'CONTINUE COMBINE WRONG...'                     

                        ]);
                }

        $data = DB::connection('sqlsrv')
        ->select("SELECT * from partlist where partlist_no ='{$partlist_no}'
                                            and partno ='{$label_scan}' and tot_scan != 0");

        // return $data;

        return response()
            ->json([
                'success' => true,
                'message' => 'Scan Succesfully',
                'data'     => $data

            ]);
    }


    public function showscan(Request $request)
    {

        $partlistno = $request->partlist_no;
        $scan_label = $request->scan_label;
        $label_scan = substr($scan_label, 0, 15);

        $data = DB::connection('sqlsrv')
            ->select("SELECT * from partlist
                        where partlist_no ='{$partlistno}'
                        and balance_issue <> 0
            ");

        return view('partlist.showscan', compact('data'));
    }


    public function view()
    {

        $data =  DB::connection('sqlsrv')
            ->select("SELECT * FROM PARTLIST");
        return view('partlist.view', compact('data'));
    }

    public function view_inhouse()
    {

        $datapo =  DB::connection('sqlsrv')
            ->select("SELECT distinct(jknpo) from masterinhouse");

        return view('partlist.inhouse', compact('datapo'));
    }


    public function scan_inhouse(request $request)
    {


        $currentDate = Carbon::now();
        $dateAsNumber = $currentDate->format('Yd');
        $date = substr($dateAsNumber, 2, 8);


        $get_id = DB::table('inhouse_scanin')
            ->whereDate('created_at', $currentDate)
            ->max('id');
            
        $order = $get_id ? $get_id + 1 : 1;
        $idnumber = 'I' . $date . 'A' . str_pad($order, 4, '0', STR_PAD_LEFT);

        $assylabel = $request->assy_label;
        $pic       = substr($request->pic,2,5);
        $type       = 'scanin panel';
        $partno = substr($assylabel, 0, 11);

     

       /*  dd($partno); */
        $qty    = substr($assylabel, 11, 2);
        // dd($qty);
        $prodno    = substr($assylabel, 16, 4);




        // STEP 1. CEK LABEL
        $cek_label = DB::connection('sqlsrv')
            ->select("SELECT label from inhouse_scanin where label ='{$assylabel}'");

        if ($cek_label) {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'DOUBLE SCAN...',

                ]);
        }


        // STEP 2. CEK TOTAL SCAN PART UNTUK DI UPDATE DATA
        $cek_total = DB::connection('sqlsrv')
            ->select("SELECT top 1 * from inhouse_list
                                where  model = '{$partno}' 
                                and lotno='{$prodno}'
                                and shipqty >= (coalesce(tot_input,0) + $qty)
                                order by jknpo asc
                                ");

                            

        if (!$cek_total ) {
            return response()->json([
                'success' => false,
                'message' => 'Error Get Content Master Inhouse',

            ]);
        }

        $sum = array($cek_total[0]->tot_input, $qty);
        $act_qty = array_sum($sum);

        if (($act_qty  > $cek_total[0]->shipqty)) {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'OVER QTY...',

                ]);
        }

        if ($cek_total) {
            //GET CONTENT FROM SCHEDULE
            $param = DB::connection('sqlsrv')
                ->select("SELECT * from schedule where partno ='{$partno}'
                                and custpo ='{$cek_total[0]->jknpo}' ");

    

            if (!$param) {
                return response()
                    ->json([
                        'success' => false,
                        'message' => 'MODEL NOT EXIST IN SCHEDULE...',

                    ]);
            }
                        // GET PARAM BASE SCAN LABEL
            $dest      =   $param[0]->dest;
            $custpo    =   $param[0]->custpo;
            $partname  =   $param[0]->partname;
            $shelfno   =   $param[0]->shelfno;



            // STEP 2. INSERT DATA KE TABLE SCAN IN
            DB::connection('sqlsrv')
                ->insert("INSERT into inhouse_scanin(partno,lotno,qty_input,label,type,pic,idnumber,jknpo,partname,dest)
                            SELECT '{$partno}','{$prodno}','{$qty}','{$assylabel}','{$type}','{$pic}','{$idnumber}','{$cek_total[0]->jknpo}','{$partname}','{$dest}'
                            ");

            // STEP 3. UPDATE DATA ASSY LIST
           $data2 =  DB::connection('sqlsrv')
                ->update("UPDATE inhouse_list
                            set
                            tot_input =  (SELECT sum(qty_input) FROM inhouse_scanin as b 
                                            where
                                            inhouse_list.lotno = b.lotno
                                            and  
                                            inhouse_list.model = b.partno
                                            and 
                                            inhouse_list.jknpo = b.jknpo
                                            ),
                            balance =  inhouse_list.shipqty -  ( inhouse_list.tot_input + {$qty}) 
                            from inhouse_scanin as b where
                            inhouse_list.id = '{$cek_total[0]->id}'

                        ");



            $data = DB::connection('sqlsrv')
                ->select("SELECT * from inhouse_list where lotno ='{$prodno}'
                           and model ='{$partno}'");

            

                $sum = array($cek_total[0]->tot_input, $qty);
                $act_qty = array_sum($sum);

                // TAMPILKAN DATA HASIL SCANIN
                    if (($act_qty  == $cek_total[0]->shipqty)) {
                        return response()
                            ->json([
                                'success' => false,
                                'message' => 'DEMAND COMPLETE...',
                                'data'    => $data

                            ]);
                    }

            return response()->json([
                'success' => TRUE,
                'message' => 'Scan Sucessfully',
                'data'     => $data
            ]);
        }
    }

    public function input_inhouse(request $request)
    {

        // return $request;
        $currentDate = Carbon::now();


        $dateAsNumber = $currentDate->format('Ymd');
        $date = substr($dateAsNumber, 2, 8);


        $get_id = DB::table('inhouse_scanin')
            ->whereDate('created_at', $currentDate)
            ->max('id');




        $order = $get_id ? $get_id + 1 : 1;
        $idnumber ='I' . $date . str_pad($order, 4, '0', STR_PAD_LEFT);

        // return $idnumber;


        $pic       = $request->pic;
        $model       = $request->model;
        // $jknpo       = $request->jknpo;
        $lotno       = $request->lotno;
        $qty       = $request->qty;
        $type       = 'input mecha';


        // STEP 3. CEK TOTAL SCAN PART UNTUK DI UPDATE DATA
        $cek_total = DB::connection('sqlsrv')
            ->select("SELECT top 1 * from inhouse_list
                    where  model = '{$model}' 
                    and lotno='{$lotno}'
                    and shipqty >= (coalesce(tot_input,0) + $qty)
                      order by jknpo asc
                    ");

        $sum = array($cek_total[0]->tot_input, $qty);

        $act_qty = array_sum($sum);

        if (($act_qty  > $cek_total[0]->shipqty)) {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'OVER QTY...',

                ]);
        }

        // STEP 2. INSERT DATA KE TABLE SCAN IN
        DB::connection('sqlsrv')
            ->insert("INSERT into inhouse_scanin(model,jknpo,lotno,qty_input,type,pic,idnumber)
                 SELECT '{$model}','{$cek_total[0]->jknpo}','{$lotno}','{$qty}','{$type}','{$pic}','{$idnumber}'
                 ");


        // STEP 3. UPDATE DATA ASSY LIST
        DB::connection('sqlsrv')
            ->update("UPDATE inhouse_list
                    set
                    tot_input =  (SELECT sum(qty_input) FROM inhouse_scanin as b where
                                    inhouse_list.lotno = b.lotno and inhouse_list.model = b.model
                                    and 
                                            inhouse_list.jknpo = b.jknpo),
                    balance =  inhouse_list.shipqty -  ( inhouse_list.tot_input + {$qty}) 
                            from inhouse_scanin as b where
                            inhouse_list.id = '{$cek_total[0]->id}'

                ");

 

        $data = DB::connection('sqlsrv')
            ->select("SELECT * from inhouse_list where lotno ='{$lotno}'");
       
       
            return response()

            ->json([
                'success' => true,
                'message' => 'Input Data success...',
                'data'    => $data

            ]);
       



    }

    public function inhouse_data()
    {


        $data = DB::connection('sqlsrv')
            ->select("SELECT * FROM inhouse_list");

        return view('partlist.inhouse_data', compact('data'));
    }
}
