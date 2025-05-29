<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\KalingaEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::to($request->email)->send(
            new KalingaEmail($request->subject, $request->message)
        );

        return response()->json(['status' => 'Email sent successfully.']);
    }

        public function template()
    {
        return view('emails.kalinga')
            ->with([
                'messageContent' => "Hi!,

                Thank you for joining Kalinga — we’re glad to have you on board!

                You can now start exploring features and stay updated with the latest from our community. If you ever need help, feel free to reach out to us.

                💬 Questions? Contact us anytime at support@kalingangkababaihan.com.

                Warm regards,
                The Kalinga Team  ",
            ]);
    }
}

