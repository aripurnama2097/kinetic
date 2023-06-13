<?php

namespace App\Imports;

use App\Models\tblSA90;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSA90 implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new tblSA90([
            'modelname' =>$row[2],
            'prodNo' =>$row[3],
            'partnumber' =>$row[8],
            'qty'       =>$row[16]
            //
        ]);
    }
}
