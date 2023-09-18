@extends('backend.layout.app')

@section('content')
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ürün Ekle</h4>

                @if($errors)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if(!empty($product->id))
                    @php
                        $routeLink = route('panel.product.update',$product->id);
                     @endphp
                @else
                    @php
                        $routeLink =  route('panel.product.store');
                    @endphp
                @endif
                <form action="{{ $routeLink }}" method="post"   enctype="multipart/form-data">
                    @csrf
                    @if(!empty($product->id))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <div class="input-group col-xs-12" >
                            <img width="150" height="155" src="{{ asset($product->image ?? 'https://fakeimg.pl/250x190/') }}" alt="">
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Resim</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info"  placeholder="Resim Yükleyin">
                            <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Başlık </label>
                        <input type="text" class="form-control" id="name" placeholder="Kategori ismi" value="{{ $product->name ?? '' }}" name="name">
                    </div>
                    <div class="form-grup">
                        <label for="name" >Kategori</label>
                        <select name="category_id" class="form-control">
                            <option value="" >Kategori Seç</option>
                            @if($categories)
                                @foreach($categories as $alt)
                                    <option value="{{ $alt->id }}" {{ isset($product) && $product->category_up == $alt->id ? 'selected' : '' }} >{{ $alt->name }}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Renk </label>
                        <input type="text" class="form-control" id="color" value="{{ $product->color ?? '' }}" name="color">
                    </div>
                    <div class="form-group">
                        <label for="name">Ölçü </label>
                        <select name="size" id="size" class="form-control">
                            <option value="S"  {{ isset($product->size) && $product->size == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M"  {{ isset($product->size) && $product->size == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L"  {{ isset($product->size) && $product->size == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ isset($product->size) && $product->size == 'XL' ? 'selected' : '' }}>XL</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="name">Fiyat </label>
                        <input type="text" class="form-control" id="price"  value="{{ $product->price ?? '' }}" name="price">
                    </div>
                    <div class="form-group">
                        <label for="name">Kısa Bilgi </label>
                        <input type="text" class="form-control" id="short_text"  value="{{ $product->short_text ?? '' }}" name="short_text">
                    </div>
                    <div class="form-group">
                        <label for="name">Başlık </label>
                        <input type="text" class="form-control" id="short" value="{{ $product->name ?? '' }}" name="name">
                    </div>



                    <div class="form-group">
                        <label for="content1">İçerik Yazısı </label>
                        <textarea   class="form-control" id="editor" name="content1"  rows="3">{{ $product->content ?? '' }}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="status">Durum</label>
                        @php
                            $status = $product->status ?? '1';
                         @endphp
                        <select class="form-control" id="status" name="status">
                            <option value="0" {{ $status == '0' ? 'selected' : '' }}>Pasif</option>
                            <option value="1" {{ $status == '1' ? 'selected' : '' }}>Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Onayla</button>
                    <button class="btn btn-light">İptal Et</button>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('customjs')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/translations/tr.js"></script>

    <script>

        const option = {
            language: 'tr',
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
        };

        ClassicEditor
            .create( document.querySelector( '#editor' ), option )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
