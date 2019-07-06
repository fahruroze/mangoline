@extends('layout')

@section('title', 'Products')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shop</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="products-section container">
        <div class="sidebar">
            <h3>By Category</h3>
            <ul>
                @foreach ($categories as $category)
            <li><a href="{{route('belanja.index', ['category'=>$category->slug])}}">{{$category->nama}}</a></li>
                @endforeach
            </ul>

            <h3>By Price</h3>
            <ul>
                <li><a href="#">$0 - $700</a></li>
                <li><a href="#">$700 - $2500</a></li>
                <li><a href="#">$2500+</a></li>
            </ul>
        </div> <!-- end sidebar -->
        <div>
            <h1 class="stylish-heading">{{$categoryName}}</h1>
            <div class="products text-center">

            @forelse ($produks as $produk)
                <div class="product">
                    <a href="{{ route('belanja.show', $produk->slug) }}"><img src="{{asset('img/produk/'.$produk->slug.'.jpg') }}" alt="product"></a>
                    <a href="{{ route('belanja.show', $produk->slug) }}"><div class="product-name">{{$produk->nama}}</div></a>
                    <div class="product-price">{{formatRupiah($produk->harga)}}</div>
                </div>
            @empty
                <div style="text-align:left">Produk tidak ditemukan!</div>
            @endforelse
                 
            </div> <!-- end products -->
        </div>
    </div>


@endsection
