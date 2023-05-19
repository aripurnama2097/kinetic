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
        'ari.purnama@jkei.jvckenwood.com',
        'harris.zaki@jkei.jvckenwood.com'
    ];
        
  

        Mail::to($user)->send(new \App\Mail\NotifyMail($details));
   
        dd("Email sudah terkirim.");
}


}
