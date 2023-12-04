<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InhouseScanin extends Model
{
    use HasFactory;
    protected $table ='inhouse_scanin';
    protected $guarded= ['id'];
}
