<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immobilier;
use App\Models\ImmoImages;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Visite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\Favourite;
use App\Models\Reactions;











class ImmoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $immobiliers = Immobilier::all();
    
        // Définir la date limite pour les 24 dernières heures
        $dateLimit = now()->subDay();
    
        // Récupérer les notifications créées dans les dernières 24 heures
        $notifications = Notification::where('created_at', '>=', $dateLimit)->get();
    
        // Compter les notifications récentes
        $recentNotificationsCount = $notifications->count();
    
        // Supprimer les notifications plus anciennes que 24 heures
        Notification::where('created_at', '<', $dateLimit)->delete();
    
        // Retourner les notifications des dernières 24 heures et le nombre de notifications récentes à la vue
        return view('immobiliers.index', [
            'immobiliers' => $immobiliers,
            'recentNotificationsCount' => $recentNotificationsCount
        ]);
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('immobiliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données d'entrée
        $validated_data = $request->validate([
            'location' => 'required|string|max:255', 
            'pieces_number' => 'required|integer|min:1', 
            'description' => 'nullable|string|max:500', 
            'city' => 'required|string|max:100', 
            'state' => 'required|string|max:100', 
            'price' => 'required|numeric|min:0', 
            'area' => 'required|numeric|min:0', 
            'real_state_type' => 'required|string', 
            'transaction_type' => 'required|string', 
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048' 
        ]);
        
        $user = Auth::user();
    
        // Création de l'objet immobilier
        $immobilier = Immobilier::create([
            'location' => $validated_data['location'],
            'pieces_number' => $validated_data['pieces_number'],
            'description' => $validated_data['description'],
            'city' => $validated_data['city'],
            'state' => $validated_data['state'],
            'price' => $validated_data['price'],
            'area' => $validated_data['area'],
            'real_state_type' => $validated_data['real_state_type'],
            'transaction_type' => $validated_data['transaction_type'],
            'creator_id' => $user->id
        ]);
        //$immobilier->creator_id = $user->id;
        //$immobilier->save();
    
        // Gestion des images
        if ($request->has('immo_image')) {
            foreach ($request->file('immo_image') as $image) {
                // Générer un nom unique pour chaque image
                $filename = $immobilier->real_state_type . $immobilier->pieces_number. 'pieces'  . $immobilier->state. uniqid() . '.' . $image->getClientOriginalExtension();
    
                // Déplacer l'image vers le dossier de stockage public
                $image->move(public_path('images'), $filename);
                //$image->move('images', $filename);
    
                // Enregistrer le chemin de l'image dans la base de données
                $image = new ImmoImages();
                $image->image_path='images/' . $filename;
                $image->immobilier_id=$immobilier->id;
                $image->save();
               
            }
        }
        $notification = new Notification();
        $notification->notification_object = 'new real state in ' . $immobilier->state . ' ' . $immobilier->city;
        $notification->notification_content =  $immobilier->real_state_type . ' to ' .$immobilier->transaction_type . ' with ' . $immobilier->price . ' dollars, containes ' . $immobilier->pieces_number . ' pieces';
        $notification->immobilier_id = $immobilier->id;
        $notification->save();
    
        return response()->json(['message' => 'Immobilier created successfully', 'immobilier' => $immobilier], 201);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $immobilier=Immobilier::findOrFail($id);
        $images = ImmoImages::where('immobilier_id', $id)->get(); // Ajout de la méthode get() pour obtenir les résultats
        return view('immobiliers.show', compact('immobilier', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $immobilier = Immobilier::findOrFail($id);
        return view('immobiliers.edit')->with('immobilier',$immobilier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $immobilier = Immobilier::findOrFail($id);
        $validated_data = $request->validate([
            'location' => 'sometimes|string|max:255',
            'pieces_number' => 'sometimes|integer|min:1',
            'description' => 'nullable|string|max:500',
            'city' => 'sometimes|string|max:100',
            'state' => 'sometimes|string|max:100',
            'price' => 'sometimes|numeric|min:0',
            'area' => 'sometimes|numeric|min:0',
            'real_state_type' => 'sometimes|string',
            'transaction_type' => 'sometimes|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048'
        ]);
       
       $immobilier->fill($validated_data);
       $immobilier->update();
    
        // Gestion des images
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                // Générer un nom unique pour chaque image
                $filename = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
    
                // Déplacer l'image vers le dossier de stockage public
                $image->move(public_path('images'), $filename);
    
                // Enregistrer le chemin de l'image dans la base de données
                ImmoImages::create([
                    'image_path' => 'images/' . $filename,
                    'immobilier_id' => $immobilier->id,
                ]);
            }
        }
        $notification = new Notification();
        $notification->notification_object = 'update: real state in ' . $immobilier->state . ' ' . $immobilier->city;
        $notification->notification_content =  $immobilier->real_state_type . ' to ' .$immobilier->transaction_type . ' with ' . $immobilier->price . ' dollar, containes ' . $immobilier->pieces_number . ' pieces';
        $notification->immobilier_id = $immobilier->id;
        $notification->save();
    
        return response()->json(['message' => 'Immobilier updated successfully', 'immobilier' => $immobilier], 201);
   
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy(string $id)
     {
         // Récupérer l'immobilier
         $immobilier = Immobilier::findOrFail($id);
     
         // Supprimer les images associées à l'immobilier
         $images = ImmoImages::where('immobilier_id', $id)->get();
         foreach ($images as $image) {
             Storage::delete($image->image_path);
             $image->delete();
         }
     
         // Supprimer les favoris associés à l'immobilier
         $favoris = Favourite::where('immobilier_id', $id)->get();
         foreach ($favoris as $favori) {
             $favori->delete();
         }   
     
         // Supprimer les réactions associées à l'immobilier
         $reactions = Reactions::where('immobilier_id', $id)->get();
         foreach ($reactions as $reaction) {
             $reaction->delete();
         }
     
         // Supprimer les visites associées à l'immobilier
         $visites = Visite::where('immobilier_id', $id)->get();
         foreach ($visites as $visite) {
             $visite->delete();
         }
     
         // Enfin, supprimer l'immobilier lui-même
         $immobilier->delete();    
     
         return redirect()->route('index_page')->with('success', 'Immobilier supprimé avec succès');
     }
     

public function planifier_visite(Request $request,string $id){
    $immobilier = Immobilier::where('id',$id)->first();
    return view('visites.create')->with('immobilier',$immobilier);
}

public function save_ask_visite(Request $request){
    $user = Auth::user();
    $immobilier_id = $request->input('immobilier_id');
    $immobilier = Immobilier::where('id', $immobilier_id)->first();

    // Vérifiez si la paire user_id et immobilier_id existe déjà
    $existingVisite = DB::table('visites')
                        ->where('user_id', $user->id)
                        ->where('immobilier_id', $immobilier_id)
                        ->exists();

    // Si la visite existe déjà, affichez un message de rappel
    if ($existingVisite) {
        $visite = Visite::where('immobilier_id',$immobilier_id)
                        ->where('user_id',$user->id)
                        ->first();
    
        return view('visites.already_created')->with('visite',$visite);
    }

    // Sinon, créez une nouvelle visite
    $visite = new Visite();
    $visite->immobilier_id = $immobilier_id;
    $visite->user_id = $user->id;
    $visite->date_demander = $request->input('date_demander');
    $visite->time_demander = $request->input('time_demander');
    $visite->state_visite = 'asked';
    $visite->save();
    $notification = new Notification();
    $notification->notification_object = 'new asked visite';
    $notification->notification_content =  $user->id . ' request visite to ' . $immobilier->real_state_type . ' in ' .$immobilier->transaction_type . ' with ' . $immobilier->price . ' dollar, containes ' . $immobilier->pieces_number . ' pieces in '  .  $visite->date_demander .' at ' . $visite->time_demander;
    $notification->concerned_user_id =  $visite->user_id;
    $notification->immobilier_id = $immobilier->id;
    $notification->save();

    return view('visites.asked');
}

public function change_ask_visite_date(Request $request,string $id){
    $visite = Visite::where('id',$id)->first();
    return view('visites.change')->with('visite',$visite);
}
public function update_ask_visite(Request $request){
    $user = Auth::user();

    $visite_id = $request->input('visite_id');

    $visite = Visite::where('id',$visite_id)->first();
    $visite->date_demander = $request->input('date_demander');
    $visite->time_demander = $request->input('time_demander');
    $visite->state_visite = 'asked';
    $visite->update();
    $notification = new Notification();
    $notification->notification_object = 'asked visite updated';
    $notification->notification_content = ' request visite updated ';
    $notification->concerned_user_id =  $visite->user_id;
    $notification->save();
    

    return view('visites.updated');
}
public function get_immo_per_user(Request $request,string $id){
    $immobiliers = Immobilier::where('creator_id',$id)->get();
    return view('immobiliers.user_immo')->with('immobiliers',$immobiliers);

}

}
