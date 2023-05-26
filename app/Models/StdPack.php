<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class StdPack extends Model
{
    use HasFactory;

    protected $table ='std_pack';

    protected $guarded =['id'];

    // protected $fillable=['partnumber',        
    // 'partname',
    // 'lenght',
    // 'widht',
    // 'height',
    // 'weight',
    // 'stdpack',
    // 'vendor',
    // 'jknshelf'];
}
