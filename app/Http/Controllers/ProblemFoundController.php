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
                                inner join finishgood_list as a on a.partno = b.part_no and a.custpo = b.cust_po");
        // return $data;

        return view('problem.index',compact('data'));
    }

    public function create(Request $request){


        // return $request;
        $pic = $request->found_by;
        $kitLabel = $request->label_kit;
        $symptom = $request->symptom;
        $found_date = Carbon::now();    
        $dic = $request->dic;

        // $file = $request->file('image');
        // $destPath = 'public/img/';
        // $savefile = storage_path('public/img/', $file);
        
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
    
        $imageName =time().'.'.$request->image->extension();  
     
        $foto =  $request->image->move(public_path('img'), $imageName);
  

        // public/images/file.png

        $datakit = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $datakit);

        DB::connection('sqlsrv')
            ->insert("INSERT into problemfound(cust_po,part_no,found_by,symptom,image,timefound)
                      SELECT '{$custpo}','{$partno}','{$pic}','{$symptom}','{$foto}','{$found_date}' 
                      ");

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
