@extends('layout')

@section('title', $produk->nama)

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <a href="{{ route('belanja.index')}}">Belanja</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Macbook Pro</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="product-section container">
        <div class="product-section-image">
            <img src="{{ asset('img/produk/'.$produk->slug.'.jpg') }}" alt="product">
        </div>
        <div class="product-section-information">
            <h1 class="product-section-title">{{$produk->nama}}</h1>
            <div class="product-section-subtitle">{{$produk->detail}}</div>
            <div class="product-section-price">{{formatRupiah($produk->harga)}}</div>

            <p>
                {{$produk->deskripsi}}
            </p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas magni accusantium, sapiente dicta iusto ut dignissimos atque placeat tempora iste.</p>

            <p>&nbsp;</p>

            <!-- <a href="" class="button">Add to Cart</a> -->
            <form action="{{route('cart.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $produk->id }}">
                <input type="hidden" name="nama" value="{{ $produk->nama }}">
                <input type="hidden" name="harga" value="{{ $produk->harga }}">
                
                <button type="submit" class="button button-plain">Tambah ke Keranjang</button>
            </form>
        </div>
    </div> <!-- end product-section -->

    @include('partials.might-like')


@endsection
