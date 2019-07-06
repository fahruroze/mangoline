<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Produk;

class HalamanAwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = Produk::inRandomOrder()->take(8)->get();

        return view('halaman-awal')->with('produks', $produks);
    } 

    
}
