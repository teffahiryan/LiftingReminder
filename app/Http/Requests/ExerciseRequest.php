<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ExerciseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2'],
            'description' => ['required'],
            'repetition' => ['integer'],
            'set' => ['integer'],
            'image' => ['image', 'max:2000'],
            'user_id' => ['required']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->input('user_id') ?: Auth::id(),
            'repetition' => 0,
            'set' => 0
        ]);
    }
}
