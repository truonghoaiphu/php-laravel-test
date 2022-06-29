<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BuyingPriceRule implements Rule
{
    protected $wagerId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function wagerId($wagerId)
    {
        $this->wagerId = $wagerId;

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $wager = DB::table('wagers')->find($this->wagerId);
        return ($value <= $wager->current_selling_price);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be lesser or equal to current_selling_price of the wager_id.';
    }
}
