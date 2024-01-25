<?php

namespace App\Exports;

use App\Models\LogPrintKitOriginal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogPrintExport implements FromCollection,WithHeadings
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
        return ["NO","IDNUMBER","PARTNUMBER","PARTNAME","QTY","DESTINATION","CUSTPO","SHELFNO","PRODNO","CREATED DATE"];
    }

}
