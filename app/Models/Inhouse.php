<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inhouse extends Model
{
    use HasFactory;

    protected $table ='masterinhouse';
    protected $guarded= ['id'];
}
