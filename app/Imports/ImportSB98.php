<?php

namespace App\Imports;

use App\Models\TblSB98;
use App\Models\TblSA90;
use App\Models\ScheduleTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Illuminate\Support\Facades\Validator;

class ImportSB98 implements Tomodel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        
        // if(($row['reqdate'] == 0 || $row['jkeipodate'] == 0  || $row['vandate'] == 0  || $row['etd'] == 0  || $row['eta'] == 0 )){
            return new TblSB98([
                'custcode'  =>$row[1],
                'custpo'         =>$row[3],
                'partno'         => trim ($row[5]),
                'partname'       => trim ($row[6]),
                'reqdate'        => trim ($row[20]),
                'jkeipodate'     => trim ($row[21]),
                'demand'         => trim ($row[22]),
                'outset'         => trim ($row[40]),
                'vandate'        => trim ($row[50]),
                'etd'            => trim ($row[51]),
                'eta'            => trim ($row[52]),  
            ]);
        // }

        }
        // public function upsertColumns()
        //     {
        //         return ['custcode'];
        //     }

        // public function collection(Collection $rows)
        // {
        //  Validator::make($rows->toArray(), [
        //      '*.custcode' => 'required',
        //      '*.custpo' => 'required',
        //      '*.jkeipodate' => 'required',
        //  ])->validate();
  
        // foreach ($rows as $row) {
        //     TblSB98::create([
        //         'custcode' => $row['custcode'],
        //         'custpo' => $row['custpo'],
        //         'jkeipodate' => $row['jkeipodate'],
        //         // 'password' => bcrypt($row['password']),
        //     ]);
        // }
        
    
        //  }

    //     public function uniqueBy()
    // {
    //     return ['custcode'];
    // }


}