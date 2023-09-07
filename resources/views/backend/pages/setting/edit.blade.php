@extends('backend.layout.app')

@section('content')
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Site Ayarları </h4>

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

                @if(!empty($setting->id))
                    @php
                    $routeLink = route('panel.setting.update', $setting->id)
                    @endphp
                @else
                    @php
                    $routeLink = route('panel.setting.store')
                    @endphp
                @endif
                <form action="{{ $routeLink }}" method="post"   enctype="multipart/form-data">
                    @csrf
                    @if(!empty($setting->id))
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label>Tip</label>
                        <select name="set_type" id="" class="form-control" >
                            <option value="">Tür Seçin</option>
                            <option value="ckeditor" {{ isset($setting->set_type) && $setting->set_type == 'ckeditor' ? 'selected' : '' }}>Ck Editör</option>
                            <option value="file"{{ isset($setting->set_type) && $setting->set_type == 'file' ? 'selected' : ''  }}>File</option>
                            <option value="image" {{ isset($setting->set_type) && $setting->set_type == 'image' ? 'selected' : '' }}>Resim</option>
                            <option value="text" {{ isset($setting->set_type) && $setting->set_type == 'text' ? 'selected' : '' }}>Text</option>
                            <option value="email" {{ isset($setting->set_type) && $setting->set_type == 'email' ? 'selected' : '' }}>E mail</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="input-group col-xs-12" >
                            <img width="150" height="155" src="{{ asset($setting->data ?? 'https://fakeimg.pl/250x190/') }}" alt="">
                        </span>
                        </div>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label>Resim</label>--}}
{{--                        <input type="file" name="image" class="file-upload-default">--}}
{{--                        <div class="input-group col-xs-12">--}}
{{--                            <input type="text" class="form-control file-upload-info"  placeholder="Resim Yükleyin">--}}
{{--                            <span class="input-group-append">--}}
{{--                          <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="name">key</label>
                        <input type="text" class="form-control" id="name" placeholder="Başlık" value="{{ $setting->name ?? '' }}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="data">value</label>
                        <textarea type="text" class="form-control" id="data" placeholder="Data" rows="5" value="{{ $setting->data ?? '' }}" name="data"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Onayla</button>
                    <button class="btn btn-light">İptal Et</button>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection
