<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StdPack;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportStdPack;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\DataTables;

class StdpackController extends Controller
{
    public function index(Request $request){
       
                $pagination = 10;
                $keyword= $request->keyword;

                $data = StdPack::where('partnumber', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('partname', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('lenght', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('widht', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('jknshelf', 'LIKE', '%'.$keyword.'%')
                                ->latest()->paginate(10);
                                // ->orderBy('id','asc');
                                $data->withPath('stdpack');
                                $data->appends($request->all());
                // $data->orderBy('id','asc')->get();
        // $data2= $data->orderBy('id', 'asc')->get();
             return view ('/stdpack.index',compact(
                                                    'data'
                                                   ))->with('i', (request()->input('page', 1) -1) * $pagination
                         );


                // return view('/stdpack.index',compact('data'));
                
                // USE DataTables
                
                // if (request()->ajax()) {
                //     $data = StdPack::query();
                //     return DataTables::of($data)
                //     ->addIndexColumn()
                //         // ->addColumn('action', function($row){
                //         //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                //         //     return $actionBtn;
                //         // })d
                      
                //         // ->rawColumns(['action'])
                       
        
                //         ->make(true);
                // }
                // return view('/stdpack.index');

            }

    public function create(Request $request){

        // if()
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

        public function update(Request $request, $id)
    {

        $model = stdPack::find($id);   

        $model->partnumber      = $request->partnumber;
        $model->partname        = $request->partname;
        $model->lenght          = $request->lenght;
        $model->widht           = $request->widht;
        $model->height          = $request->height;
        $model->weight          = $request->weight;
        $model->stdpack         = $request->stdpack;
        $model->vendor          = $request->vendor;
        $model->jknshelf        = $request->jknshelf;
        $model->save();
        

        // return response()->json([
        //     'success' =>TRUE,
        //     'message' =>'berhasil update'
        // ]);

        return redirect('/stdpack')->with('success', 'Success! Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $model=stdPack::find($id);
        $model->delete();// METHOD DELETE
        return redirect('/stdpack')->with('success', 'Success! Data Berhasil Dihapus');
    }

    public function delete_all(){
        DB::table('std_pack')->truncate();

         return redirect()->back()->with('delete', 'All records have been deleted.');
    }


}
