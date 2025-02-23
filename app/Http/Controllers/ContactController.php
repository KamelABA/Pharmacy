<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // إرسال البريد الإلكتروني
        Mail::to('stillvol14.ab@gmail.com')->send(new ContactMail($request->all()));

        return back()->with('success', 'تم إرسال رسالتك بنجاح! سنتواصل معك قريبًا.');
    }

    
    public function store(Request $request, $productId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'تم إضافة التعليق بنجاح!');
    }
}
