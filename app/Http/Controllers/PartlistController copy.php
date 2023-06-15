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
        ->where('prodno','=',  $prodNo)
        // ->where('jkeipodate','=',$jkeipo)    
        ->get();

           return response()->json($data);
    }



    public function filter_scan(Request $request){

        // return $request;

         $success = true;
         $error = false;
        $partlistNo= $request->partlist_no;

        $dataScan = DB::table('partlist')
        ->where('partlist_no','=',  $partlistNo)    
        ->get();
        
        if(empty($dataScan)){
            $success = false;
            $error = "Some error message";
        }
        $message = $success ? "Request succeeded!" : "Request failed!";

        // $success = true; // Set based on your logic
        // $message = $success ? "Request succeeded!" : "Request failed!";
        // $error = $error ? null : "Some error message";
    
        // Create the response
        $data= [
            'success' => $success,
            'message' => $message,
            'error' => $error,
            'dataScan' =>$dataScan
        ];
    
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

    //  try {
        if ($cek_part) {
            $message = "Part No  $label_scan  ditemukan!";

        // =========STEP 1. INSERT DATA KE PARTSCAN TABLE
           $data = DB::connection('sqlsrv')
            ->insert("INSERT into partscan(custcode, dest,model, prodno, vandate, dateissue,partlist_no
                        ,orderitem,custpo,partno,partname,label,demand,unique_id,stdpack,scan_issue, scan_nik)
                        select top 1 custcode,dest, model,prodno,vandate,date_issue,partlist_no,
                        orderitem,custpo,partno, partname,'{$scan_label}', demand,'{$unique}', stdpack,'{$qty}', '{$scan_nik}'
                        from partlist 
                        where partno = '{$label_scan}' 
                        and  tot_scan <= demand
                        order by custpo asc ");

            // $data_partlist = DB::connection('sqlsrv')
            // ->select("SELECT a.partlist_no, a.custpo from partlist as a
			// where partno ='{$label_scan}' ");

	    // =========STEP 2. CEK DEMAND PADA PARTNO PADA PARLIST UNTUK DIUPDATE
            $cek_demand = "SELECT   top 1 * from partlist 
                            where  partno = '{$label_scan}'
                            and tot_scan <= demand
                            order by custpo asc";
        
            if($cek_demand){
  // =========STEP 3. UPDATE PARTNO PADA PARLIST UNTUK DIUPDATE
                DB::connection('sqlsrv')
                ->update("UPDATE partlist set tot_scan = (SELECT sum(scan_issue) FROM partscan as b where  
                          b.partno = partlist.partno and b.custpo = partlist.custpo
                          ),status_scan ='1' ");
            }
	
            
                                    

            // $result = DB::connection('sqlsrv')
            //     ->select("EXEC updatepartlist '{$scan_label}', '{$unique}', '{$qty}',
            //             '{$label_scan}', '{$data_partlist[0]->partlist_no}','{$data_partlist[0]->custpo}', '{$scan_nik}' ");



        } 
        else {
            $message = "Part No  $label_scan  tidak ditemukan!";
        }

      
    //  } catch (Exception $e) {
    //     echo $e->errorMessage();
    //  }
       

        return response()->json($message);
    }
}
