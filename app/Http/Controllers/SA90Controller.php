<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblSA90;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;

class SA90Controller extends Controller
{
    public function index(){
        
        if (request()->ajax()) {
            $data = TblSA90::query();
            return DataTables::of($data)
            ->addIndexColumn()
                ->make(true);
        }

        return view('/schedule_tentative.SA90');
    }

    function delete(){
        DB::table('tblSA90')->truncate();

        // DB::table('history')->insert('pic');

        return redirect()->back()->with('delete', 'All records have been deleted.');

    }
}
