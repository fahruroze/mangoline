<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class SaveForLaterController extends Controller
{
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success_message', 'Produk telah dihapus!');
    }

    /**
     * Memindahkan list produk yang tersimpan ke dalam keranjang
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplikat = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if ($duplikat->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message', 'Produk sudah ada diKeranjang!');
        }

        Cart::instance('default')->add($item->id, $item->nama, 1, $item->harga)
        ->associate('App\Produk');

        return redirect()->route('cart.index')->with('success_message', 'Produk telah dimasukkan keKeranjang!');
    }
}
