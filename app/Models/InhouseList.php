<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InhouseList extends Model
{
    use HasFactory;
    protected $table ='inhouse_list';
    protected $guarded= ['id'];
}
