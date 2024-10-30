<?php

namespace App\Http\Controllers\Parent;

use App\Events\ChatSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Report;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($id)
    {

        $Report = Report::where('id',$id)->first();
        $Messages = Message::where('report_id',$Report->id)
        ->get();
        

        return view("parent.messages.index",compact('Report','Messages'));
    }

    public function store(Request $request,$type)
    {
     
        $Report = Report::where('id',$request->report_id)
        ->first();

        $message = new Message();
        $message->sender = Auth::guard('parent')->user()->id;
        $message->receiver = $Report->teacher_id; // أو parent إذا كان مستخدمًا
        $message->message = $request->message;

        $message->type = 'parent'; // أو 'parent' حسب نوع المستخدم
        $message->report_id = $request->report_id;
        $message->save();

        return response()->json($message); // نرسل الرسالة في شكل JSON للعرض الفوري
    }

    // public function sendMessage(Request $request)
    // {
    //    // تحقق من صحة البيانات المدخلة
    // $request->validate([
    //     'message' => 'required|string',
    //     'receiver' => 'required|exists:teachers,id'
    // ]);

    // try {
    //     // إنشاء الرسالة الجديدة في قاعدة البيانات
    //     $message = Message::create([
    //         'sender' => Auth::guard('parent')->user()->id,
    //         'receiver' => $request->receiver,
    //         'message' => $request->message,
    //         'type' => 'ParentTeacher'
    //     ]);

    //     // جلب المعلم (المستقبل)
    //     $teacher = Teacher::findOrFail($request->receiver);


    //     return response()->json(['status' => 'Message sent successfully!', 'message' => $message]);

    // } catch (\Exception $e) {
    //     return response()->json(['status' => 'Failed to send message.', 'error' => $e->getMessage()], 500);
    // }
    // }
}
