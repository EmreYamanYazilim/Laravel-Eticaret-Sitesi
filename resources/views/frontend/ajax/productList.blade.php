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
