<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
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
    public function store(CheckoutRequest $request)
    {

        $contents = Cart::content()->map(function($item) {
            return $item->model->slug.' , '.$item->qty;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => Cart::total(),
                'currency' => 'CAD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' =>$request->email,
                'metadata' => [
                    //change to Order ID after we start using DB
                     'contents' => $contents,
                     'quantity' => Cart::instance('default')->count(),
                ],
            ]);

            //Succecfull
            Cart::instance('default')->destroy();

            // return back()->with('success_message', 'Trimakasih, Pembayaranmu telah diterima!');
            return redirect()->route('confirmation.index')->with('success_message', 'Terimakasih Pembayaran berhasil!');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error!' . $e->getMessage());
        }
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
