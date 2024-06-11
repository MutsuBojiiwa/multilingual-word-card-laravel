<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'is_favorite', 'is_public'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
