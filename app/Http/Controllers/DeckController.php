<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\Deck;
use App\Http\Requests\UpdateDeckRequest;

use Illuminate\Http\Request;



class DeckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getDecksByUserId($userId)
    {
        $decks = Deck::where('user_id', $userId)->get();

        return response()->json(['data' => $decks], 200);
    }

    public function store(Request $request)
    {
        $deck = Deck::create([
            'user_id' => $request->user_id,
            'name' => '新しいデッキ'
        ]);

        return response()->json(['data' => $deck], 201);
    }

    public function update(UpdateDeckRequest $request, $id)
    {
        $validatedData = $request->validated();

        $deck = Deck::findOrFail($id);
        $deck->user_id = $validatedData['userId'];
        $deck->name = $validatedData['name'];
        $deck->is_favorite = $validatedData['isFavorite'];
        $deck->is_public = $validatedData['isPublic'];
        $deck->save();

        return response()->json($deck);
    }

    public function destroy($id)
    {
        Deck::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
