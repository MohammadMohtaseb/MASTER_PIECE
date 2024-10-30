<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($id)
    {

        $Report = Report::where('id',$id)->first();
       
        $Messages = Message::where('report_id',$Report->id)
        ->get();
        

        return view("teacher.messages.index",compact('Report','Messages'));
    }
    public function store(Request $request,$type)
    {
     
        $Report = Report::where('id',$request->report_id)
        ->first();

        $message = new Message();
        $message->sender = Auth::guard('teacher')->user()->id;
        $message->receiver = $Report->teacher_id; // أو parent إذا كان مستخدمًا
        $message->message = $request->message;

        $message->type = 'teacher'; // أو 'parent' حسب نوع المستخدم
        $message->report_id = $request->report_id;
        $message->save();

        return response()->json($message); // نرسل الرسالة في شكل JSON للعرض الفوري
    }
    
}
