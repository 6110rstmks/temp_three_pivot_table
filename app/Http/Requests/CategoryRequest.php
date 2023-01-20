<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            // 'title' => 'required',
            // 'update-title' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'title.required' => 'Title is required.',
            // 'update-title.required' => 'Title is required.',
            // 'title.min' => ':min 文字以上入力してください',
        ];
    }
}
