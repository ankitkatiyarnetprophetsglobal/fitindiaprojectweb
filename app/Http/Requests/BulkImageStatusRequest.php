<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkImageStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
            'status' => 'sometimes|in:1,2,3'
        ];
    }

      public function messages()
    {
        return [
            'user_ids.required' => 'Please select at least one user',
            'user_ids.array' => 'Invalid user selection',
            'user_ids.*.exists' => 'One or more selected users do not exist'
        ];
    }
}
