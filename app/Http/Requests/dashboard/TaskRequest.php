<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required',
            'assigned_users' => 'required|array',
            'assigned_users.*' => 'exists:users,id',
            'attachment' => 'nullable|file|max:2048',
        ];

        if ($this->isMethod('put')) {
            $rules['assigned_users'] = 'sometimes|array';
            $rules['assigned_users.*'] = 'sometimes|exists:users,id';
        }
        return $rules;
    }
}
