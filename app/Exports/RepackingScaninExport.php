<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RepackingScaninExport implements FromCollection,WithHeadings
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

        return ["NO","CUSTCODE","IDNUMBER","COMBINE NO","DEST","PROD NO","CUSTPO","PARTNUMBER","PARTNAME","DEMAND","GW","LENGHT","WIDHT","HEIGHT"
                 ,"QTY","LABEL PANEL", "LABEL MC", "LABEL KIT", "PIC", "SCAN DATE"
                ];
    }
}
