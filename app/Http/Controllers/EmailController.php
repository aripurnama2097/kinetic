<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(){

        $details = [
        'title' => 'Mail from Kinetic',
        'body' => 'This is for testing email using smtp'
    ];

    $user =[
        'ari.purnama@jkei.jvckenwood.com'
        // 'harris.zaki@jkei.jvckenwood.com'
    ];
        
  

        Mail::to($user)->send(new \App\Mail\NotifyMail($details));
   
        // dd("Email sudah terkirim.");
}


}



// select * from std_pack
// truncate table schedule_temp

// select * from schedule

// --schedule & stdpack
// --select a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
// --a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,  a.demand, b.stdpack, b.vendor, b.jknshelf from schedule_temp as a
// --left join std_pack as b ON a.partno = b.partnumber order by vandate desc

// --GENERATE SCHEDULE
// insert into (custcode, dest,attention, model, prodno, lotqty, jkeipodate, vandate, etd,eta,shipvia,orderitem,custpo,partno,
// 			partname,demand,stdpack,vendor,jknshelf)

// select a.custcode, a.dest,a.attention,a.model,a.prodno, a.lotqty, a.jkeipodate, a.vandate, a.etd,a.eta,
// a.shipvia, a.orderitem, a.custpo, a.partno, a.partname,  a.demand, b.stdpack, b.vendor, b.jknshelf from schedule_temp as a
// left join std_pack as b ON a.partno = b.partnumber 
// inner join tblSB98 as c ON a.partno = c.partno
// order by vandate desc