<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Définir la date limite pour les 24 dernières heures
    $dateLimit = now()->subDay(); // ou Carbon::now()->subDay() si vous utilisez Carbon

    // Récupérer les notifications créées dans les dernières 24 heures
    $notifications = Notification::where('created_at', '>=', $dateLimit)->get();
    
    // Compter les notifications récentes

    // Supprimer les notifications plus anciennes que 24 heures
    Notification::where('created_at', '<', $dateLimit)->delete();

    // Retourner les notifications des dernières 24 heures et le nombre de notifications récentes à la vue
    return view('notifications.index', [
        'notifications' => $notifications ]);
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
        //
    }
    public function delete_notifications()
    {
        $notifications=Notification::all();
        foreach($notifications as $notification){
            $notification->delete();

        }
        return redirect('/immos');

    }
}
