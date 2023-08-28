<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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

            'name'      =>  'required|min:3|string',
            'content'   =>  'required|string',
        ];

    }

    public function messages()
    {
        return [
            'name.required'     =>      'Başlık Girimlesi zorunlu alan ',
            'name.min'          =>      'Başlık En az 3 karakter olmalı ',
            'name.string'       =>      'Başlıkisim karakterlerden olmalı ',
            'content.required'  =>      'Slogan Girilmesi Zorunlu Alan ',
            'content.string'    =>      'Slogan isim karakterlerden olmalı ',

        ];
    }
}
