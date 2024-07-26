<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tchat;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Answer;





class TchatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
       // $tchats = Tchat::where('creator_id',$user->id)->get()->with('message');
       $tchats = Tchat::with('message')->where('creator_id', $user->id)->get();

    return view('tchats.own_messages',compact('tchats'));
        
        
    }

    public function get_hole_discussion(string $id){
       // $user = Auth::user();
       // $tchats = Tchat::where('creator_id',$user->id)->get()->with('message');
       $tchats = Tchat::with('message','response')->where('id', $id)->get();
       return view('tchats.hole_tchat',compact('tchats'));


    }

    public function delete_hole_discussion(string $id){
        $tchat = Tchat::with('message','response')->where('id', $id)->first();
        $tchat->delete();
        return redirect('tchats')->with('success', 'discussion deleted succefully');


    }
        


    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$users = User::all();
        $managers = User::where('role','manager')->get();
        $seekers = User::where('role','home_seeker')->get();
        $owners = User::where('role','property_owner')->get();
        return view('messages.create',compact('managers','seekers','owners'));
    }

   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tchat=Tchat::findOrFail($id);
        $sender_id = $tchat->sender_id;
        $receiver_id = $tchat->receiver_id;
        $sender = User::findOrFail($sender_id);
        $receiver = User::findOrFail($receiver_id);
        return view('messages.show_tchat',compact('tchat','sender','receiver'));
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
        $tchat = Tchat::where('id',$id)->first();
        $tchat->delete();
    }
}
