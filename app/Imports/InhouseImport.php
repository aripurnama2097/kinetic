<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Inhouse;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
class InhouseImport implements Tomodel, WithUpserts
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

    public function uniqueBy()
    {
        return 'lotno';
    }
}
