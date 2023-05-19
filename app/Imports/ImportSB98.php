<?php

namespace App\Imports;

use App\Models\TblSB98;
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
        return new TblSB98([
            'custcode'           => $row[1],
            'custpo'               => $row[3],
            'partno'             => $row[5],
            'partname'           => $row[6],
            'jkeipodate'         => $row[4],
            // 'vandate'            => $row[7],
            // 'etd'                => $row[8],
            // 'eta'                => $row[9],
            // 'shipvia'            => $row[10],
            // 'orderitem'          => $row[11],
            // 'reqdate'            => $row[20]
            
        ]);
    }
}
