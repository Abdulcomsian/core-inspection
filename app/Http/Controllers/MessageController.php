<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Appointment, Chat};
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class MessageController extends Controller
{
    public function sendTextToUser(Request $request)
    {
        $html = '';
        if($request->message !='' || isset($request->chat_files))
        {
            $create = new Chat;
            $create->message = $request->message;
            $create->appointment_id = $request->appointment_id;
            $create->user_id = Auth::id();
            $create->save();
            $appointmentDetails = Appointment::with('user','serviceProvider')->find($request->appointment_id);           
            $chatDetails = Chat::with('userDetails')->find($create->id);
            $type = 0;
            $html =  view('components.chats.vendor-sent-message',compact('appointmentDetails','chatDetails','type'))->render();
            $type = 1;
            $touser = view('components.chats.vendor-sent-message',compact('appointmentDetails','chatDetails','type'))->render();
            event(new \App\Events\VendorEvent($appointmentDetails->id,$appointmentDetails->user_id,$touser));

        }
        
        return response()->json([
            "status" => true, 
            "message" => 'message sent successfully',
            'html'=>$html,
        ]);
    }
    public function sendTextToVendor(Request $request)
    {
        $html = '';
        if($request->message !='' || isset($request->chat_files))
        {
            $create = new Chat;
            $create->message = $request->message;
            $create->appointment_id = $request->appointment_id;
            $create->user_id = Auth::id();
            $create->save();
            $appointmentDetails = Appointment::with('user','serviceProvider')->find($request->appointment_id);           
            $chatDetails = Chat::with('userDetails')->find($create->id);
            $type = 0;
            $html =  view('components.chats.user-sent-message',compact('appointmentDetails','chatDetails','type'))->render();
            $type = 1;
            $tovendor = view('components.chats.user-sent-message',compact('appointmentDetails','chatDetails','type'))->render();
            event(new \App\Events\UserEvent($appointmentDetails->id,$appointmentDetails->vendor_id,$tovendor));

        }
        
        return response()->json([
            "status" => true, 
            "message" => 'message sent successfully',
            'html'=>$html,
        ]);    
    }

    public function performEvent()
    {
        event(new \App\Events\TestEvent('Hello World'));
        dd('message sent');
    }
}
