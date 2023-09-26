@extends('frontend.layout.app')


@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('home') }}">Anasayfa</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Sepet</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->get('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                    @endif
                </div>
            </div>
            <div class="row mb-5" >
                    <div  class="col-lg-12 site-blocks-table"   >
                        <table class=" table table-bordered">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Resim</th>
                                <th class="product-name">Ürün</th>
                                <th class="product-price">Fiyat</th>
                                <th class="product-quantity">Adet</th>
                                <th class="product-total">Toplam</th>
                                <th class="product-remove">Sil</th>
                            </tr>
                            </thead>
                            <tbody>



                            @if($cartItem)
                            @foreach($cartItem as $key => $cart)
                                <tr class="orderItem" data-id="{{ $key }}">
                                    <td class="product-thumbnail">
                                        <img src="{{asset($cart['image'])}}" alt="Image" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{$cart['name'] ?? ''}}</h2>
                                    </td>
                                    <td>{{$cart['price']}}</td>
                                    <td>
                                        <div class="input-group mb-3" style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-primary js-btn-minus decreaseBtn" type="button">&minus;</button>
                                            </div>
                                            <input type="text" class="form-control text-center qtyItem" value="{{$cart['qty']}}"  aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary js-btn-plus increaseBtn" type="button">&plus;</button>
                                            </div>
                                        </div>

                                    </td>
                                    <td>{{$cart['price'] * $cart['qty']}}</td>
                                    <form action="{{ route('basket.remove') }}" method="post">
                                        @csrf
                                    <td>
                                        <input type="hidden" name="product_id" value="{{ $key }}">
                                        <button type="submit" class="btn btn-primary btn-sm">X</button></td>
                                    </form>
                                </tr>
                            @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-primary btn-sm btn-block">Sepeti Güncelle </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary btn-sm btn-block">Ödemeye Geçin.</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Kupon</label>
                            <p>Indirim kuponunuz varsa lütfen girin.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="indirim kodu">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-sm">Kupon Kodu Onayla </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Toplam Tutar </span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">{{ $totalPrice }}</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg py-3 btn-block paymentButton" >Proceed To Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('customjs')

    <script>
        $(document).on('click', '.paymentButton', function(e) {
            var url = "#";


            @if(!empty(session()->get('cart')))
                window.location.href = url;
            @endif

        });


        $(document).on('click', '.decreaseBtn', function(e) {
            $('.orderItem').removeClass('selected');
            $(this).closest('.orderItem').addClass('selected');
            sepetUpdate();
        });

        $(document).on('click', '.increaseBtn', function(e) {
            $('.orderItem').removeClass('selected');
            $(this).closest('.orderItem').addClass('selected');
            sepetUpdate();
        });

        function sepetUpdate() {
            var product_id  = $('.selected').closest('.orderItem').attr('data-id');
            var qty  = $('.selected').closest('.orderItem').find('.qtyItem').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{route('cart.newqty')}}",
                data:{
                    product_id:product_id,
                    qty:qty,
                },
                success: function (response) {
                    $('.selected').find('.itemTotal').text(response.itemTotal+' ₺');
                    if(qty == 0) {
                        $('.selected').remove();
                    }
                    $('.newTotalPrice').text(response.totalPrice);
                }
            });
        }

        $(document).on('click', '.removeItem', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            var item = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{route('basket.remove')}}",
                data:formData,
                success: function (response) {
                    toastr.success(response.message);
                    $('.count').text(response.sepetCount);
                    item.closest('.orderItem').remove();
                }
            });

        });






    </script>
@endsection

