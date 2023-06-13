<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblSA90 extends Model
{
    use HasFactory;

    protected $table ='tblSA90';

    protected $fillable =['modelname','prodNo', 'partnumber', 'qty'];
}
