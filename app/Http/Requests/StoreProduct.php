<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'name' => 'bail|required|min:1',
            'price' => 'bail|required|min:1|numeric', 
            'stock' => 'bail|required|min:0|numeric',
            'description' => 'bail|required|min:1',
            'imageOne' => 'image'
        ];
    }
}
