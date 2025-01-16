<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ReturnRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showContactMessages ()
    {
        $messages = ContactMessage::get();
        return view('backend.message.contact',compact('messages'));
    }

    public function deleteContactMessages ($id)
    {
        $message = ContactMessage::find($id);
        $message->delete();

        return redirect()->back();
    }

    public function showReturnReqMessages ()
    {
        $messages = ReturnRequest::get();
        return view('backend.message.return-req',compact('messages'));
    }

    public function deleteReturnReqMessages ($id)
    {
        $message = ReturnRequest::find($id);
        return redirect()->back();
    }
}
