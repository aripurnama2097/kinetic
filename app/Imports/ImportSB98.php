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

class ImportSB98 implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


    
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

        }
       
    // public function uniqueBy()
    // {
    //     return 'custpo';
    // }

}