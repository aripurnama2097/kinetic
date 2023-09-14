<?php

namespace App\Imports;

use App\Models\ScheduleTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpserts;
class ImportScheduleTemp implements ToModel, WithUpserts,WithStartRow
{
    
    
  
    public function model(array $row)
    {




        // foreach ($rows as $row) 
        // {
        //    ScheduleTemp::create([
        //             'custcode'           => $row[0],
        //             'dest'               => $row[1],
        //             'attention'          => $row[2],
        //             'model'              => $row[3],
        //             'prodno'             => $row[4],
        //             'lotqty'             => $row[5],
        //             'jkeipodate'         => $row[6],
        //             'vandate'            => $row[7],
        //             'etd'                => $row[8],
        //             'eta'                => $row[9],
        //             'shipvia'            => $row[10],
        //             'orderitem'          => $row[11],
        //             'custpo'             => $row[12],
        //             'partno'             => $row[13],
        //             'partname'           => $row[14],
        //             'shelfno'            => $row[15],
        //             'demand'             => $row[16]
        //     ]);
        // }
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
        ]);

        return $data;

        
    }


    public function upsertColumns()
    {
        return ['custcode', 'partno'];
    }


    public function uniqueBy()
    {
        return 'custpo';
    }

    public function startRow(): int
    {
        return 2;
    }
}
