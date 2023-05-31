<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PartlistController extends Controller
{
    public function index(){

        $data = DB::table('tblpartlist')
        ->get();

        $dataprodno=DB::connection('sqlsrv')
        ->select("SELECT distinct (prodno) from tblpartlist");

        $data4=DB::connection('sqlsrv')
        ->select("SELECT distinct (jkeipodate) from tblpartlist");

        $qrcode =DB::connection('sqlsrv')
        ->select("SELECT * from tblpartlist");

      


        // $qrcode = '';
        //      foreach ($qrcode1 as $row) {
        // $qrcode .= implode("\t", $row) . "\n";
    // }

    //    $qrdata =  QrCode::size(100)->ge  nerate('A basic example of QR code!');

    //  return $qrdata;
     // Membuat QR code dari konten tabel
    //  $qrCode = QrCode::size(200)->generate($dataQR);

        return view('partlist.index', compact('data','dataprodno','data4','qrcode'));
    }

    public function filter_scan(Request $request){

        // return $request;

        $prodNo = $request->input('prodno');
        
        $dataScan = DB::table('tblpartlist')
        ->where('prodno','=',  $prodNo)    
        ->get();
         return response()->json($dataScan);
    }


    public function filterProdno(Request $request){

        // return $request;s

        $prodNo = $request->input('prodno');
        
        $data = DB::table('tblpartlist')
        ->where('prodno','=',  $prodNo)    
        ->get();


     return response()->json($data);
    }
}
