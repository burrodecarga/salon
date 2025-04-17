<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePruebaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('student');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'examen_id'=>'rquired',
            'teacher_id'=>'rquired',
            'student_id'=>'rquired',
        ];
    }
}
