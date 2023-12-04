<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scanout extends Model
{
    use HasFactory;
    protected $table ='scanout';
    protected $guarded= ['id'];
}
