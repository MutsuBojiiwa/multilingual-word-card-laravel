<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'card_id' => 'required|integer',
            'word' => 'required|string',
            'locale_id' => 'required|integer',
        ];
    }
}
