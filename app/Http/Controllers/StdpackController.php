<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StdPack;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportStdPack;
use Illuminate\Support\Facades\DB;


class StdpackController extends Controller
{
    public function index(){

         $data = DB::table('std_pack')
         ->get();

        return view('stdpack.index', compact('data'));
        }

    public function create(Request $request){

    

  
          StdPack ::create($request->all());

          return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }


    public function uploadstdpack(){

            // return request()->file('file');
       $data =  Excel::import(new ImportStdPack, request()->file('file'));



       return redirect()->back()->with('success', 'Upload StdPack  Success');

    }

    
    public function multiDelete(Request $request) 
        {
            stdPack::whereIn('id', $request->get('selected'))->delete();

           return redirect()->back()->with('delete', 'data has been delete');
        }
}
