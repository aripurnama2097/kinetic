<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ScheduleTemp extends Model
{
    use HasFactory;
  // use LogsActivity;


    protected $table ='schedule_temp';
    protected $guarded= ['id'];
    // protected $fillable = ['custcode' ,
    // 'dest'  ,
    // 'attention' ,
    // 'model' ,
    // 'prodno' ,
    // 'lotqty'  ,
    // 'jkeipodate'  ,
    // 'vandate'    ,
    // 'etd'    ,
    // 'eta'    ,
    // 'shipvia' ,
    // 'orderitem'  ,
    // 'custpo'   ,
    // 'partno'   ,
    // 'partname',
    // 'shelfno',
    // 'demand'  ];            
   



  
}
