<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
class PartlistController extends Controller
{
    public function index(){

        $data = DB::table('partlist')
        ->get();

        $dataprodno=DB::connection('sqlsrv')
        ->select("SELECT distinct (prodno) from partlist");

        $datajkeipo=DB::connection('sqlsrv')
        ->select("SELECT distinct (jkeipodate) from partlist");

        $qrcode =DB::connection('sqlsrv')
        ->select("SELECT top 1 * from partlist");

        // if(!empty($request)){
        //     $dataprodno = $request;
        // }
    //    $filterprodno = $this->filterProdno();

        $partlistno = DB::connection('sqlsrv')
        ->select("SELECT distinct(partlist_no) from partlist ");

    //  return $qrdata;
     // Membuat QR code dari konten tabel
    //  $qrCode = QrCode::size(200)->generate($dataQR);

        return view('partlist.index', compact('data','dataprodno','qrcode','partlistno'));
    }


    public function filterProdno(Request $request){

        // return $request;s

        $prodNo = $request->input('prodno');
        $jkeipo= $request->input('jkeipodate');

        $data = DB::table('partlist')
        ->distinct('prodno')
        ->where('prodno','=',  $prodNo)
        ->get();

        // $data2 = DB::table('partlist')
        // ->distinct('partlist_no')
        // ->where('prodno','=',  $prodNo)
        // ->get();
        // $partlistno = "a";

        $qr = $data[0]->partlist_no;


        // dd($distinct);

        $dataNew = [$data, $qr];


        return response()->json([
            "data" => $data,
            "qr" => $qr
        ]);


    }



    public function filter_scan(Request $request){


        $partlistNo= $request->partlist_no;

        $data= DB::table('partlist')
        ->where('partlist_no','=',  $partlistNo)
        ->get();

        $cek_partlist = DB::connection('sqlsrv')
        ->select("SELECT * FROM partlist where partlist_no ='{$partlistNo}'");


        if(empty($cek_partlist))
            {
                return response()->json(['success' => false,
                'message' => 'Part list Not Available...']);
            }
        else{
            return response()->json($data);

        }


    }



    public function scan_issue(Request $request, $status_print=null){

        $scan_nik = $request ->scan_nik;
        $scan_label = $request->scan_label;

        //PARAM LABEL
        $label_scan = substr($scan_label,0,15);
        $qty = substr($scan_label, 24,5);
        $unique = substr($scan_label,28,49);

        $cek_part = DB::connection('sqlsrv')
                    ->select("SELECT * FROM partlist where partno ='{$label_scan}'");

        // STEP  CEK PART
        if (!$cek_part) {
            return response()->json(['success' => false,
            'message' => 'WRONG PART...']);
        }


        // =========STEP 1. CEK LABEL/UNIQUE ID PART PADA PARTSCAN TABLE
        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT unique_id from partscan where unique_id ='{$unique}'");

        if($cek_label){
            return response()
                ->json([
                    'success' => false,
                    'message' => 'DOUBLE SCAN...',
                    
                ]);
        }

        $selectPart = DB::connection('sqlsrv')
                        ->select("SELECT top 1 * from partlist
                                  where  partno = '{$label_scan}'
                                  and demand >= (coalesce(tot_scan,0) + $qty)
                                  order by custpo asc");

        $cek_continue = DB::connection('sqlsrv')
                        ->select("SELECT count(*) as continue_status from partscan where partno = '{$label_scan}' and status_print = 'continue'");

        // return $cek_continue;

        // cek qty scan < stdpack
        if(($qty < $selectPart[0]->stdpack && $status_print==null) or ($cek_continue == NULL && $status_print==null)){
            return response()
            ->json([
                'success' => false,
                'message' => 'Loose Carton ?'
            ]);
        }


        // GET ID PRINT
        $currentDate = Carbon::now();
        $dateAsNumber = $currentDate->format('Ymd');
        $date = substr($dateAsNumber,2,8);


        $get_id = DB::table('partscan')
                    ->whereDate('scan_date',$currentDate)
                    ->max('id');

        $order = $get_id ? $get_id + 1 : 1;
        $idnumber = $date . str_pad($order, 4, '0', STR_PAD_LEFT);

        // simpan data ke partscan + UPDATE STATUS PRINT
        if(!empty(@$status_print)){
            DB::connection('sqlsrv')
            ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                    ,orderitem,custpo,partno,partname,label,demand,unique_id,stdpack,scan_issue, scan_nik, status_print,idnumber)
                    select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                    orderitem,custpo,partno, partname,'{$scan_label}', demand,'{$unique}', stdpack,'{$qty}', '{$scan_nik}','{$status_print}','{$idnumber}'
                    from partlist
                    where partno = '{$label_scan}'
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

            $data = DB::connection('sqlsrv')
            ->select("SELECT * from partlist where partno ='{$label_scan}'");
                return response()
                ->json([
                    'success' => true,
                    'message' => 'Scan Succesfully',
                    'data'      =>$data
                   

                ]);
        }
        else{
            DB::connection('sqlsrv')
            ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                    ,orderitem,custpo,partno,partname,label,demand,unique_id,stdpack,scan_issue, scan_nik,idnumber)
                    select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                    orderitem,custpo,partno, partname,'{$scan_label}', demand,'{$unique}', stdpack,'{$qty}', '{$scan_nik}','{$idnumber}'
                    from partlist
                    where partno = '{$label_scan}'
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
        ->select("SELECT * from partlist where partno ='{$label_scan}'");
       

        // GET PARTLIST NO
        $partlistno   =   $param[0]->partlist_no;    

     

        $data = DB::connection('sqlsrv')
        ->select("SELECT * from partlist where partlist_no='{$partlistno}'");

        // return $data;

              return response()
                ->json([
                    'success' => true,
                    'message' => 'Scan Succesfully',
                    'data'     =>$data

                ]);
                               
        }

       

        // return response()->json($data);
       


        //    SAMPLE :: K2K-0165-02     1708159 40     I10816 K2K-0165-02    202301250432102198000001
    }


    // INSERT KE PARTSCAN DAN CEK LOOSE CARTON LAGI
    public function looseCarton(Request $request){

        // return $request;
        $this->scan_issue($request,"loosecarton");
    }

    public function scan_continue(Request $request){
        $this->scan_issue($request,"continue");
    }

    public function looseCarton_backup(Request $request){

        $scan_nik = $request ->scan_nik;
        $scan_label = $request->scan_label;

        //PARAM LABEL
        $label_scan = substr($scan_label,0,15);
        $qty = substr($scan_label, 24,5);
        $unique = substr($scan_label,28,49);
        $status_print ='loosecarton';

        $cek_part =DB::connection('sqlsrv')
                    ->select("SELECT * FROM partlist where partno ='{$label_scan}'");

        // STEP  CEK PART
        if (!$cek_part) {
            return response()->json(['success' => false,
            'message' => 'WRONG PART...']);
        }


        // =========STEP 1. CEK LABEL/UNIQUE ID PART PADA PARTSCAN TABLE
        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT unique_id from partscan where unique_id ='{$unique}'");


        $selectPart = DB::connection('sqlsrv')
                        ->select("SELECT top 1 * from partlist
                                  where  partno = '{$label_scan}'
                                  and demand >= (coalesce(tot_scan,0) + $qty )
                                  order by custpo asc");

        if(empty($cek_label)){
            DB::connection('sqlsrv')
            // Insert into Partscan
            ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                    ,orderitem,custpo,partno,partname,label,demand,status_print,unique_id,stdpack,scan_issue, scan_nik)
                    select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                    orderitem,custpo,partno, partname,'{$scan_label}', demand,'{$status_print}','{$unique}', stdpack,'{$qty}', '{$scan_nik}'
                    from partlist
                    where partno = '{$label_scan}'
                    and  (coalesce(tot_scan,0)+{$qty}) <= demand
                    order by custpo asc ");



                    DB::connection('sqlsrv')
                    ->update("UPDATE partlist set tot_scan = (SELECT sum(scan_issue) FROM partscan as b where
                                b.partno = partlist.partno and b.custpo = partlist.custpo
                                ),
                                status_scan ='1',
                                balance_issue = partlist.demand - (partlist.tot_scan + {$qty})
                                    from partscan as b where
                                    partlist.id = '{$selectPart[0]->id}'

                            ");

                    return response()->json(['success' => true,
                    'message' => 'Scan Succesfully']);

            // cek qty scan < stdpack
                if($qty < $selectPart[0]->stdpack){
                    return response()->json(['success' => false,
                                             'message' => 'Loose Carton?']);
                }


        }

    }

    public function scan_continue_backup(Request $request){

        $scan_nik = $request ->scan_nik;
        $scan_label = $request->scan_label;


        $label_scan = substr($scan_label,0,15);
        $qty = substr($scan_label, 24,5);
        $unique = substr($scan_label,28,49);
        $status_scan ='continue';

        $cek_part =DB::connection('sqlsrv')
                    ->select("SELECT * FROM partlist where partno ='{$label_scan}'");

        // STEP  CEK PART
        if (!$cek_part) {
            return response()->json(['success' => false,
            'message' => 'WRONG PART...']);
        }


        // =========STEP 1. CEK LABEL/UNIQUE ID PART PADA PARTSCAN TABLE
        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT unique_id from partscan where unique_id ='{$unique}'");


        $selectPart = DB::connection('sqlsrv')
                        ->select("SELECT top 1 * from partlist
                                  where  partno = '{$label_scan}'
                                  and demand >= (coalesce(tot_scan,0) + $qty )
                                  order by custpo asc");

        if(empty($cek_label)){
            DB::connection('sqlsrv')
            // Insert into Partscan
            ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                    ,orderitem,custpo,partno,partname,label,demand,status_scan,unique_id,stdpack,scan_issue, scan_nik)
                    select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                    orderitem,custpo,partno, partname,'{$scan_label}', demand,'{$status_scan}','{$unique}', stdpack,'{$qty}', '{$scan_nik}'
                    from partlist
                    where partno = '{$label_scan}'
                    and  (coalesce(tot_scan,0)+{$qty}) <= demand
                    order by custpo asc ");



                    DB::connection('sqlsrv')
                    ->update("UPDATE partlist set tot_scan = (SELECT sum(scan_issue) FROM partscan as b where
                                b.partno = partlist.partno and b.custpo = partlist.custpo
                                ),
                                status_scan ='1',
                                balance_issue = partlist.demand - (partlist.tot_scan + {$qty})
                                    from partscan as b where
                                    partlist.id = '{$selectPart[0]->id}'

                            ");

                    return response()->json(['success' => true,
                    'message' => 'Scan Succesfully']);

            // cek qty scan < stdpack
                if($qty < $selectPart[0]->stdpack){
                    return response()->json(['success' => false,
                                             'message' => 'Loose Carton?']);
                }


    }
}


}
