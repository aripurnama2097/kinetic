<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepackingList extends Model
{
    use HasFactory;


    protected $table ='repacking_list';
    protected $guarded= ['id'];
}
