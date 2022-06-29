<?php

namespace App\Http\Requests\Purchase;

use App\Http\Requests\BaseRequest;
use App\Rules\BuyingPriceRule;
use Illuminate\Support\Facades\Route;

class BuyPurchasesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $wagerId = Route::input('wager_id');
        return [
            'buying_price'      => [
                                        'required',
                                        'numeric',
                                        'gt:0',
                                        (new BuyingPriceRule())
                                            ->wagerId($wagerId)
                                    ],
        ];
    }
}
