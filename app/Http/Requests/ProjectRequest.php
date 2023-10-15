<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Project;


class ProjectRequest extends FormRequest
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
            'project_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email', 'max:255'],
            'environment_id' => ['required', 'exists:environments,id'],
            'start_date' => 'required','date',
            // 'end_date' => 'required_if:auto_renewal,0|nullable|date',
            'end_date' => [
                'required_if:auto_renewal,0',
                'nullable',
                'date',
            ],
            'auto_renewal' => ['nullable','boolean'],
            'member_id' => ['required',  'exists:members,id'],
            'options_id.*' => ['distinct', 'exists:options,id'],
        ];
    }
}
