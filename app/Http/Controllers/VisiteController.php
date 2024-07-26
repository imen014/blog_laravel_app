<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visite;
use Illuminate\Support\Facades\Redirect;
use App\Models\Immobilier;
use App\Models\User;
use App\Models\Notification;






class VisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asked_visites = Visite::where('state_visite','asked')->get();
        if(!$asked_visites){
            $message = '0 asked visites found';
            return view('visites.index')->with('message',$message);

        }
        foreach($asked_visites as $asked_visite){
            $immobilier = Immobilier::where('id',$asked_visite->id);
            $user = User::where('id',$asked_visite->user_id);


        }
        return view('visites.index', compact('asked_visites', 'user','immobilier'));

       // return view('visites.index')->with('asked_visites',$asked_visites,'immobilier',$immobilier,'user',$user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $visite = Visite::where('id',$id)->first();
        $visite->delete();
        return redirect()->route('index_page')->with('success', 'visite supprimé avec succès');

        
    }
}
