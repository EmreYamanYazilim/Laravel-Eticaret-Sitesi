@extends('frontend.layout.app')

@section('title')
@endsection

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('home') }}">Anasayfa</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Ürünler</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">Ürünler</h2></div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Referens</button>
{{--                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">--}}
{{--                                        Ajax kullanılacak bölüm--}}
{{--                                        <a class="dropdown-item" href="#" data_sira="a_z_order"> A'dan Z'yeSırala</a>--}}
{{--                                        <a class="dropdown-item" href="#" data_sira="z_a_order"> Z'den A'ya Sırala</a>--}}
{{--                                        <div class="dropdown-divider"></div>--}}
{{--                                        <a class="dropdown-item" href="#" data_sira="price_min_order">Düşükten yüksek fiyata göre sırala</a>--}}
{{--                                        <a class="dropdown-item" href="#" data_sira="price_max_order">Yüskekten düşük fiyata göre sırala</a>--}}
{{--                                    </div>--}}
                                    <div class="btn-group">
                                        <select class="form-control" id="orderList">
                                            <option class="dropdown-item" value="">Sıralama Seçiniz</option>
                                            <option class="dropdown-item" value="id-asc">A-Z ye Sırala</option>
                                            <option class="dropdown-item" value="id-desc">Z-A ye Sırala</option>
                                            <option class="dropdown-item" value="price-asc">Düşük Fiyata göre sırala</option>
                                            <option class="dropdown-item" value="price-desc">Yüksek Fiyata göre sırala</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                    ürünler burdan başlıyor--}}
                    <div class="row mb-5">
                        @if(!empty($products) && $products->count()>0)
                            @foreach($products as $product)
                                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                    <div class="block-4 text-center border">
                                        <figure class="block-4-image">
                                            <a href="{{ route('productdetail', $product->slug) }}"><img src="{{ asset($product->image) }}" alt="Image placeholder" class="img-fluid"></a>
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="{{ route('productdetail', $product->slug) }}">{{ $product->name }}</a></h3>
                                            <p class="mb-0">{{ $product->short_text }}  </p>
                                            <p class="text-primary font-weight-bold">{{ $product->price }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
{{--                    ürünler bitiş--}}

{{--                    paginate bölümü            --}}
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-center">
                            {{--                               {{ $products->whitQueryString()->links('vendor.pagination.bootstrap-4') }}--}}
                            {{ $products->links('vendor.pagination.bootstrap-4') }}

                            <div class="site-block-27">
{{--                                <ul>--}}
{{--                                    <li><a href="#">&lt;</a></li>--}}
{{--                                    <li class="active"><span>1</span></li>--}}
{{--                                    <li><a href="#">2</a></li>--}}
{{--                                    <li><a href="#">3</a></li>--}}
{{--                                    <li><a href="#">4</a></li>--}}
{{--                                    <li><a href="#">5</a></li>--}}
{{--                                    <li><a href="#">&gt;</a></li>--}}
{{--                                </ul>--}}
                            </div>
                        </div>
                    </div>
                </div>
{{--                paginate bitiş--}}

                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <div class="border p-4 rounded mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Kategoriler</h3>
                        @if(!empty($categories))
                            @foreach($categories->where('category_up',null) as $category)
                                <ul class="list-unstyled mb-0">
                                <li class="mb-1"><a href="{{ route($category->slug.'product') }}" class="d-flex"><span>{{ $category->name }}</span> <span class="text-black ml-auto">({{ $category->getTotalProductCount() }})</span></a></li>
                                </ul>
                            @endforeach
                        @endif
                    </div>

                    <div class="border p-4 rounded mb-4">
                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Fiyat aralığı belirle</h3>
                            <div id="slider-range" class="border-primary"></div>
                            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
                            <input type="text" name="text" id="priceBetween" class="form-control"  />
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Boyut</h3>
                            @if(!empty($sizelist))
                                @foreach($sizelist as $key => $size)
                                    <label for="size{{$key}}" class="d-flex">
                                        <input type="checkbox" id="size{{$key}}" value="{{ $size }}" {{ isset(request()->size) && in_array($size,explode(',',request()->size)) ? 'checked' : '' }} class="mr-2 mt-1 sizeList"> <span class="text-black">{{ $size }}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">renk</h3>
                            @if(!empty($colors))
                                @foreach($colors as $key => $color)
                                    <label for="color{{$key}}" class="d-flex">
                                        <input type="checkbox" id="color{{$key}}" value="{{ $color }}"  {{ isset(request()->color) && in_array($color,explode(',',request()->color)) ? 'checked' : '' }} class="mr-2 mt-1 colorList"> <span class="text-black">{{ $color }}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-4">
                            <button class="btn btn-block btn-primary filterBtn">Filitrele</button>
                        </div>

                        </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="site-section site-blocks-2">
                        <div class="row justify-content-center text-center mb-5">
                            <div class="col-md-7 site-section-heading pt-4">
                                <h2>Categories</h2>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($categories))
                             @foreach($categories->where('category_up',null) as $category) {{--    foreach'te category_up null olanları getir diyeceğim categories'i middlewareden çektim--}}
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                                        <a class="block-2-item" href="{{ route($category->slug.'product') }}">
                                            <figure class="image">
                                                <img src="{{ asset($category->image) }} " alt="" class="img-fluid">
                                            </figure>
                                            <div class="text">
                                                <span class="text-uppercase">koleksiyonlar</span>
                                                <h3>{{ $category->name }}</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

@section('customjs')
    <script>
        var maxprice                = "{{$maxprice}}";
        var defaultminprice         = "{{request()->min ?? 0}}";
        var defaultMaxprice         = "{{request()->max ?? $maxprice}}";

        var url = new URL(window.location.href);




        $(document).on('click', '.filterBtn', function(e) {
            filtrele();
        });

        function filtrele() {
            let colorList  = $(".colorList:checked" ).map((_,chk) => chk.value).get()
            let sizeList = $(".sizeList:checked").map((_,chk) => chk.value).get()
            if (colorList.length  > 0) {
                url.searchParams.set("color",  colorList.join(","))
            }else {
                url.searchParams.delete('color');
            }

            if (sizeList.length  > 0) {
                url.searchParams.set("size", sizeList.join(","))
            }else {
                url.searchParams.delete('size');
            }


            var price = $('#priceBetween').val().split('-');
            url.searchParams.set("min", price[0])

            url.searchParams.set("max", price[1])

            newUrl = url.href;
            window.history.pushState({}, '', newUrl);
            location.reload();
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     type:"GET",
            //     url:newUrl,
            //     success: function (response) {
            //
            //         $('.productContent').html(response.data);
            //         $('.paginateButtons').html(response.paginate)
            //     }
            // });

        }

        $(document).on('change', '#orderList', function(e) {


            var order = $(this).val();

            if(order != '') {
                orderby = order.split('-');
                url.searchParams.set("order", orderby[0])
                url.searchParams.set("sort", orderby[1])
            }else {
                url.searchParams.delete('order');
                url.searchParams.delete('sort');
            }

            filtrele();
        });


    </script>
@endsection
