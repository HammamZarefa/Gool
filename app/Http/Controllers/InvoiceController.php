<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Invoices";
        $invoices=Invoice::all();
        return view('admin.invoice.index',$data,compact('invoices'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'items' => ['required', 'JSON']
        ]);
        $request = json_decode(request()->get('items'));
        Log::info([$request]);
        $bets = $request->total_bets ?? null;
        $amount = (float)$request->amount ?? null;

        if (!$bets || !$amount)
            return response()->json([
                'message' => 'invalid data passed.',
                'error' => []
            ], 400);

        if ($amount <= 0 || $amount > (float)auth()->user()->balance)
            return ['error' => [
                'amount' => 'must be between 0, ' . Auth::user()->balance
            ], 'message' => 'invalid amount passed'];
        $new_balance = auth()->user()->balance - $amount;
        Auth::user()->update([
            'balance' => $new_balance
        ]);
        $predict = $amount / count($bets);
//        $invoice_id = abs(random_int(9999, PHP_INT_MAX-1000));

        $invoice=New Invoice();
        $invoice->coupon_id=time().mt_rand();
        $invoice->user_id= auth()->id();
        $invoice->amount=$amount;
        $invoice->date=Now();
        $invoice->status='Proccessing';
        $possible_win=0;
        foreach($bets as $bet){
            if($bet)
            $possible_win=$possible_win +($amount* $bet->bet_value);
        }
                $invoice->possible_win=$possible_win;
        $invoice->save();

        foreach($bets as $bet){
            if($bet)
           Bet::create([
                'country_name' => $bet->country_name,
                'league_name' => $bet->league_name,
                'bet_value' => $bet->selection_name,
                'user_id' => auth()->id(),
                'away_team' => $bet->away_team,
                'home_team' => $bet->home_team,
                'match_date' => "2022/{$bet->start_date}",
                'match_time' => $bet->start_time,
                'predict_amount' => $predict,
                'return_amount' => $amount * (float) $bet->bet_value,
                'invoice_id' => $invoice->id,
                'bet_type'=> isset($bet->val_name)  ? $bet->val_name : 'الرهان الرئيسي'
            ]);
        };

        return response()->json([
            'balance' => $new_balance,
            'message' => 'تم اضافة الرهان بنجاح',
            'error' => null
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
