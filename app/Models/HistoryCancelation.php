<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryCancelation extends Model
{
    use HasFactory;
    protected $table ='tblhistory_cancelation';
    protected $guarded= ['id'];
}
