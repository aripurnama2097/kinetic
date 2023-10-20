<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Problemfound;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ProblemFoundController extends Controller
{
    public function index(){

        $data = DB::connection('sqlsrv')
                    ->select("SELECT a.*, b.* from problemfound as b
                                inner join finishgood_list as a 
                                    on a.partno = b.part_no and a.custpo = b.cust_po");
        // return $data;

        return view('problem.index',compact('data'));
    }

    public function create(Request $request){


        // return $request;
        $pic = $request->found_by;
        $labelmc = $request->label_kit;
        $partno = substr($labelmc, 0, 15);
        $qty2 = substr($labelmc, 24, 5);
        $qty = trim($qty2);
        $symptom = $request->symptom;
        $found_date = Carbon::now();    
        $dic = $request->dic;

        // $file = $request->file('image');
        // $destPath = 'public/img/';
        // $savefile = storage_path('public/img/', $file);
        
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
    
       

        // public/images/file.png

        // $datakit = $kitLabel;
        // list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $datakit);


        if(isset($request->image)){
            $imageName =time().'.'.$request->image->extension();  
     
            $foto =  $request->image->move(public_path('img'), $imageName);
      
            DB::connection('sqlsrv')
            ->insert("INSERT into problemfound(cust_po,part_no,qty,found_by,symptom,image,timefound)
                      SELECT '{$partno}','{$partno}','{$qty}','{$pic}','{$symptom}','{$foto}','{$found_date}' 
                      ");
        }

        else{
            DB::connection('sqlsrv')
            ->insert("INSERT into problemfound(cust_po,part_no,qty,found_by,symptom,timefound)
                      SELECT '{$partno}','{$partno}','$qty','{$pic}','{$symptom}','{$found_date}' 
                      ");

        }

      

        // $user= 'ari.purnama@jkei.jvckenwood.com';
        $details = [
            'title' => 'Mail from Kinetic',
            'body' => 'Problem found in part number :' . $partno 
                    // . 'Symptom :' . $symptom
        ];

        Mail::to($dic)->send(new \App\Mail\NotifyMail($details));

        return redirect()->back()->with('success', 'Data Created Success');
          

    }


    public function view(){

        $data = DB::connection('sqlsrv')
        ->select("SELECT a.*, b.* from problemfound as b
                    inner join finishgood_list as a on a.partno = b.part_no and a.custpo = b.cust_po");

        return view('problem.view',compact('data'));
    }


    public function responProblem(Request $request, $id)
    {

        $model = Problemfound::find($id);   

        $model->dic      = $request->dic;
        $model->cause        = $request->cause;
        $model->action          = $request->action;
        $model->status          = 'Done';
        $model->updated_at      = Carbon::now();  
        
        $model->save();
        

      

        return redirect()->back()->with('success', 'Response Success');
    }
}
