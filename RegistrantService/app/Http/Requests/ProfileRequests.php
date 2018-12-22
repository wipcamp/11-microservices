<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequests extends FormRequest
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
            // 'wip_id' => 'required',
            'firstname_th' => 'required|max:2'
        ];
    }

    public function messages()
{
    return [
        // 'wip_id.required' => 'A title is required',
        'firstname_th.required'  => 'A message is required',
    ];
}
}
