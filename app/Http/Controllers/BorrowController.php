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


        // STEP 1. INSERT DATA KE BORROW
            DB::connection('sqlsrv')
                ->insert("INSERT into borrow(custpo,partno,qty,symptom,borrower,lender,dateout,status,dept,reason,est_return)
                        SELECT '{$custpo}','{$partno}','{$qty}','{$symptom}','{$borrower}','{$lender}','{$outdate}','{$status}','{$dept}',
                        '{$reason}','{$est_return}'
                        ");

        // STEP 2. UPDATE DATA DI FINISH GOOD MENU
            $update =    DB::connection('sqlsrv')
            ->update("UPDATE finishgood_list 
                                    SET act_running = (act_running - '{$qty}'), bal_running = (bal_running + '{$qty}')
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
