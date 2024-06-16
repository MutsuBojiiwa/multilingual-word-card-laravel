<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deck;
use Illuminate\Support\Facades\Log;

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

    // public function switchFavorite($id)
    // {
    //     // Deck を取得、存在しない場合は 404 エラーをスロー
    //     $deck = Deck::findOrFail($id);

    //     // is_favorite を切り替えて保存
    //     $deck->is_favorite = !$deck->is_favorite;
    //     $deck->save();

    //     // 更新後の Deck を JSON 形式で返す
    //     return response()->json($deck);
    // }

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

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'userId' => 'required|integer',
            'name' => 'required|string',
            'isFavorite' => 'required|boolean',
            'isPublic' => 'required|boolean',
        ]);

        $deck = Deck::findOrFail($id);
        $deck->user_id = $validatedData['userId'];
        $deck->name = $validatedData['name'];
        $deck->is_favorite = $validatedData['isFavorite'];
        $deck->is_public = $validatedData['isPublic'];
        $deck->save();

        return response()->json($deck);
    }

    // public function destroy($id)
    // {
    //     Deck::findOrFail($id)->delete();
    //     return response()->json(null, 204);
    // }
}
