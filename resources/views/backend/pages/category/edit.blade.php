@extends('backend.layout.app')

@section('content')
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kategori</h4>

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

                @if(!empty($category->id))
                    @php
                        $routeLink = route('panel.category.update',$category->id);
                     @endphp
                @else
                    @php
                        $routeLink =  route('panel.category.store');
                    @endphp
                @endif
                <form action="{{ $routeLink }}" method="post"   enctype="multipart/form-data">
                    @csrf
                    @if(!empty($category->id))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <div class="input-group col-xs-12" >
                            <img width="150" height="155" src="{{ asset($category->image ?? 'https://fakeimg.pl/250x190/') }}" alt="">
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
                        <input type="text" class="form-control" id="name" placeholder="Kategori ismi" value="{{ $category->name ?? '' }}" name="name">
                    </div>
                    <div class="form-grup">
                        <label for="name" >Baslık</label>
                        <select name="category_up" class="form-control">
                            <option value="" >Kategori Seç</option>
                            @if($categories)
                                @foreach($categories as $alt)
                                    <option value="{{ $alt->id }}" {{ isset($category) && $category->category_up == $alt->id ? 'selected' : '' }} >{{ $alt->name }}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="content1">Content </label>
                        <textarea   class="form-control" id="content1" name="content1" placeholder="Kategori Yazısı" rows="3">{{ $category->content ?? '' }}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="status">Durum</label>
                        @php
                            $status = $category->status ?? '1';
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
