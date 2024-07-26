<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Tchat extends Model
{
    use HasFactory;
    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function response()
    {
        return $this->belongsTo(Answer::class, 'response_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
