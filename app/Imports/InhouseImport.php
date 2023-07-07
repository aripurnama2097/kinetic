<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Inhouse;
use Maatwebsite\Excel\Concerns\ToModel;
class InhouseImport implements Tomodel
{
    /**
    * @param Collection $collection
    */
    // public function collection(Collection $collection)
    // {
    //     //
    // }

    public function model(array $row)
    {
        return new Inhouse([
            'model' =>$row[0],
            'lotno' =>$row[1],
            'shipqty' =>$row[2],
            'jknpo'   =>$row[3]
            //
        ]);
    }
}
