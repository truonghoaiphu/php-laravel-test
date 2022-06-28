<?php

namespace App\Http\Controllers;

use App\Models\Wager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Requests\Wager\StoreWagersRequest;

class WagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWagersRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(StoreWagersRequest $request)
    {
        DB::beginTransaction();
        try {
            $toalWagerValue      = $request->input('total_wager_value');
            $oods                = $request->input('odds');
            $sellingPercentage   = $request->input('selling_percentage');
            $sellingPrice        = $request->input('selling_price');
            $currentSellingPrice = $request->input('current_selling_price', 0);
            $percentageSold      = $request->input('percentage_sold', 0);
            $amountSold          = $request->input('amount_sold', 0);
            $now                 = Carbon::now();
            $wager = Wager::create([
                'total_wager_value'     => $toalWagerValue,
                'odds'                  => $oods,
                'selling_percentage'    => $sellingPercentage,
                'selling_price'         => $request->input('selling_price'),
                'current_selling_price' => $currentSellingPrice,
                'percentage_sold'       => $percentageSold,
                'amount_sold'           => $amountSold,
                'placed_at'             => $now,
                'created_at'            => $now,
                'updated_at'            => $now
            ]);
//            if ($sellingPrice <= $toalWagerValue * $sellingPercentage / 100) {
//                return response()->json([
//                    'error' => "The selling price must be greater than ". $toalWagerValue * $sellingPercentage / 100.".",
//                ]);
//            } else {
//                $wager = Wager::create([
//                    'selling_price' => $sellingPrice,
//                ]);
//            }
            $wager->save();
            DB::commit();

            return response([
                'id'                    => $wager->id,
                'total_wager_value'     => $wager->total_wager_value,
                'odds'                  => $wager->odds,
                'selling_percentage'    => $wager->selling_percentage,
                'selling_price'         => $wager->selling_price,
                'current_selling_price' => $wager->current_selling_price,
                'percentage_sold'       => $wager->percentage_sold,
                'amount_sold'           => $wager->amount_sold,
                'placed_at'             => $wager->placed_at,
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wager  $wager
     * @return \Illuminate\Http\Response
     */
    public function show(Wager $wager)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wager  $wager
     * @return \Illuminate\Http\Response
     */
    public function edit(Wager $wager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wager  $wager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wager $wager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wager  $wager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wager $wager)
    {
        //
    }
}
