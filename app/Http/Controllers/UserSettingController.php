<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSettingController extends Controller
{
    public function index(Request $request){
        $pagination = 10;
        $keyword= $request->keyword;

        $data = DB::table('users')
                    ->where('name', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('nik', 'LIKE', '%'.$keyword.'%')
                     ->latest()->paginate(10);
                    // ->orderBy('id','asc');
                    $data->withPath('user_setting');
                    $data->appends($request->all());
    // $data->orderBy('id','asc')->get();
// $data2= $data->orderBy('id', 'asc')->get();
     return view ('/user_setting.index',compact(
                                        'data'
                                       ))->with('i', (request()->input('page', 1) -1) * $pagination
             );


        return view('user_setting.index',compact('data'));       
    }


    public function create(request $request){

        $validateData = $request->validate([
            'name'=>['required', 'min:3', 'max:255'],
            'nik'=>['required', 'max:5'],    
            'role'=>['required'],          
            'password' =>'required|min:5|max:255',  
        ]);

        // return $validateData;

        
            $validateData['password'] = Hash::make($validateData['password']);
            User::Create($validateData);

            return redirect()->back()->with('success','created user successfully');
    }

    public function update(Request $request, $id)
    {

        $model = User::find($id);   

        $model->name      = $request->name;
        $model->nik        = $request->nik;
        $model->role          = $request->role;
        $model->updated_at      = Carbon::now();  
        
        $model->save();

        return redirect()->back()->with('success','Updated Data Success');
    }
}
