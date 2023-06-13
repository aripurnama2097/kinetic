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

    //     $partlistno = DB::connection('sqlsrv')
    //     ->select("SELECT partlist_no from partlist where partlist_no ='{$filterprodno}' ");

    //  return $qrdata;
     // Membuat QR code dari konten tabel
    //  $qrCode = QrCode::size(200)->generate($dataQR);

        return view('partlist.index', compact('data','dataprodno','qrcode'));
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
       
        
        // STEP  CEK PART
        if (!$cek_part) {
            return response()->json("Wrong Part!!!");
        }
       
        // =========STEP 1. CEK DEMAND  PARTNO PADA PARLIST 

        $cek_label = DB::connection('sqlsrv')
                    ->select("SELECT label from partscan where label ='{$scan_label}'");
        
        $cek_total = DB::connection('sqlsrv')
                        ->select("SELECT   top 1 * from partlist 
                                where  partno = '{$label_scan}'
                                  and demand >= (coalesce(tot_scan,0) + $qty)

                                order by custpo asc");

            
        // return response()->json($cek_total);

        // CEK QTY SCAN ISSUE SESUAI STD PACK/TIDAK
        // $cek_scan = DB::connection('sqlsrv')
        //                 ->select("SELECT scan_issue from partscan where sum(scan_issue) = demand");

        
        if($cek_total[0]->tot_scan == $cek_total[0]->demand ){
            // $response = [
            //     'status' => 'success',
            //     'message' => 'Scan Finish'
            // ];
            return response()->json("Scan Finish");
        }
        if($cek_total[0]->tot_scan >= $cek_total[0]->demand ){
            // $response = [
            //     'status' => 'success',
            //     'message' => 'Qty Over'
            // ];
            return response()->json("Qty Over, Please Check again");
        }

        if(empty($cek_label)){
            if($cek_total == TRUE){
                // =========STEP 2. INSERT DATA KE PARTSCAN TABLE

                // $sum_scan = DB::connection('sqlsrv')
                //                 ->select("SELECT sum(scan_issue) from partlist where ");

                $data = DB::connection('sqlsrv')
                        ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                                ,orderitem,custpo,partno,partname,label,demand,unique_id,stdpack,scan_issue, scan_nik)
                                select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                                orderitem,custpo,partno, partname,'{$scan_label}', demand,'{$unique}', stdpack,'{$qty}', '{$scan_nik}'
                                from partlist 
                                where partno = '{$label_scan}' 
                                and  coalesce(tot_scan,0) <= demand
                                order by custpo asc ");


                    // $data = DB::connection('sqlsrv')
                    // ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                    //         ,orderitem,custpo,partno,partname,label,demand,unique_id,stdpack,scan_issue, scan_nik)
                    //         select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                    //         orderitem,custpo,partno, partname,'{$scan_label}', demand,'{$unique}', stdpack,'{$qty}', '{$scan_nik}'
                    //         from partlist 
                    //         where partno = '{$label_scan}' 
                    //         and  coalesce(tot_scan,0) < demand
                    //         order by custpo asc ");
    
                        // STEP 3. UPDATE PARTNO PADA PARLIST BERDASARKAN DATA PARTSCAN
                        DB::connection('sqlsrv')
                        ->update("UPDATE partlist set tot_scan = (SELECT sum(scan_issue) FROM partscan as b where  
                                b.partno = partlist.partno and b.custpo = partlist.custpo
                                ),status_scan ='1' ");
                
              

               return response()->json(['success' => true, 'message' => 'Continue Scan']); 
             
                dd($cek_total);
            
            }

        }

        else{
            return response()->json(['error' => true, 'message' => 'Double Scan']);   
        }

    //    return response()->json([$message]);

        // return response()->json($data);
    //    SAMPLE :: K2K-0165-02     1708159 40     I10816 K2K-0165-02    202301250432102198000001
       

    }
}
