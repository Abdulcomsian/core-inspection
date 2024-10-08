<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . auth()->id(),
            ],
            'qualification' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'signature' => ['nullable', 'file', 'image', 'max:1024'],
        ];
    }
}
