<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJailRequest extends FormRequest
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
            'hostname' => 'required|unique:jails',
            'ip_id' => 'required|integer|unique:jails',
            'quota' => 'required|integer|max:50',
            'ssh_key' => 'required',
        ];
    }
}
