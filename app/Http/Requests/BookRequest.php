<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'   =>  'required|max:180',
            'isbn'  =>   'required|max:200',
            'author_id'  =>   'required',
            'published_date'  =>   'required',
            'available_copy'  =>   'required',
            'total_copy'  =>   'required',
        ];
    }
}
