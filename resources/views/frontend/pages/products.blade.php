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
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
{{--                                        Ajax kullanılacak bölüm--}}
                                        <a class="dropdown-item" href="#" data_sira="a_z_order"> A'dan Z'yeSırala</a>
                                        <a class="dropdown-item" href="#" data_sira="z_a_order"> Z'den A'ya Sırala</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data_sira="price_min_order">Düşükten yüksek fiyata göre sırala</a>
                                        <a class="dropdown-item" href="#" data_sira="price_max_order">Yüskekten düşük fiyata göre sırala</a>
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
                                            <p class="text-primary font-weight-bold">{{ number_format($product->price,0)  }}</p>
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
                                <li class="mb-1"><a href="{{ route($category->slug.'product') }}" class="d-flex"><span>{{ $category->name }}</span> <span class="text-black ml-auto">({{ $category->items_count }})</span></a></li>
                                </ul>
                            @endforeach
                        @endif
                    </div>

                    <div class="border p-4 rounded mb-4">
                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Fiyat aralığı belirle</h3>
                            <div id="slider-range" class="border-primary"></div>
                            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Boyut</h3>
                            @if(!empty($sizelist))
                                @foreach($sizelist as $size)
                                    <label for="s_sm" class="d-flex">
                                        <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">{{ $size }}</span>
                                    </label>
                                @endforeach
                            @endif


                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">renk</h3>

                            @if(!empty($colors))
                                @foreach($colors as $color)
                                    <a href="#" class="d-flex color-item align-items-center" >
                                        <span class="bg-success color d-inline-block rounded-circle mr-2"></span> <span class="text-black">{{ $color }}</span>
                                    </a>
                                @endforeach
                            @endif

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
        var minprice = "{{$minprice}}";
        var maxprice = "{{$maxprice}}";
    </script>
@endsection
