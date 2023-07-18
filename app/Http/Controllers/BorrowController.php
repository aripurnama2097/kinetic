<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class BorrowController extends Controller
{
    public function index(){

        return  view('borrow.index');
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
                ->insert("INSERT into borrow(custpo,partno,qty,symptom,borrower,lender,dateout,status,dept,reason,est_return)
                        SELECT '{$custpo}','{$partno}','{$qty}','{$symptom}','{$borrower}','{$lender}','{$outdate}','{$status}','{$dept}',
                        '{$reason}','{$est_return}'
                        ");
 
                // STEP 1.B INSERT DATA KE TABEL BORROW
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

            return response()
                    ->json(['success'=>TRUE,
                            'message'=>'Create Data Successfully',
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


                    return response()
                    ->json(['success'=>TRUE,
                            'message'=>'Create Data Successfully',
                    ]);
        }





        // // STEP 2. UPDATE DATA DI FINISH GOOD MENU
        //     $update =    DB::connection('sqlsrv')
        //     ->update("UPDATE finishgood_list 
        //                             SET act_running = (act_running - '{$qty}'), bal_running = (bal_running + '{$qty}')
        //                                         where 
        //                             partno = '{$partno}'  and  custpo = '{$custpo}'
                                    
        //                              ") ;
        // // STEP 3. JIKA QTY RETURN PART TIDAK SAMA DENGAN QTY BORROW  => RESET DATA DARI PROSES MC - FG


        //  return response()
        //         ->json(['success'=>TRUE,
        //         'message'=>'Create Data Successfully',
        //         ]);
    }

    public function return(request $request){

     
        $dic_return = $request->dic_return;
        $receiver = $request->receiver;
        $remark = $request->remark;
        $kitLabel = $request->label_kit;
        $actreturn_date = Carbon::now();    

        $datakit = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $datakit);


        // STEP 1. UPDATE DATA KE BORROW
            DB::connection('sqlsrv')
                ->update("UPDATE borrow 
                            set
                            dic_return = '{$dic_return}', receiver ='{$receiver}', remark = '{$remark}', act_return ='{$actreturn_date}', tot_return ='{$qty}',
                            diff = (qty - $qty)
                            where partno = '{$partno}' and custpo ='{$custpo}'
                        ");



        // STEP 2. UPDATE DATA DI FINISH GOOD MENU
            $update =    DB::connection('sqlsrv')
                ->update("UPDATE finishgood_list 
                                        SET act_running = (act_running + '{$qty}'), bal_running = (bal_running - '{$qty}')
                                                    where 
                                        partno = '{$partno}'  and  custpo = '{$custpo}'
                                        
                                        ") ;

        // STEP 3. JIKA QTY RETURN PART TIDAK SAMA DENGAN QTY BORROW  => RESET DATA DARI PROSES MC - FG


         return response()
                ->json(['success'=>TRUE,
                'message'=>'Create Data Successfully',
                ]);
    }
}
