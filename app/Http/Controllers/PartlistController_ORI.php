<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        //  ->select(DB::raw('*, @rownum := @rownum + 1 AS nomor_urut'))
        // ->crossJoin(DB::raw('(SELECT @rownum := 0) r'))
        ->where('prodno','=',  $prodNo)
        // ->where('jkeipodate','=',$jkeipo)
        ->get();

           return response()->json($data);
    }



    public function filter_scan(Request $request){


        $partlistNo= $request->partlist_no;

        $data= DB::table('partlist')
        ->where('partlist_no','=',  $partlistNo)
        ->get();

        $cek_partlist = DB::connection('sqlsrv')
        ->select("SELECT * FROM partlist where partlist_no ='{$partlistNo}'");


        // if(empty($cek_partlist))
        //     {
        //     echo "<h1>Partlist number not available</h1>";
        //     return false;
        //     }
        // else{
        //     echo "<h1 >Partlist number available</h1>";
        //    return response()->json($data);

        // }

        // $success = true; // Set based on your logic
        // $message = $success ? "Request succeeded!" : "Request failed!";
        // $error = $error ? null : "Some error message";

        // Create the response
        // $data= [
        //     'success' => $success,
        //     'message' => $message,
        //     'error' => $error,
        //     'dataScan' =>$dataScan
        // ];

        // Return the response in JSON format
        return response()->json($data);
    }



    public function scan_issue(Request $request){

        $scan_nik = $request ->scan_nik;
        $scan_label = $request->scan_label;

        //PARAM LABEL
        $label_scan = substr($scan_label,0,11);
        $qty = substr($scan_label, 24,5);
        $unique = substr($scan_label,28,49);

        $cek_part =DB::connection('sqlsrv')
                    ->select("SELECT * FROM partlist where partno ='{$label_scan}'");

        // $cek_std_part = DB::connection('sqlsrv')
        //             ->select ("SELECT * FROM partlist where stdpack = '{$qty}'");

        // dd($cek_std_part);


        // STEP  CEK PART
        if (!$cek_part) {
            return response()->json(['success' => false,
            'message' => 'wrong part...']);
        }

        // =========STEP 1. CEK LABEL/UNIQUE ID PART PADA PARTSCAN TABLE
        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT unique_id from partscan where unique_id ='{$unique}'");
        
        


        $selectPart = DB::connection('sqlsrv')
                        ->select("SELECT top 1 * from partlist
                                  where  partno = '{$label_scan}'
                                  and demand >= (coalesce(tot_scan,0) + $qty)
                                  order by custpo asc");

        // $cek_demand =DB::connection('sqlsrv')
        //               ->select ("SELECT top 1 * from partlist
        //                         where  partno = '{$label_scan}'
        //                         and demand = tot_scan
        //                         order by custpo asc");

        if(empty($cek_label)){

             // =========STEP 2. CEK  QTY PART SESUAI STD PACK
            if(($selectPart == TRUE) ){
                 // =========STEP 3. INSERT DATA KE PARTSCAN TABLE
                $data = DB::connection('sqlsrv')
                ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                        ,orderitem,custpo,partno,partname,label,demand,unique_id,stdpack,scan_issue, scan_nik)
                        select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                        orderitem,custpo,partno, partname,'{$scan_label}', demand,'{$unique}', stdpack,'{$qty}', '{$scan_nik}'
                        from partlist
                        where partno = '{$label_scan}'
                        and  (coalesce(tot_scan,0)+{$qty}) <= demand
                        -- and  stdpack = '{$qty}'
                        order by custpo asc ");


                // =========STEP 4. UPDATE DATA PARTLIST
                DB::connection('sqlsrv')
                ->update("UPDATE partlist set tot_scan = (SELECT sum(scan_issue) FROM partscan as b where
                            b.partno = partlist.partno and b.custpo = partlist.custpo
                            ),
                            status_scan ='1',
                             balance_issue = partlist.demand - (partlist.tot_scan + {$qty})
                                from partscan as b where
                                 partlist.id = '{$selectPart[0]->id}'
                                --   b.partno = partlist.partno and b.custpo = partlist.custpo
                                --  and  (coalesce(partlist.tot_scan,0 ) + $qty) < partlist.demand

                        ");
                        return response()->json(['success' => true,
                                                 'message' => 'Scan OK...']);

                }

                else{
                    return response()->json(['success' => false,
                    'message' => 'Qty Over']);

                }


        }

        else{
            return response()->json(['success' => false,
                                     'message' => 'Double Scan...']);
        }


    //    SAMPLE :: K2K-0165-02     1708159 40     I10816 K2K-0165-02    202301250432102198000001


    }
}
