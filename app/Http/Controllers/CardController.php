<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    public function index()
    {
        $allCards = Card::all();
        return response()->json(['data' => $allCards], 200);
    }

    public function getCardsByDeckId($deckId)
    {
        $cards = Card::where('deck_id', $deckId)->get();

        return response()->json(['data' => $cards], 200);
    }
}
