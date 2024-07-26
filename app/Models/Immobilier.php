<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favourite;

class Immobilier extends Model
{
    use HasFactory;
    protected $fillable = [
        'location',
        'pieces_number',
        'description',
        'city',
        'state',
        'price',
        'area',
        'real_state_type',
        'transaction_type',
    ];
    public function userReaction($userId)
    {
        return $this->reactions()->where('user_id', $userId)->first();
    }

    /**
     * Define a relationship with reactions table.
     */
    public function reactions()
    {
        return $this->hasMany(Reactions::class);
    }
    public function likesCount()
    {
        return $this->reactions()->where('reaction_name', 'like')->count();
    }

    /**
     * Get the number of dislikes for this immobilier.
     */
    public function dislikesCount()
    {
        return $this->reactions()->where('reaction_name', 'dislike')->count();
    }

    /**
     * Get the number of adores for this immobilier.
     */
    public function adoresCount()
    {
        return $this->reactions()->where('reaction_name', 'adore')->count();
    }
    public function favorites()
    {
        return $this->hasMany(Favourite::class);
    }
    public static function deleteWithRelatedData(int $id)
    {
        return DB::transaction(function () use ($id) {
            // Supprimer les réactions associées à l'immobilier
            Reactions::where('immobilier_id', $id)->delete();
            
            // Supprimer les favoris associés à l'immobilier
            Favourite::where('immobilier_id', $id)->delete();
            
            // Supprimer l'immobilier lui-même
            return self::destroy($id);
        });
    }

}
