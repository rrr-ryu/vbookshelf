<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'site_name_id' => 'required|exists:site_names,id',
            'genre_id' => 'required|exists:genres,id',
            'finish' => 'required|boolean',
            'read_page' => 'required|integer',
            'all_page' => 'required|integer',
            'assessment' => 'required|integer'
        ];
    }
}
