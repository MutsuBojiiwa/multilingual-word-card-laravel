<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deck;

class DeckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // public function getAll()
    // {
    //     $allDecks = Deck::all();
    //     return response()->json(['data' => $allDecks], 200);
    // }

    public function getDecksByUserId($userId)
    {
        $decks = Deck::where('user_id', $userId)->get();

        return response()->json(['data' => $decks], 200);
    }

    // public function store(Request $request)
    // {
    //     $deck = Deck::create($request->all());
    //     return response()->json(['data' => $deck], 201);
    // }

    // public function show($id)
    // {
    //     $deck = Deck::findOrFail($id);
    //     return response()->json(['data' => $deck], 200);
    // }

    // public function update(Request $request, $id)
    // {
    //     $deck = Deck::findOrFail($id);
    //     $deck->update($request->all());
    //     return response()->json($deck);
    // }

    // public function destroy($id)
    // {
    //     Deck::findOrFail($id)->delete();
    //     return response()->json(null, 204);
    // }
}
