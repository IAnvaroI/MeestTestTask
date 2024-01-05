<?php

namespace App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateNoteRequest extends FormRequest
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
            'content' => [
                'required',
                'string',
                'max:255',
                Rule::unique('notes', 'content')->where(
                    fn(Builder $query) => $query->where('user_id', Auth::user()->id)
                )->ignore($this->route('note')) // using request input in ignore is safe because there is the pattern for parameter to be only numeric in RouteServiceProvider
            ],
        ];
    }
}
