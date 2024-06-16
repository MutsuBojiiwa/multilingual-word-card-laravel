<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Card;
use App\Models\CardDetail;
use App\Models\LocaleMaster;

class CardController extends Controller
{
    public function getAll()
    {
        $allCards = Card::all();
        return response()->json(['data' => $allCards], 200);
    }

    public function getCardDetailsByDeckId($deckId)
    {
        $cards = Card::where('deck_id', $deckId)->with('details')->get();

        $usedLocaleIds = $cards->pluck('details.*.locale_id')->flatten()->unique();

        $locales = LocaleMaster::whereIn('id', $usedLocaleIds)->get();

        return response()->json([
            'data' => [
                'locales' => $locales,
                'cards' => $cards,
            ],
        ], 200);
    }
}
