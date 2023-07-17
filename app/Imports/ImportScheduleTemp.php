<?php

namespace App\Imports;

use App\Models\ScheduleTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ImportScheduleTemp implements ToModel,WithStartRow
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
          
            'custcode'           => $row[0],
            'dest'               => $row[1],
            'attention'          => $row[2],
            'model'              => $row[3],
            'prodno'             => $row[4],
            'lotqty'             => $row[5],
            'jkeipodate'         => $row[6],
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


            //  'doc_no'         => "{$row['doc_no'      ]}",
            //     'old_part_no'    => "{$row['old_part_no'  ]}",
            //     'new_part_no'    => "{$row['new_part_no'    ]}",
            //     'model'          => "{$row['model'       ]}",
            //     'start_serial'   => "{$row['start_serial'      ]}",
            //     'wu'             => "{$row['wu'          ]}"
        ]);

        return $data;

        
    }

    public function startRow(): int
    {
        return 2;
    }
}
