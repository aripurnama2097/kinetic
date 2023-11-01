<?php

namespace App\Exports;


use App\Models\FormatHeaderSch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormatHeaderSchExport implements  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return FormatHeaderSch::all();
    // }

    public function headings(): array
    {
        return ["custcode","dest","attention","model","prodno", "lotqty","jkeipodate","vandate",
                "etd","eta","shipvia","orderitem","custpo", "partno","partname","shelfno","demand"          
            ];
    }
}



