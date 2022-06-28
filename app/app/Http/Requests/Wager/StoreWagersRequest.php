<?php

namespace App\Http\Requests\Wager;

use App\Http\Requests\BaseRequest;
use App\Rules\SellingPriceRule;

class StoreWagersRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'total_wager_value'             => 'required|integer|gt:0',
            'odds'                          => 'required|integer|gt:0',
            'selling_percentage'            => 'required|integer|between:1,100',
            'selling_price'   => [
                'required',
                'numeric',
                (new SellingPriceRule())
                ->totalWagerValue(':total_wager_value')
                ->sellingPercentage('selling_percentage'),
            ],
        ];
    }
}
