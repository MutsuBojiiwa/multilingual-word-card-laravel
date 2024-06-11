<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id', 'locale_id', 'word'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function locale()
    {
        return $this->belongsTo(LocaleMaster::class, 'locale_id');
    }
}
