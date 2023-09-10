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
                    <form action="{{ $routeLink }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($setting->id))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label>Tip</label>
                            <select name="set_type" id="" class="form-control">
                                <option value="">Tür Seçin</option>
                                <option
                                    value="ckeditor" {{ isset($setting->set_type) && $setting->set_type == 'ckeditor' ? 'selected' : '' }}>
                                    Ck Editör
                                </option>                                <option
                                    value="textarea" {{ isset($setting->set_type) && $setting->set_type == 'textarea' ? 'selected' : '' }}>
                                    textarea
                                </option>
                                <option
                                    value="file"{{ isset($setting->set_type) && $setting->set_type == 'file' ? 'selected' : ''  }}>
                                    File
                                </option>
                                <option
                                    value="image" {{ isset($setting->set_type) && $setting->set_type == 'image' ? 'selected' : '' }}>
                                    Resim
                                </option>
                                <option
                                    value="text" {{ isset($setting->set_type) && $setting->set_type == 'text' ? 'selected' : '' }}>
                                    Text
                                </option>
                                <option
                                    value="email" {{ isset($setting->set_type) && $setting->set_type == 'email' ? 'selected' : '' }}>
                                    E mail
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="input-group col-xs-12">


                                @if(isset($setting->set_type) && $setting->set_type == 'image')
                                    <img width="150" height="155" src="{{ asset($setting->data ?? 'https://fakeimg.pl/250x190/') }}" alt="">
                                @endif
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
                            <input type="text" class="form-control" id="name" placeholder="Başlık"
                                   value="{{ $setting->name ?? '' }}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="data">value</label>

                            <div class="inputContent">
                                @if(isset($setting->set_type) && $setting->set_type == 'ckeditor')
                                    <textarea class="form-control" id="ckeditor" placeholder="Data" rows="5" value="{{ $setting->data ?? '' }}" name="data"></textarea>
                                @elseif(isset($setting->set_type) && $setting->set_type == 'image' || isset($setting->set_type) && $setting->set_type == 'file')
                                    <input type="file" name="data" placeholder="yazınız">
                                @elseif(isset($setting->set_type) && $setting->set_type == 'text')
                                    <input type="text" name="data" placeholder="Yazınız " value="{{ $setting->data ?? '' }}">
                                @elseif(isset($setting->set_type) && $setting->set_type == 'email')
                                    <input type="email"  value="{{ $setting->data ?? '' }}">
                                @else

                                @endif
                            </div>

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

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/translations/tr.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                language:'tr',
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
