<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrders extends FormRequest
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
            'phone' => 'bail|required|min:1|numeric',
            'address' => 'bail|required|min:1',
            'order' => 'bail|required|min:1',
            'totalPrice' => 'bail|required|min:1',
        ];
    }
}
