<?php

namespace App\Imports;

use App\Models\StdPack;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ImportStdPack implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $data = new StdPack([
            'partnumber'         => $row[0],
            'partname'           => $row[1],
            'lenght'             => $row[2],
            'widht'              => $row[3],
            'height'             => $row[4],
            'weight'            => $row[5],
            'stdpack'            => $row[6],
            'vendor'            => $row[7],
            'jknshelf'            => $row[8],
        ]);


        return $data;
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
