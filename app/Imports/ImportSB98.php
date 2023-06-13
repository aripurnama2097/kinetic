<?php

namespace App\Imports;

use App\Models\TblSB98;
use App\Models\TblSA90;
use App\Models\ScheduleTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class ImportSB98 implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        
        if(($row['reqdate'] == 0 || $row['jkeipodate'] == 0  || $row['vandate'] == 0  || $row['etd'] == 0  || $row['eta'] == 0 )){
            return new TblSB98([
                'custcode'       => $row[1],
                'custpo'         => $row[3],
                'partno'         => $row[5],
                'partname'       => $row[6],
                'reqdate'        => $row[20],
                'jkeipodate'     => $row[21],
                'demand'         => $row[22],
                'outset'         => $row[40],
                'vandate'        => $row[50],
                'etd'            => $row[51],
                'eta'            => $row[52]  
            ]);
        }



       
        
    }
}
