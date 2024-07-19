<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetLocaleByIdRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'localeIds' => 'string',
        ];
    }
}
