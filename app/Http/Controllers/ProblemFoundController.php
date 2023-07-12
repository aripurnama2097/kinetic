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
                                inner join schedule as a on a.partno = b.part_no and a.custpo = b.cust_po");
        // return $data;

        return view('problem.index',compact('data'));
    }

    public function create(Request $request){


        // return $request;
        $pic = $request->found_by;
        $kitLabel = $request->label_kit;
        $symptom = $request->symptom;
        $found_date = Carbon::now();    

        $file = $request->file('image');
        $destPath = 'public/img/';
        

  


        $datakit = $kitLabel;
        list($partno, $partname, $qty, $dest, $custpo, $shelfno, $idnumber) = explode(":", $datakit);

        DB::connection('sqlsrv')
            ->insert("INSERT into problemfound(cust_po,part_no,found_by,symptom,image,timefound)
                      SELECT '{$custpo}','{$partno}','{$pic}','{$symptom}','{$file}','{$found_date}' 
                      ");

        $user= 'ari.purnama@jkei.jvckenwood.com';
        $details = [
            'title' => 'Mail from Kinetic',
            'body' => 'Problem found in part number :' . $partno 
        ];
        Mail::to($user)->send(new \App\Mail\NotifyMail($details));
            // $request->validate([
            //     'found_by' => 'required',
            //     'label_kit' => 'required',
            //     'symptom' => 'required',
            //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            // ]);
    
            // $fileName = time() . '.' . $request->image->extension();
            // $request->image->storeAs('public/img', $fileName);
                  
            // $user = new Problemfound;
            // $user->found_by = $request->input('found_by');
            // $user->custpo = $request->input('label_kit');
            // $user->found_by = $request->input('found_by');
            // $user->image = $fileName;
            // $user->save();
    }
}
