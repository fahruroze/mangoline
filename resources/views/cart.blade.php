@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="#">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shopping Cart</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="cart-section container">
        <div>
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if (Cart::count() > 0)
                <h2>{{ Cart::count() }} Produk di keranjang belanja</h2>

            <div class="cart-table">

                @foreach(Cart::content() as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{route('belanja.show', $item->model->slug)}}"><img src="{{asset('img/produk/'.$item->model->slug.'.jpg')}}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{route('belanja.show', $item->model->slug)}}">{{$item->model->nama}}</a></div>
                            <div class="cart-table-description">{{ $item->model->detail }}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            <!-- <a href="">Remove</a> <br> -->
                            <form action="{{route('cart.destroy', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="cart-options">HAPUS</button> 
                            </form>    

                            <!-- <a href="#">Save for Later</a> -->
                            
                            <form action="{{route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}

                                <button type="submit" class="cart-options">Simpan untuk nanti</button>
                            </form>

                        </div>
                        <div>
                        <select class="quantity" data-id="{{ $item->rowId}}">
                            @for ($i = 1; $i < 5 + 1 ; $i++)
                                <option {{ $item->qty == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                                
                            </select>
                        </div>
                        <div>{{formatRupiah($item->subtotal)}}</div>
                    </div>
                </div> <!-- end cart-table-row -->
                @endforeach


            </div> <!-- end cart-table -->

            <a href="#" class="have-code">Have a Code?</a>

            <div class="have-code-container">
                <form action="#">
                    <input type="text">
                    <button type="submit" class="button button-plain">Apply</button>
                </form>
            </div> <!-- end have-code-container -->

            <div class="cart-totals">
                 <div class="cart-totals-left">
                    Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                </div> 

                <div class="cart-totals-right">
                    <div>
                        <p>Subtotal</p>
                        <p>Pajak(10%)</p> 
                        <span class="cart-totals-total">Total &nbsp;</span>
                    </div>
                    <div class="cart-totals-subtotal">
                    
                        {{ Cart::subtotal() }}<br>
                        {{ Cart::tax() }}<br>
                        
                        <span class="cart-totals-total">{{ 'Rp' . Cart::total() }}</span>
                    </div>
                </div>
            </div> <!-- end cart-totals -->

            <div class="cart-buttons">
                <a href="{{route('belanja.index')}}" class="button">Lanjutkan Belanja</a>
                <a href="{{route('checkout.index')}}" class="button-primary">Checkout!</a>
            </div>

            @else

                <h3>Tidak ada produk di keranjang!</h3>
                <div class="spacer"></div>
                <a href="{{ route('belanja.index') }}" class="button">Lanjutkan Belanja!</a>
                <div class="spacer"></div>

            @endif

            @if (Cart::instance('saveForLater')->count() > 0)

                <h2>{{ Cart::instance('saveForLater')->count() }} Produk disimpan untuk nanti</h2>

            <div class="saved-for-later cart-table">
                @foreach (Cart::instance('saveForLater')->content() as $item)

                
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{route('belanja.show', $item->model->slug) }}"><img src="{{asset('img/produk/'.$item->model->slug.'.jpg')}}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{route('belanja.show', $item->model->slug) }}">{{$item->model->nama}}</a></div>
                            <div class="cart-table-description">{{$item->model->detail}}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            <form action="{{route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="cart-options">HAPUS</button> 
                            </form>    

                            <!-- <a href="#">Save for Later</a> -->
                            
                            <form action="{{route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}

                                <button type="submit" class="cart-options">Pindahkan keKeranjang!</button>
                            </form>
                        </div>
                        
                        <div>{{formatRupiah($item->model->harga)}}</div>
                    </div>
                </div> <!-- end cart-table-row -->
                @endforeach
            </div> <!-- end saved-for-later -->

            @else 

                <h3>Anda tidak punya produk yang disimpan untuk nanti!</h3>
            
            @endif



        </div>

    </div> <!-- end cart-section -->

    @include('partials.might-like')


@endsection

@section('extra-js')

<script src="{{asset('js/app.js')}}"></script>

<script>
    (function(){
        const classname = document.querySelectorAll('.quantity')

        Array.from(classname).forEach(function(element){
            element.addEventListener('change', function(){
                const id = element.getAttribute('data-id')
                axios.patch(`/cart/${id}`, {
                    quantity: this.value
                })
                .then(function (response) {
                    // console.log(response);
                    window.location.href = '{{route('cart.index')}}'
                })
                .catch(function (error) {
                    console.log(error);
                    window.location.href = '{{route('cart.index')}}'
                });
            })
        })
    })();
</script>
@endsection