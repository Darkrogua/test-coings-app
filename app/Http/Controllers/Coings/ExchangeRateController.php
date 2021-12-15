<?php

namespace App\Http\Controllers\Coings;

use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Validator;
use Input;
use DB;

class ExchangeRateController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ["at_date" => "date"]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "messages" => $validator->messages()
            ])->setStatusCode(404);
        }

//        $items = ExchangeRate::where(function ($q) use ($request) {
//            $office_id = $request->office_id;
//            $at_date = $request->at_date;
//            if ($office_id and $office_id != 'Все офисы') $q->whereNull('office_id')->orWhere('office_id', $office_id);
//            if ($at_date) $q->where('begins_at', date('Y-m-d H:i:s', strtotime($at_date)));
//        })->orderBy('created_at','desc')->get(['buy_price','sell_price','currency_id']);

        $items = DB::table('exchange_rates as exchange')
        ->join('currencies', 'exchange.currency_id', '=', 'currencies.id')
        ->where(function ($q) use ($request) {
            $office_id = $request->office_id;
            $at_date = $request->at_date;
            if ($office_id and $office_id != 'Все офисы') $q->whereNull('office_id')->orWhere('office_id', $office_id);
            if ($at_date) $q->where('begins_at', date('Y-m-d H:i:s', strtotime($at_date)));
        })
        ->orderBy('exchange.created_at','DESC')
        ->paginate(6, ['buy_price','sell_price','code']);

        return response()->json([
            "status" => true,
            "records" => $items
        ])->setStatusCode(200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "currency"      => "required",
                "buy"           => "required",
                "sell"          => "required",
                "begins_at"     => "required|date"
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "messages" => $validator->messages()
            ])->setStatusCode(500);
        }

        $currency = Currency::firstOrCreate(
            ['code' => $request->currency],
            ['active' => 1, 'name' => $request->currency]
        );

        if ($request->office_id != null) {
            Office::firstOrCreate(
                ['name' => $request->office_id],
                ['active' => 1]
            );
        }

        $exchange_rate = ExchangeRate::create([
            "currency_id" => $currency->id,
            "buy_price" => $request->buy,
            "sell_price" => $request->sell,
            "office_id" => $request->office_id,
            "begins_at" => date('Y-m-d H:i:s', strtotime($request->begins_at))
        ]);

        return response()->json([
            "status" => true,
            "record" => $exchange_rate
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
