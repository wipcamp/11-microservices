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
            'firstname_th' => 'required|max:2'
        ];
    }

    public function messages()
    {
    return [
        'firstname_th.required'  => 'A message is required',
    ];
    }

    public function withValidator($validator)
{
    $validator->after(function ($validator) {
        if ($this->rules()) {
            $validator->errors()->add('field', 'Something is wrong with this field!');
        }
    });
}
}
