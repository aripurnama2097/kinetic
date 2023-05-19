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
            // 'custcode'           =>"{$row['custcode']}", 
            'dest'               => "{$row['dest']}",
            'attention'          => "{$row['attent']}",
            'model'              =>"{$row['model']}",
            'prodno'             => "{$row['prodno']}",
            // 'lotqty'             => $row[5],
            'jkeipodate'         => "{$row['jkeipodate']}"
            // 'jkeipodate'         => (Carbon::createFromFormat('d/m/Y', $row[6])!==false) ? Carbon::createFromFormat('d/m/Y', $row[6])->format('Y-m-d') : $row[6],
            // 'vandate'            => $row[7],
            // 'etd'                => $row[8],
            // 'eta'                => $row[9],
            // 'shipvia'            => $row[10],
            // 'orderitem'          => $row[11],
            // 'custpo'             => $row[12],
            // 'partno'             => $row[13],
            // 'partname'           => $row[14],
            // 'shelfno'            => $row[15],
            // 'demand'             => $row[16],

            // 'custcode'           =>  (isset($row[0]) ? $row[0] : ''),
            // 'dest'               =>  (isset($row[1]) ? $row[1] : ''),
            // 'attention'          =>  (isset($row[2]) ? $row[2] : ''),
            // 'model'              =>  (isset($row[3]) ? $row[3] : ''),
            // 'prodno'             =>  (isset($row[4]) ? $row[4] : ''),
            // 'lotqty'             =>  (isset($row[5]) ? $row[5] : ''),
            // 'jkeipodate'         =>  (isset($row[6]) ? $row[6] : ''),
            // 'vandate'            =>  (isset($row[7]) ? $row[7] : ''),
            // 'etd'                =>  (isset($row[8]) ? $row[8] : ''),
            // 'eta'                =>  (isset($row[9]) ? $row[9] : ''),
            // 'shipvia'            =>  (isset($row[10]) ? $row[10] : ''),
            // 'orderitem'          =>  (isset($row[11]) ? $row[11] : ''),
            // 'custpo'             =>  (isset($row[12]) ? $row[12] : ''),
            // 'partno'             => (isset($row[13]) ? $row[13] : ''),
            // 'partname'           =>  (isset($row[14]) ? $row[14] : ''),
            // 'shelfno'            => (isset($row[15]) ? $row[15] : ''),
            // 'demand'             => (isset($row[16]) ? $row[16] : ''),

            
        ]);

        return $data;

        
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
