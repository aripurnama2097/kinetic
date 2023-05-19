<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblSB98 extends Model
{
    use HasFactory;

    protected $table ='tblSB98';
    protected $fillable = ['custcode',
    'custpo',
    'partno'  ,
    'partname',
    'jkeipodate' ];
}
