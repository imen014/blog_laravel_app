<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class ReactionsController extends Controller
{
    
    public function like(Request $request)
    {
     
      $this->toggleReaction($request, 'like');
      return redirect()->back()->with('success', 'Réaction mise à jour avec succès');

    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function dislike(Request $request)
    {

        $this->toggleReaction($request, 'dislike');
        return redirect()->back()->with('success', 'Réaction mise à jour avec succès');

    }

    /**
     * Update the specified resource in storage.
     */
    public function heart(Request $request)
    {
   
        $this->toggleReaction($request, 'adore');
        return redirect()->back()->with('success', 'Réaction mise à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    private function toggleReaction(Request $request, string $reactionName)
    {
        $user = Auth::user();
        $immobilierId = $request->input('immobilier_id');

        // Check if the user has already reacted to this immobilier with the same action
        $existingReaction = Reactions::where('user_id', $user->id)
            ->where('immobilier_id', $immobilierId)
            ->where('reaction_name', $reactionName)
            ->first();

        if ($existingReaction) {
            // If the user has already reacted with the same action, delete the reaction
            $existingReaction->delete();
        } else {
            // Otherwise, save the new reaction
            // First, delete any existing reaction by the user for this immobilier
            Reactions::where('user_id', $user->id)
                ->where('immobilier_id', $immobilierId)
                ->delete();

            // Then, save the new reaction
            $newReaction = new Reactions();
            $newReaction->immobilier_id = $immobilierId;
            $newReaction->user_id = $user->id;
            $newReaction->reaction_name = $reactionName;
            $newReaction->save();


        }
    }

}
