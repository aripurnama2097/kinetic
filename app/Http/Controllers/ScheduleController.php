<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(){

        $data = DB::connection('sqlsrv')
                ->select ("SELECT a.* , b.stdpack, b.vendor, b.jknshelf from schedule as a
                left join std_pack as b 
                ON  a.partno = b.partnumber
                order by a.vandate asc");

        $data2=DB::connection('sqlsrv')
                ->select("SELECT distinct (prodno) from schedule ");

        // GENERATE PARTLIST UNTUK SCHEDULE SELAIN PAKISTAN
        $data3=DB::connection('sqlsrv')
                ->select("SELECT distinct (prodno) from schedule where dest !='PAKISTAN' 
                            and status is null");

        $dataemail = DB::connection('sqlsrv')
                ->select("SELECT * from tblemaildic");

        return view('schedule.index', compact('data','data2','data3','dataemail'));
    }


    public function filter(Request $request){

        $prodNo = $request->input('prodno');

        $data = DB::table('schedule')
        ->where('prodno','=',  $prodNo)
        ->get();

         return response()->json($data);
    }


    // GENERATE PARTLIST
    public function partlist(Request $request){


        $user = $request->input('input_user');
        $prodNo = $request->input('prodno');
        $custcode = DB::connection('sqlsrv')
        ->select("SELECT distinct custcode  from schedule where prodno ='{$prodNo}' ");

        $partlistno = $prodNo . $custcode[0]->custcode;
        $status ='success_generate';

        // STEP 1. GENERATE PARTLIST
         DB::connection('sqlsrv')
        ->insert("INSERT into partlist(custcode, dest,model,prodno,jkeipodate,vandate,partlist_no,orderitem,
                  custpo,partno,partname, demand, stdpack,balance_issue,mcshelfno,lokasi,vendor,input_user)
                  SELECT a.custcode,a.dest, a.model, a.prodno,a.jkeipodate,a.vandate,'{$partlistno}', a.orderitem,
                  a.custpo, a.partno, a.partname,  a.demand,
                  b.stdpack,a.demand, a.shelfno,b.mcshelfno,b.vendor, '{$user}' from schedule as a
                  left join std_pack as b  ON a.partno = b.partnumber
                  where a.prodno ='{$prodNo}'
                  order by a.vandate desc");

        // STEP 2. UPDATE STATUS SCHEDULE
        DB::table('schedule')
            ->where('prodno','=',$prodNo)
            ->update(['status' => $status]);
            // ->update('status','=',$status);

            


                  return redirect()->back()->with('success', 'Generate partlist success ');


    }

    public function view_schrelease(){

        $data = DB::connection('sqlsrv')
                ->select ("SELECT a.* , b.stdpack, b.vendor, b.jknshelf from schedule as a
                left join std_pack as b 
                ON  a.partno = b.partnumber
                order by a.vandate asc");

        $data2=DB::connection('sqlsrv')
        ->select("SELECT distinct (prodno) from schedule ");

        $data3=DB::connection('sqlsrv')
        ->select("SELECT distinct (prodno) from schedule where dest !='PAKISTAN' ");

        return view('schedule.release_schedule', compact('data','data2','data3'));
    }


    public function cancel_partlist(request $request){

        // return $request;

        $nik    = $request->input('input_user');
        $prodno = $request->input('prodno');
        $status = NULL;
        $date = Carbon::now();

        // STEP 1. DELETE DATA PARTLIST BASE ON PRODNO
        DB::table('partlist')
            ->where('prodno','=',$prodno)
            ->delete();


             // STEP 2. DELETE DATA PARTLIST BASE ON PRODNO
        // DB::table('schedule')
        //     ->where('prodno','=',$prodno)
        //     ->delete();


       // STEP 2. UPDATE STATUS SCHEDULE AGAR BISA DI GENERATE ULANG
        DB::table('schedule')
            ->where('prodno','=',$prodno)
            ->update(['status' => $status,
                     'pic_cancelpartlist' => $nik,
                     'updated_at'=> $date
                    ]);
            // ->update(['created_at' => $date]);

            return redirect()->back()->with('success', 'Cancel partlist success ');

    }

    public function add_dic(request $request){
        $name        = $request->name;
        $email       = $request->email;
        $inputuser   = auth()->user()->name; 

        DB::connection('sqlsrv')
            ->insert("INSERT into tblemaildic(name,email,inputuser)
                            SELECT
                            '{$name}','{$email}','$inputuser'
                   
                   
                   ");


      
            return redirect()->back()->with('success','created user successfully');
    }


    public function viewcheck_data(request $request){

        $prodno = $request->prodno;

        $data = DB::connection('sqlsrv')
                    ->select(" SELECT a.*, b.stdpack,b.vendor from schedule as a
                                left join std_pack as b 
                                    on a.partno = b.partnumber
                                        where prodno ='{$prodno}' and b.stdpack is null
                           ");

        return view('schedule.checkdata',compact('data'));
    }

}
