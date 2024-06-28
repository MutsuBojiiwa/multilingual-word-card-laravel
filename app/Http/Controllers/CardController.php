<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Card;
use App\Models\CardDetail;
use App\Models\LocaleMaster;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

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

    public function store(Request $request)
    {
        // 新規のカードを作る
        $card = Card::create([
            'deck_id' => $request->deck_id
        ]);

        // さっき作ったカードIDでカード詳細を作る
        $cardDetails = [];
        foreach ($request->details as $detail) {
            $cardDetails[] = new CardDetail([
                'card_id' => $card->id,
                'locale_id' => $detail['locale_id'],
                'word' => $detail['word'],
            ]);
        }
        $card->details()->saveMany($cardDetails);

        return response()->json([
            'data' => [
                'card' => $card,
                'cardDetails' => $cardDetails
            ]
        ], 201);
    }

    public function deleteCard($cardId)
    {
        Card::findOrFail($cardId)->delete();
        return response()->json(null, 204);
    }
}
