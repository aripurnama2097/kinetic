<?php

namespace App\Exports;

use App\Models\Repacking;
use Maatwebsite\Excel\Concerns\FromCollection;

class RepackingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }


    public function headings(): array
    {
        return ["NO","PARTNUMBER","PARTNAME","LENGHT","WIDHT", "HEIGHT","WEIGHT","STDPACK","VENDOR","JKNSHELF","MCSHELFNO","CREATED DATE","UPDATE DATE"];
    }
}
