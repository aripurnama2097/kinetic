<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSettingController extends Controller
{
    public function index(){


        $data = DB::connection('sqlsrv')
                ->select("SELECT * FROM users");

        return view('user_setting.index',compact('data'));       
    }


    public function create(request $request){

        $validateData = $request->validate([
            'name'=>['required', 'min:3', 'max:255','unique:users'],
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
