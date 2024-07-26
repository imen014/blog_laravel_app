<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use App\Models\Immobilier;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;




class FavouritesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // Récupérer les favoris de l'utilisateur
        $favoris = Favourite::where('user_id', $user->id)->get();
        
        // Collecter les objets Immobilier associés aux favoris
        $immobilierIds = $favoris->pluck('immobilier_id');
        $immobiliers = Immobilier::whereIn('id', $immobilierIds)->get();
        
        return view('immobiliers.favoris', compact('favoris', 'immobiliers'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create_favourite(Request $request)
    {
        $user = Auth::user();
        $favoris = new Favourite();
        $favoris->immobilier_id = $request->input('immobilier_id');
        $favoris->user_id = $user->id;
        $favoris->save();
        return redirect()->back();

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
        $favoris = Favourite::where('id',$id);

        if ($favoris) {
            $favoris->delete();
            return redirect()->back()->with('success', 'Favori supprimé avec succès');
        } else {
            return redirect()->back()->with('error', 'Favori non trouvé');
        }
    }
}
