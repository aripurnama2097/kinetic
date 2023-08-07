<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\TblHeaderSkid;
class FinishGoodController extends Controller
{
    public function index()
    {

        $lastOrder = DB::table('tblidbox')
        ->max('box_no');
        
  
        $boxno = $lastOrder ? $lastOrder + 1 : 1;

        // dd($boxno);

        $prodno = DB::connection('sqlsrv')
            ->select("SELECT distinct prodno from schedule");

        return view('finishgood.index', compact('prodno','boxno'));
    }


    public function scanout_box(Request $request)
    {

        $nik        = $request->scan_nik;
        $packing_no = $request->packing_no;
        $boxno      = $request->box_no;
        $prodno     = $request->prodno;
        $kitLabel   = $request->kit_label;



        // GET PARAM FROM KIT LABEL
        $data = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $data);


        // STEP 1. CEK LABEL KIT DI SCAN OUT
        $cek_label = DB::connection('sqlsrv')
            ->select("SELECT * FROM scanout where kit_label ='{$kitLabel}'");

        if ($cek_label) {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'DOUBLE SCAN...'
                ]);
        }
        // END CEK LABEL SCAN


        // ambil part dari  finishgoodlist -> kondisi part apabila  part dan custpo di list = custpo  pada kit label
        $selectPart = DB::connection('sqlsrv')
            ->select("SELECT top 1 * from finishgood_list
                   where  partno = '{$partno}'
                   and custpo ='{$custpo}'
                   and demand >= (coalesce(act_running,0) + $qty)
                   order by custpo asc");
        // return $selectPart;


        if ($selectPart == true) {
            // STEP 2.INSERT INTO SCAN OUT
            DB::connection('sqlsrv')
                ->insert("INSERT into scanout(custpo,prodno,partno, partname, qty_running,kit_label,packing_no,box_no,scan_nik) 
                    SELECT  '{$custpo}','{$prodno}','{$partno}','{$partname}','{$qty}',  '{$kitLabel}','{$packing_no}','{$boxno}', '{$nik}'
                    ");

            // STEP 3.UPDATE IN FINISH GOOD LIST     
            $update =    DB::connection('sqlsrv')
                ->update("UPDATE finishgood_list 
                                     set act_running = ( select sum(qty_running )
                                     from scanout as b where 
                                 b.partno = finishgood_list.partno  and b.custpo = finishgood_list.custpo),
                                     bal_running = finishgood_list.demand - (finishgood_list.act_running + {$qty})
                                     from scanout as b  where
                                 finishgood_list.id = '{$selectPart[0]->id}' ");

            DB::connection('sqlsrv')
               ->update("UPDATE finishgood_list 
                                set box_no = '{$boxno}',
                                packing_no = '{$packing_no}' where  finishgood_list.id = '{$selectPart[0]->id}' ");

            $viewscan = DB::connection("sqlsrv")
                            ->select("SELECT * FROM finishgood_list where custpo ='{$custpo}' ");

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Scan Success',
                    'data'    => $viewscan

                ]);
        } else {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'Part Not Match...'
                ]);
        }
    }

    public function printid_box(Request $request)
    {
        $nik        = $request->scan_nik;
        $packing_no = $request->packing_no;
        $boxno      = $request->box_no;
        $prodno     = $request->prodno;
        

       
        // STEP 1. GET PARAM CONTENT
        $param = DB::connection('sqlsrv')
            ->select("SELECT distinct dest,shipvia,vandate from schedule where prodno ='{$prodno}'");

        $param['boxno'] = $boxno;
        $param['packing_no'] = $packing_no;

        // STEP 2. INSERT INTO TBLIDBOX
        DB::connection('sqlsrv')
          ->insert("INSERT into tblidbox(packing_no,box_no,prodno,print_by)
                    select '{$packing_no}','{$boxno}','{$prodno}','{$nik}'
                    ");

      
        return view('finishgood.printid',compact('param'));


        // return redirect('finishgood/printid')->with('success');
    }

  

    public function viewSkid(){

        $currentDate = Carbon::now();     
        $date        = $currentDate->format('Ymd');      
  
  
        $lastOrder = DB::table('tblheaderskid')
        // ->where('box_no')
        ->max('skid_no');
  
        $skidno = $lastOrder ? $lastOrder + 1 : 1;

        // $skidcode = 'SKD' . $date . str_pad($order, 3, '0', STR_PAD_LEFT);


        $prodno = DB::connection('sqlsrv')
            ->select("SELECT distinct prodno from schedule");

        $dest = DB::connection('sqlsrv')
            ->select("SELECT distinct dest from schedule");

        $vandate = DB::connection('sqlsrv')
            ->select("SELECT distinct vandate from schedule");


        $headerskid = DB::connection('sqlsrv')
            ->select("SELECT * from tblheaderskid") ;

        return view('finishgood.viewSkid',compact('prodno','dest','vandate','skidno','headerskid'));
    }

    public function printSkid(Request $request)
    {
     
      $currentDate = Carbon::now();     
      $date        = $currentDate->format('Ymd');      


      $lastOrder = DB::table('tblheaderskid')
      ->whereDate('created_at',$currentDate)
      ->max('id');

      $order = $lastOrder ? $lastOrder + 1 : 1;
      
      // Generate unique number berdasarkan tanggal dan urutan
      $skidcode = 'SKD' . $date . str_pad($order, 3, '0', STR_PAD_LEFT);


        $packing_no = $request->packing_no;
        $skid_no    = $request->skid_no;
        $custpo    = $request->custpo;
        $vandate    = $request->vandate;
        $dest       = $request->dest;
        $type_skid  = $request->type_skid;

        $via = DB::connection('sqlsrv')
            ->select("SELECT shipvia from schedule where dest ='{$dest}'");

         

        // $qr = DB::connection('sqlsrv')
        //         ->select('SELECT * FROM finishgood_list where skid_no is null');

        $skidqr = DB::connection('sqlsrv')
                ->insert("INSERT into tblheaderskid(skidcode,packing_no,skid_no,custpo,vandate,dest,type_skid)
                            select '{$skidcode}','{$packing_no}', '{$skid_no}','{$custpo}','{$vandate}', '{$dest}', '{$type_skid}' ");

    

        

        return view('finishgood.printskid',compact('packing_no','skid_no','custpo','vandate','dest','type_skid','skidcode','via'));
    }

    // SCAN OUT DENGAN SKID
    public function scanout_skid(Request $request)
    {

        $nik        = $request->scan_nik;
        $qrskid     = $request->qr_skid;
        $skidheight = $request->skid_height;
        $kitLabel   = $request->kit_label;


        // GET PARAM FROM QR SKID
        
        // SKD20230712001:1:PAKISTAN:NA356:03:2022-06-17
        $qrdata = $qrskid;
        list($skidcode, $skidno, $destSkid, $packing_no, $type_skid, $vandate) = explode(":", $qrdata);

        // GET PARAM FROM KIT LABEL
        $data = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $data);


        // STEP 1. CEK LABEL KIT DI SCAN OUT
        $cek_label = DB::connection('sqlsrv')
            ->select("SELECT * FROM scanout where kit_label ='{$kitLabel}'");

        if ($cek_label) {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'DOUBLE SCAN...'
                ]);
        }
        // END CEK LABEL SCAN


        // ambil part dari  finishgoodlist -> kondisi part apabila  part dan custpo di list = custpo  pada kit label
        $selectPart = DB::connection('sqlsrv')
            ->select("SELECT top 1 * from finishgood_list
                   where  partno = '{$partno}'
                   and custpo ='{$custpo}'
                   and demand >= (coalesce(act_running,0) + $qty)
                   order by custpo asc");
        // return $selectPart;


        if ($selectPart == true) {
            // STEP 2.INSERT INTO SCAN OUT
            DB::connection('sqlsrv')
                ->insert("INSERT into scanout(custpo,partno, partname, qty_running,kit_label,packing_no,skid_no,scan_nik) 
                    SELECT  '{$custpo}','{$partno}','{$partname}','{$qty}',  '{$kitLabel}','{$packing_no}','{$skidno}', '{$nik}'
                    ");

            $seq = '1';
            // $order = $lastOrder ? $lastOrder + 1 : 1;
            // STEP 3.UPDATE IN FINISH GOOD LIST     // ADD boxno dan packing no
            $update =    DB::connection('sqlsrv')
                ->update("UPDATE finishgood_list 
                                  SET 
                                     act_running = ( select sum(qty_running )
                                     from scanout as b where 
                                 b.partno = finishgood_list.partno  and b.custpo = finishgood_list.custpo),
                                     bal_running = finishgood_list.demand - (finishgood_list.act_running + {$qty})
                                     from scanout as b  where
                                 finishgood_list.id = '{$selectPart[0]->id}' ");


               $seq1 =  DB::connection('sqlsrv')
                ->update("UPDATE finishgood_list 
                                set tot_sequence = (tot_sequence + 1) where custpo ='{$custpo}' ");
// return $seq1;
              // STEP 3.UPDATE IN FINISH GOOD LIST     
               DB::connection('sqlsrv')
              ->update("UPDATE finishgood_list 
                               set skid_no = '{$skidno}' where  finishgood_list.id = '{$selectPart[0]->id}' ");

              $view_scan = DB::connection('sqlsrv')
                            ->select("SELECT * from finishgood_list where skid_no ='{$skidno}'");

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Scan success...',
                    'data'    => $view_scan
                ]);
        } 
        
        
        else {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'OVER DEMAND...'
                ]);
        }
    }
   
    public function printMasterlist(request $request){

        $qrskid     = $request->qr_skid;

         // SKD20230712001:1:PAKISTAN:NA356:03:2022-06-17
         $qrdata = $qrskid;
         list($skidcode, $skidno, $destSkid, $packing_no, $type_skid, $vandate) = explode(":", $qrdata);

       $data =  DB::connection ('sqlsrv')
                ->select("SELECT  custpo,partno,partname,skid_no,qty_running
                                    ,(select count(qty_running) where skid_no ='{$skidno}') as tot_scan 
                                    ,(select sum(qty_running) where skid_no ='{$skidno}') as sum_total 
                            from scanout
                                    where skid_no ='{$skidno}'
                            group by
                                    custpo,partno,partname,skid_no,qty_running
                            ");

      

       return view('finishgood.printmaster',compact('data'));


    }

    public function scanout_data(){

        $data = DB::connection('sqlsrv')
        ->select("SELECT distinct a.prodno, a.custcode,a.custpo,a.vandate, a.orderitem,a.jkeipodate, a.model, a.partno,a.partname,
                    a.dest,a.demand,a.act_running,a.bal_running,b.box_no,b.skid_no  from finishgood_list as a
                    left join scanout as b 
                    on a.partno = b.partno and a.custpo = b.custpo  order by vandate asc");

        return view('finishgood.scanoutData',compact('data'));

    }

    public function view_dummy(){

        return view('finishgood.viewDummy');
    }

    public function view_check(){

        return view('finishgood.view_check');
    }

    public function check_data(request $request){

        $qrskid     = $request->qr_skid;

        // SKD20230712001:1:PAKISTAN:NA356:03:2022-06-17
        $qrdata = $qrskid;
        list($skidcode, $skidno, $destSkid, $packing_no, $type_skid, $vandate) = explode(":", $qrdata);
    
           $data =  DB::connection ('sqlsrv')
               ->select("SELECT * FROM finishgood_list where skid_no ='{$skidno}'");
    
            // return $data;

            return response()->json(['success'=>TRUE,
                                    'message'=>'Success',
                                    'data'  => $data
             ]);
    }


    public function destroy($id)
    {
        $model=DB::table('tblheaderskid')
                    ->where('id',$id)
                    ->delete();
        // $model->delete();// METHOD DELETE
        return redirect('/finishgood/viewSkid')->with('success', 'Success! Cancel Skid');
    }


    // public function destroy($id)
    // {
    //     $model=TblHeaderSkid::find($id);
    //     $model->delete();// METHOD DELETE
    //     return redirect('/stdpack')->with('success', 'Success! Data Berhasil Dihapus');
    // }


 



}
