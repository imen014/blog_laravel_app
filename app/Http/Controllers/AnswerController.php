<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Message;
use App\Models\Tchat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Notification;







class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request,string $id)
    {
        $message = Message::where('id',$id)->first();
       return view('answers.create')->with('message',$message);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'message_title' => 'required|string|max:255',
            'message_content' => 'required|string|max:500',
            'message_id' => 'required|exists:messages,id'
        ]);
        $message_id = $request->input('message_id');
        $message = Message::where('id',$message_id)->first();
        $tchat = Tchat::where('message_id',$message_id)->first();
        $answer = new Answer();
        $notification = new Notification();

        $user = Auth::user();
        $answer->message_title = $request->input('message_title');
        $answer->message_content = $request->input('message_content');
        $answer->receiver_id =$message->sender_id;
        $answer->sender_id = $user->id;
        $answer->message_id = $message->id;
        $answer->save();
        $notification->notification_object = 'new answer from ' . $answer->sender->name;
        $notification->notification_content = 'answer contain ' . $answer->message_content;
        $notification->receiver_id = $answer->receiver_id;
        $notification->save();
        $tchat->response_id = $answer->id;
        $tchat->update();
        return Redirect('tchats');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();
        return Redirect()->back()->with('success','answer deleted succefully');
    }
}
