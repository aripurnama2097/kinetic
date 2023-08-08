<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(request $request){


    //   return $request;

      $datauser = $request->name1;
    //   list($user1, $user2, $user3, $dest, $custpo, $shelfno, $idnumber) = explode(",", $datauser);

    //   $user = explode(",", $datauser);

        $details = [
        'title' => 'Mail from Kinetic',
        'body' => 'Update schedule Realese KIT & Service Part'
    ];

    // $user =[
    //     'ari.purnama@jkei.jvckenwood.com'
    //     // 'harris.zaki@jkei.jvckenwood.com'
    // ];

        // $name_1 = $request->name1;
        // $name_2= $request->name2;
        // $name_3= $request->name3;
        // $name_4= $request->name4;
        // $name_5= $request->name5;


        // $user =[$name_1, $name_2, $name_3, $name_4, $name_5 ];

    // return $user;
        
  

        Mail::to($datauser)->send(new \App\Mail\NotifyMail($details));
   
        // dd("Email sudah terkirim.");
}


}


