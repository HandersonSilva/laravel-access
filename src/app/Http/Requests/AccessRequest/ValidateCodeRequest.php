<?php

namespace SecurityTools\LaravelAccess\Http\Requests\AccessRequest;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|integer',
            'nonce' => 'required|string',
            'form_id' => 'required|string',
        ];
    }
}
