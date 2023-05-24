<?php

namespace App\Imports;

use App\Models\ScheduleTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Carbon\Carbon;

class ImportScheduleTemp implements ToModel
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // DB::beginTransaction();
     $data=  new ScheduleTemp([
          
            // 'typedata'           => 'test',
            'custcode'           => $row[0],
            'dest'               => $row[1],
            'attention'          => $row[2],
            'model'              => $row[3],
            'prodno'             => $row[4],
            'lotqty'             => $row[5],
            'jkeipodate'         => $row[6],
            // 'jkeipodate'         => (Carbon::createFromFormat('d/m/Y', $row[6])!==false) ? Carbon::createFromFormat('d/m/Y', $row[6])->format('Y-m-d') : $row[6],
            'vandate'            => $row[7],
            'etd'                => $row[8],
            'eta'                => $row[9],
            'shipvia'            => $row[10],
            'orderitem'          => $row[11],
            'custpo'             => $row[12],
            'partno'             => $row[13],
            'partname'           => $row[14],
            'shelfno'            => $row[15],
            'demand'             => $row[16],


            
        ]);

        return $data;

        
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
