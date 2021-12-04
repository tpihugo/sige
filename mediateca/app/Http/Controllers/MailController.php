<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailController extends Controller
{
    public function sendMail($title, $body, $user){
        $details = [
            'tittle' => $title,
            'body' => $body
        ];

        Mail::to($user)->send(new TestMail($details));
        return "Mensaje enviado.";
    }
}
