<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use Cart;
use Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mungkinJugaSuka = Produk::mungkinJugaSuka()->get();
        return view('cart')->with('mungkinJugaSuka', $mungkinJugaSuka);
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
        $duplikat = Cart::search(function($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if($duplikat->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message', 'Produk sudah ada dikeranjang!');
        
    }

        Cart::add($request->id, $request->nama, 1, $request->harga)
        ->associate('App\Produk');

        return redirect()->route('cart.index')->with('success_message', 'Produk telah ditambahkan di keranjang!');
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
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);
        
        if ($validator->fails()){
            session()->flash('errors', collect(['Produk yang ditambah harus antara 1-5!']) );
            return response()->json(['success' => false], 400);
        }


        Cart::update($id, $request->quantity);

        session()->flash('success_message', 'Jumlah Produk berhasil bertambah!');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_message', 'Produk telah dihapus!');
    }

     /**
     * Simpan produk untuk nanti
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveForLater($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplikat = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if ($duplikat->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message', 'Produk sudah ada pada list simpan untuk nanti!');
        }

        Cart::instance('saveForLater')->add($item->id, $item->nama, 1, $item->harga)
        ->associate('App\Produk');

        return redirect()->route('cart.index')->with('success_message', 'Produk disimpan untuk nanti!');
    }

}



