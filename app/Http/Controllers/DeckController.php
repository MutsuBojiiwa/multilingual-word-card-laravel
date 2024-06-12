<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deck;

class DeckController extends Controller
{
    public function index()
    {
        return Deck::all();
    }

    public function store(Request $request)
    {
        $deck = Deck::create($request->all());
        return response()->json($deck, 201);
    }

    public function show($id)
    {
        $deck = Deck::findOrFail($id);
        return response()->json($deck);
    }

    public function update(Request $request, $id)
    {
        $deck = Deck::findOrFail($id);
        $deck->update($request->all());
        return response()->json($deck);
    }

    public function destroy($id)
    {
        Deck::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
