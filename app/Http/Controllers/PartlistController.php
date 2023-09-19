<?php

namespace App\Http\Controllers;

use App\Models\Partlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;

class PartlistController extends Controller
{
    public function index()
    {

        $data = DB::table('partlist')
            ->get();

        $dataprodno = DB::connection('sqlsrv')
            ->select("SELECT distinct (prodno),(created_at) from partlist 
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

        //  return $qrdata;
        // Membuat QR code dari konten tabel
        //  $qrCode = QrCode::size(200)->generate($dataQR);

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

    public function filter_scancoopy(Request $request)
    {


        $partlistNo = $request->partlist_no;

        $data = DB::table('partlist')
            ->where('partlist_no', '=',  $partlistNo)
            ->get();

        $cek_partlist = DB::connection('sqlsrv')
            ->select("SELECT * FROM partlist where partlist_no ='{$partlistNo}'");


        if (empty($cek_partlist)) {
            return response()->json([
                'success' => false,
                'message' => 'Part list Not Available...'
            ]);
        } else {
            return response()->json($data);
        }
    }



    public function scan_issue(Request $request, $status_print = null)
    {

        $partlist_no = $request->partlist_no;

        $scan_nik = $request->scan_nik;
        $scan_label = $request->scan_label;
        $label_scan = substr($scan_label, 0, 15);

        //PARAM LABEL
        $trim_label = trim($label_scan);
        $qty2 = substr($scan_label, 24, 5);
        $qty = trim($qty2);
        $unique = substr($scan_label, 28, 49);


        // STEP 1. CEK ISI PART NO DIPARTLIST
        $cek_stdpack = DB::connection('sqlsrv')
                    ->select("SELECT * FROM std_pack where partnumber ='{$label_scan}'");

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



        // STEP 4.PILIH PART UNTUK DI UPDATE DATA
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
        $get_id = DB::table('partscan')
                    ->whereDate('scan_date', $currentDate)
                    ->max('id');

        $order = $get_id ? $get_id + 1 : 1;
        $idnumber = $date . str_pad($order, 4, '0', STR_PAD_LEFT);





        //STEP 6. SIMPAN DATA  ke partscan + UPDATE STATUS PRINT
        if (!empty(@$status_print)) {


             // STEP SCAN ISSUE
            $get_lastuniq = DB::table('partscan')
                            ->max('unique_continue');

            $uniq_cont = $get_lastuniq;

            if($status_print != 'continue_combine'){
                 $uniq_cont = $get_lastuniq ? $get_lastuniq + 1 : 1;
            }

            // compare stdpack dg part continue
            if($status_print == 'continue_combine'){
                $compare_stdpack = DB::connection('sqlsrv')->select("SELECT stdpack, (sum(scan_issue))+$qty as scan_issue
                                                                        from partscan
                                                                        where unique_continue = '{$uniq_cont}'
                                                                        group by stdpack");
                $comparing = $compare_stdpack[0];
                if($comparing->scan_issue > $comparing->stdpack){
                    return false;
                }
            }

            DB::connection('sqlsrv')
                ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                                     ,orderitem,custpo,partno,partname,shelfno,label,demand,unique_id,stdpack,scan_issue, scan_nik,
                                      status_print,idnumber,unique_continue)
                          select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                                    orderitem,custpo,partno, partname,mcshelfno,'{$scan_label}', demand,'{$unique}', stdpack,'{$qty}', '{$scan_nik}','{$status_print}','{$idnumber}','{$uniq_cont}'
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


        //STEP 7. SIMPAN DATA  ke partscan + TANPA UPDATE STATUS PRINT
        else {
            DB::connection('sqlsrv')
                ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                    ,orderitem,custpo,partno,partname,shelfno,label,demand,unique_id,stdpack,scan_issue, scan_nik,idnumber)
                    select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
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

        // return "tes";
        return $this->scan_issue($request, "loosecarton");

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
    public function scan_continue(Request $request)
    {
        $this->scan_issue($request, "start_combine");

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
                'message' => 'QTY LARGER THAN STDPACK !!!'

            ]);
        }

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


    public function showscan(Request $request)
    {

        $partlistno = $request->partlist_no;
        $scan_label = $request->scan_label;
        $label_scan = substr($scan_label, 0, 15);

        $data = DB::connection('sqlsrv')
            ->select("SELECT * from partlist where partlist_no='{$partlistno}' ");

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


        $dateAsNumber = $currentDate->format('Ymd');
        $date = substr($dateAsNumber, 2, 8);


        $get_id = DB::table('inhouse_scanin')
            ->whereDate('created_at', $currentDate)
            ->max('id');
        $order = $get_id ? $get_id + 1 : 1;
        $idnumber = $date . str_pad($order, 4, '0', STR_PAD_LEFT);

        $assylabel = $request->assy_label;
        $pic       = $request->pic;
        $type       = 'scanin';

        $partno = substr($assylabel, 0, 11);
        $qty    = substr($assylabel, 11, 3);
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
                                where  model = '{$partno}' and lotno='{$prodno}'
                                ");

                                // dd($cek_total);

        if ($cek_total == false) {
            return response()->json([
                'success' => false,
                'message' => 'Part Not Exist In Master',

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
                                and prodno ='{$prodno}' ");

            // dd($param);

            // if ($param == false ) {
            //     return response()
            //         ->json([
            //             'success' => false,
            //             'message' => 'MODEL NOT EXIST IN SCHEDULE...',

            //         ]);
            // }
                        // GET PARAM BASE SCAN LABEL
            $dest      =   $param[0]->dest;
            $custpo    =   $param[0]->custpo;
            $partname  =   $param[0]->partname;
            $shelfno   =   $param[0]->shelfno;



            // STEP 2. INSERT DATA KE TABLE SCAN IN
            DB::connection('sqlsrv')
                ->insert("INSERT into inhouse_scanin(partno,lotno,qty_input,label,type,pic,idnumber,jknpo,partname,dest,shelfno)
                            SELECT '{$partno}','{$prodno}','{$qty}','{$assylabel}','{$type}','{$pic}','{$idnumber}','{$custpo}','{$partname}','{$dest}','{$shelfno}'
                            ");

            // STEP 3. UPDATE DATA ASSY LIST
            DB::connection('sqlsrv')
                ->update("UPDATE inhouse_list
                            set
                            tot_input =  (SELECT sum(qty_input) FROM inhouse_scanin as b where
                                            inhouse_list.lotno = b.lotno ),
                            balance = shipqty -  (tot_input + $qty) where
                                            inhouse_list.lotno = '{$prodno}'

                        ");


            $data = DB::connection('sqlsrv')
                ->select("SELECT * from inhouse_list where lotno ='{$prodno}'");

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
        $idnumber = $date . str_pad($order, 4, '0', STR_PAD_LEFT);

        // return $idnumber;


        $pic       = $request->pic;
        $model       = $request->model;
        // $jknpo       = $request->jknpo;
        $lotno       = $request->lotno;
        $qty       = $request->qty;
        $type       = 'input';


        // STEP 3. CEK TOTAL SCAN PART UNTUK DI UPDATE DATA
        $cek_total = DB::connection('sqlsrv')
            ->select("SELECT top 1 * from inhouse_list
                    where  model = '{$model}' and lotno='{$lotno}'
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
            ->insert("INSERT into inhouse_scanin(model,lotno,qty_input,type,pic,idnumber)
                 SELECT '{$model}','{$lotno}','{$qty}','{$type}','{$pic}','{$idnumber}'
                 ");


        // STEP 3. UPDATE DATA ASSY LIST
        DB::connection('sqlsrv')
            ->update("UPDATE inhouse_list
                    set
                    tot_input =  (SELECT sum(qty_input) FROM inhouse_scanin as b where
                                    inhouse_list.lotno = b.lotno and inhouse_list.model = b.model),
                    balance = shipqty -  (tot_input + $qty) where
                                    inhouse_list.lotno = '{$lotno}' and inhouse_list.model = '{$model}'

                ");

        $data = DB::connection('sqlsrv')
            ->select("SELECT * from inhouse_list where lotno ='{$lotno}'");
        return response()

            ->json([
                'success' => true,
                'message' => 'Input Data success...',
                'data'    => $data

            ]);
        // return redirect()->back()->with('success','Created data inhouse success!');



        //     return response()->json([
        //                         'success'=>TRUE,
        //                         'message'=>'Scan Sucessfully',
        // ]);

        // STEP 2. UPDATE ASSY LIST



    }

    public function inhouse_data()
    {


        $data = DB::connection('sqlsrv')
            ->select("SELECT * FROM inhouse_list");

        return view('partlist.inhouse_data', compact('data'));
    }
}
