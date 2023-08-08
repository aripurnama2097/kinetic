<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class BorrowController extends Controller
{
    public function index(){

        $data = DB::table('borrow')
                 ->paginate(10);

        return  view('borrow.index',compact('data'));
    }

    public function takeout(request $request){

     
        $borrower = $request->borrower;
        $lender = $request->lender;
        $status = $request->status;
        $dept = $request->dept;
        $reason = $request->reason;
        $symptom = $request->symptom;
        $est_return = $request->est_return;
        $kitLabel = $request->scan_label;
        $outdate = Carbon::now();    

        $datakit = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $datakit);

        // STEP 1. CEK DATA PARTNO DI TABLE BORROW
        $cekpart = DB::connection('sqlsrv')
                    ->select("SELECT * from borrow where partno ='{$partno}'
                                and custpo ='{$custpo}'");
        
          // STEP 1. CEK DATA PARTNO DI TABLE BORROW
        $getprodno = DB::connection('sqlsrv')
          ->select("SELECT distinct(prodno) from schedule where custpo ='{$custpo}'");


        // STEP 2. CEK LABEL/UNIQUE ID PART PADA BORROW DETAIL TABLE
        $cek_label = DB::connection('sqlsrv')
        ->select("SELECT label from borrow_detail where label ='{$kitLabel}'");

        if($cek_label){
                return response()
                        ->json([
                        'success' => false,
                        'message' => 'DOUBLE SCAN...',

        ]);
        }

        // PART BELUM ADA DITABLE BORROW
        if(!$cekpart){
                // STEP 1.A INSERT DATA KE TABEL BORROW
                DB::connection('sqlsrv')
                ->insert("INSERT into borrow(custpo,prodno,partno,qty,symptom,borrower,lender,dateout,status,dept,reason,est_return)
                        SELECT '{$custpo}','{$getprodno[0]->prodno}','{$partno}','{$qty}','{$symptom}','{$borrower}','{$lender}','{$outdate}','{$status}','{$dept}',
                        '{$reason}','{$est_return}'
                        ");
 
                // STEP 1.B INSERT DATA KE TABEL BORROW DETAIL
                DB::connection('sqlsrv')
                ->insert("INSERT into borrow_detail(custpo,partno,qty,label,symptom,borrower,lender,dateout,status,dept,reason,est_return)
                        SELECT '{$custpo}','{$partno}','{$qty}','{$kitLabel}','{$symptom}','{$borrower}','{$lender}','{$outdate}','{$status}','{$dept}',
                        '{$reason}','{$est_return}'
                        ");

                // STEP 1.C UPDATE DATA DI FINISH GOOD MENU
                $update =    DB::connection('sqlsrv')
                ->update("UPDATE finishgood_list 
                                        SET act_running = (act_running - '{$qty}'), bal_running = (bal_running + '{$qty}')
                                                    where 
                                        partno = '{$partno}'  and  custpo = '{$custpo}'
                                        
                                        ") ;

            $data = DB::connection('sqlsrv')
            ->select("SELECT * FROM borrow where  partno = '{$partno}'  and  custpo = '{$custpo}'");

            return response()
                    ->json(['success'=>TRUE,
                            'message'=>'Create Data Successfully',
                            'data'   => $data
                    ]);

        }

        else{
           
              // STEP 1.A UPDATE DATA BORROW TABLE
              $update_borrow  =    DB::connection('sqlsrv')
                ->update("UPDATE borrow 
                            set
                            qty = (qty + '{$qty}')
                            where partno = '{$partno}' and custpo ='{$custpo}'
                      ");


                // STEP 1.B INSERT DATA KE TABEL BORROW DETAIL
                DB::connection('sqlsrv')
                ->insert("INSERT into borrow_detail(custpo,partno,qty,label,symptom,borrower,lender,dateout,status,dept,reason,est_return)
                        SELECT '{$custpo}','{$partno}','{$qty}','{$kitLabel}','{$symptom}','{$borrower}','{$lender}','{$outdate}','{$status}','{$dept}',
                        '{$reason}','{$est_return}'
                        ");




                // STEP 1.C UPDATE DATA DI FINISH GOOD MENU
                $update =    DB::connection('sqlsrv')
                ->update("UPDATE finishgood_list 
                                        SET act_running = (act_running - '{$qty}'), bal_running = (bal_running + '{$qty}')
                                                    where 
                                        partno = '{$partno}'  and  custpo = '{$custpo}'
                                        
                                        ") ;



                $data = DB::connection('sqlsrv')
                ->select("SELECT * FROM borrow where  partno = '{$partno}'  and  custpo = '{$custpo}'");

                    return response()
                    ->json(['success'=>TRUE,
                            'message'=>'Create Data Successfully',
                            'data'   =>$data
                    ]);
        }



    }

    public function return(request $request){

     
        $dic_return = $request->dic_return;
        $receiver = $request->receiver;
        $remark = $request->remark;
        $kitLabel = $request->label_kit;
        $actreturn_date = Carbon::now();    

        $datakit = $kitLabel;
        list($partno, $partname, $qtyscan, $dest, $custpo, $shelfno, $idnumber) = explode(":", $datakit);



           // STEP 2. CEK LABEL/UNIQUE ID PART PADA BORROW DETAIL TABLE
           $cek_label = DB::connection('sqlsrv')
           ->select("SELECT label_return from borrow_detail where label_return ='{$kitLabel}'");
   
           if($cek_label){
                   return response()
                           ->json([
                           'success' => false,
                           'message' => 'DOUBLE SCAN, PART AFTER RETURN..',
   
           ]);
           }

        // STEP 1. UPDATE DATA KE BORROW DETAIL
        DB::connection('sqlsrv')
        ->update("UPDATE borrow_detail
                    set
                    label_return ='{$kitLabel}', dic_return = '{$dic_return}', receiver ='{$receiver}', remark = '{$remark}', act_return ='{$actreturn_date}',
                    tot_return = '{$qtyscan}',
                    diff = (qty - {$qtyscan})
                    where label = '{$kitLabel}' and custpo ='{$custpo}'
                ");

        // STEP 2. UPDATE DATA KE BORROW
            DB::connection('sqlsrv')
                ->update("UPDATE borrow 
                            set
                            dic_return = '{$dic_return}', receiver ='{$receiver}', remark = '{$remark}', act_return ='{$actreturn_date}',
                            tot_return =(
                                SELECT sum(tot_return) FROM borrow_detail as b where
                                b.partno = borrow.partno and b.custpo = borrow.custpo),
                            diff = (qty -  (borrow.tot_return + {$qtyscan}))
                            where partno = '{$partno}' and custpo ='{$custpo}'
                        ");



            // STEP 3. UPDATE DATA DI FINISH GOOD MENU
            $update =    DB::connection('sqlsrv')
            ->update("UPDATE finishgood_list 
                                    SET act_running = (act_running + '{$qtyscan}'), bal_running = (bal_running - '{$qtyscan}')
                                                where 
                                    partno = '{$partno}'  and  custpo = '{$custpo}'
                                    
                                    ") ;
        
            $data = DB::connection('sqlsrv')
                        ->select("SELECT * FROM borrow where  partno = '{$partno}'  and  custpo = '{$custpo}'");

            return response()
                            ->json(['success'=>TRUE,
                                    'message'=>'Borrow return Successfully',
                                    'data'   => $data
                            ]);
                }
           

        // STEP 3. JIKA QTY RETURN PART TIDAK SAMA DENGAN QTY BORROW  => RESET DATA DARI PROSES MC - FG


        public function view_cancelation(){

                return view('borrow.view_cancelation');
        }

        public function cancelationAll(request $request){

           
        $dic = $request->dic;
        $kitLabel = $request->label_kit;
        $qty = $request->qty;   
        $lastdate = Carbon::now();    
        $remark ='cancelation';

        $datakit = $kitLabel;
        list($partno, $partname, $qtylabel, $dest, $custpo, $shelfno, $idnumber) = explode(":", $datakit);

       $prodno = DB::connection('sqlsrv')
           ->select("SELECT distinct(prodno) from schedule where custpo ='{$custpo}'");

        // dd($prodno);
        // ADD HISTORY BORROW
        $qtynew = $qtylabel - $qty;
        // STEP 1. INSERT DATA KE TABLE HISTORY CANCEL

        DB::connection('sqlsrv')
            ->insert("INSERT into tblhistory_cancelation(custpo,prodno,partno,partname,qty_label,qty,dest,shelfno,dic,split_qty,idnumber)
                        select '{$custpo}', '{$prodno[0]->prodno}','{$partno}','{$partname}','{$qtylabel}','{$qty}','{$dest}','{$shelfno}','{$dic}','{$qtynew}','{$idnumber}'
                        ");
     
        // // STEP 2. UPDATE DATA PADA MC BERDASARKAN CUSTPO DAN QTY 
        //         // 2.1 UPDATE PARTSCAN
                DB::connection('sqlsrv')
                ->update("UPDATE partscan
                                set  remark ='{$remark}',
                                last_update ='{$lastdate}',
                                scan_issue = (scan_issue - '{$qty}')
                                where  idnumber ='{$idnumber}'                
                        ");


                // 2.2 UPDATE PARTLIST
                DB::connection('sqlsrv')
                ->update("UPDATE partlist
                                set
                                balance_issue = (balance_issue + '{$qty}'),
                                tot_scan = (tot_scan - '{$qty}')
                                where  custpo ='{$custpo}'                 
                        ");




        // STEP 3. RESET DATA PADA REPACKING BERDASARKAN CUSTPO DAN QTY 
     
                DB::connection('sqlsrv')
                                ->update("UPDATE scanin_repacking
                                                set  remark ='{$remark}',
                                                last_update ='{$lastdate}',
                                                qty_receive = ( qty_receive - '{$qty}')
                                                where  label_kit ='{$kitLabel}'                
                                        ");


                DB::connection('sqlsrv')
                        ->update("UPDATE repacking_list
                                                set
                                                bal_receive = (bal_receive + '{$qty}'),
                                                act_receive= (act_receive - '{$qty}')
                                                where  custpo ='{$custpo}'                
                                ");

   
        $data = DB::connection("sqlsrv")
                        ->select("SELECT * FROM tblhistory_cancelation where custpo ='{$custpo}'");

        return response()->json([
                'success'=>TRUE,
                'message'=>'created data successfully',
                'data'=>$data
                
                  ]);

        }

         
}
