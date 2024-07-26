<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Immobilier;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable = [
        'immobilier_id',
        'user_id'
    ];
    public function immobilier()
    {
        return $this->belongsTo(Immobilier::class);
    }
   
   
   
}
