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


        $formattedLocales = $locales->map(function ($locale) {
            $localeNames = ['ja' => "日本語", "en" => "English", "fr" => "Français"];
            return [
                'id' => $locale->id,
                'key' => $locale->key,
                'name' => $localeNames[$locale->key] ?? 'undefined'
            ];
        });

        return response()->json([
            'data' => [
                'locales' => $formattedLocales,
                'cards' => $cards,
            ],
        ], 200);
    }
}
