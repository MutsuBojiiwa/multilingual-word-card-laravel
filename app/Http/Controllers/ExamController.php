<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\Card;
use App\Models\CardDetail;
use App\Http\Requests\UpdateDeckRequest;

use Illuminate\Http\Request;



class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getExamByDeckId(Request $request)
{
    Log::info('リクエストデータ: ', $request->all()); // リクエスト内容をログに記録

    $validated = $request->validate([
        'deckId' => 'required|integer|exists:decks,id',
    ]);

    $deckId = $validated['deckId'];
    Log::info("バリデーション成功。deckId: {$deckId}");

    // データを取得してレスポンスを返す
    $cardIds = Card::where('deck_id', $deckId)->pluck('id');
    $deckDetails = CardDetail::whereIn('card_id', $cardIds)->get();

    return response()->json(['data' => $deckDetails], 200);
}
}
