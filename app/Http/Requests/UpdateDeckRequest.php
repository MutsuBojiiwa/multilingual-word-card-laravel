<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeckRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userId' => 'required|integer',
            'name' => 'required|string',
            'isFavorite' => 'required|boolean',
            'isPublic' => 'required|boolean',
        ];
    }
}
