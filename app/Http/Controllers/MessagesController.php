<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Tchat;
use App\Models\User;
use App\Models\Notification;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;




class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $own_messages = Message::where('receiver_id',$user->id)
                                ->orWhere('sender_id',$user->id)
                                ->with('answers')
                                ->get();
        return view('messages.own_messages')->with('own_messages',$own_messages);
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tchat = new Tchat();
        $message = new Message();
        $request->validate([
            'message_title' => 'required|string|max:255',
            'message_content' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);
        $user = Auth::user();
        $notification = New Notification();
        $message->message_title = $request->input('message_title');
        $message->message_content = $request->input('message_content');
        $message->receiver_id = $request->input('user_id');
        $message->sender_id = $user->id;
        $message->save();
        $notification->notification_object = 'new message from ' .  $message->sender->name;
        $notification->notification_content = 'message contains ' . $message->message_content;
        $notification->receiver_id = $message->receiver_id;
        $notification->save();
        $tchat->message_id = $message->id;
        $tchat->creator_id = $user->id;
        $tchat->tchat_title = $user->name;
        $tchat->save();
        return redirect('tchats');

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
        $message = Message::findOrFail($id);
        $message->answers()->delete();
        $message->tchats()->delete();
        $message->delete();
    
        return redirect()->back()->with('success', 'Message deleted successfully');
    }
    
}
