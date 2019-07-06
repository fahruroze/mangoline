<div class="might-like-section">
    <div class="container">
        <h2>Mungkin kamu juga suka...</h2>
        <div class="might-like-grid">
        @foreach ($mungkinJugaSuka as $produk)
            <a href="{{route('belanja.show', $produk->slug)}}" class="might-like-product">
                <img src="{{ asset('img/produk/'.$produk->slug.'.jpg') }}" alt="product">
                <div class="might-like-product-name">{{$produk->nama}}</div>
                <div class="might-like-product-price">{{formatRupiah($produk->harga)}}</div>
            </a>
        @endforeach
            
           
        </div>
    </div>
</div>
