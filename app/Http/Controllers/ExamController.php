<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Card;
use App\Models\CardDetail;
use App\Models\LocaleMaster;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getExamByDeckId(Request $request)
    {
        Log::info('リクエストデータ: ', $request->all());

        // バリデーション
        $validated = $request->validate([
            'deckId' => 'required|integer|exists:decks,id',
        ]);

        $deckId = $validated['deckId'];
        Log::info("バリデーション成功。deckId: {$deckId}");

        // カードIDを取得
        $cardIds = Card::where('deck_id', $deckId)->pluck('id');

        // カード詳細を取得
        $cardDetails = CardDetail::whereIn('card_id', $cardIds)->get();

        // このデッキに含まれるユニークなロケールIDを取得
        $includedLocaleIds = $cardDetails->pluck('locale_id')->unique();

        // ロケール情報を取得
        $locales = LocaleMaster::whereIn('id', $includedLocaleIds)->get();

        // `Results` 配列を生成
        $results = $locales
            ->filter(function ($locale) {
                return $locale->id !== 1; // ロケールIDが1のものを除外
            })
            ->map(function ($locale) use ($cardDetails) {
                $questionCount = $cardDetails->where('locale_id', $locale->id)->count();
                return [
                    'locale_id' => $locale->id,
                    'locale_name' => $locale->name,
                    'correctCount' => 0, // 初期値
                    'questionCount' => $questionCount,
                ];
            })
            ->values();

        // 他のロケールの`questionCount`の合計を計算
        $totalQuestionCount = $results->sum('questionCount');

        // 「正答率」という名前のロケールID 0のデータを追加
        $results->prepend([
            'locale_id' => 0,
            'locale_name' => '正答率',
            'correctCount' => 0, // 初期値
            'questionCount' => $totalQuestionCount,
        ]);

        // データを整形
        $exams = [];
        foreach ($cardIds as $cardId) {
            // 質問データ
            $questions = $cardDetails->where('card_id', $cardId)->where('locale_id', 1);
            foreach ($questions as $question) {
                // 回答データ
                $answers = $cardDetails->where('card_id', $cardId)->where('locale_id', '!=', 1);
                foreach ($answers as $answer) {
                    $exams[] = [
                        'question' => [
                            'card_id' => $question->card_id,
                            'id' => $question->id,
                            'locale_id' => $question->locale_id,
                            'locale_name' => $locales->firstWhere('id', $question->locale_id)->name ?? '不明',
                            'word' => $question->word,
                        ],
                        'answer' => [
                            'card_id' => $answer->card_id,
                            'id' => $answer->id,
                            'locale_id' => $answer->locale_id,
                            'locale_name' => $locales->firstWhere('id', $answer->locale_id)->name ?? '不明',
                            'word' => $answer->word,
                        ],
                    ];
                }
            }
        }

        $response = [
            'exams' => $exams,
            'results' => $results, // このデッキに含まれるロケールだけを返す
        ];

        return response()->json(['data' => $response], 200);
    }
}
