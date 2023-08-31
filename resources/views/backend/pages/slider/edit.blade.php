@extends('backend.layout.app')

@section('content')
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Slider</h4>

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

                @if(!empty($slider->id))
                    @php
                        $routeLink = route('panel.slider.update',$slider->id);
                     @endphp
                @else
                    @php
                        $routeLink =  route('panel.slider.store');
                    @endphp
                @endif
                <form action="{{ $routeLink }}" method="post"   enctype="multipart/form-data">
                    @csrf
                    @if(!empty($slider->id))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <div class="input-group col-xs-12" >
                            <img width="150" height="155" src="{{ asset($slider->image ?? 'image/resimyok.webp') }}" alt="">
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
                        <input type="text" class="form-control" id="name" placeholder="Slider Başlık" value="{{ $slider->name ?? '' }}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="content1">Slogan</label>
                        <input type="text" class="form-control" id="content1" placeholder="Slider Slogan" rows="3" value="{{ $slider->content ?? '' }}" name="content1">
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" placeholder="Slider link" value="{{ $slider->link ?? '' }}" name="link">
                    </div>
                    <div class="form-group">
                        <label for="status">Durum</label>
                        @php
                            $status = $slider->status ?? '1';
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
