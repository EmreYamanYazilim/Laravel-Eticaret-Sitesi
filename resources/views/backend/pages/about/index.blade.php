@extends('backend.layout.app')

@section('customcss')
    <style>
        .ck-content{
            height: 300px !important;
        }
    </style>

@endsection

@section('content')
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Hakkımızda</h4>

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


                <form action="{{ route('panel.about.update') }}" method="post"   enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <div class="input-group col-xs-12" >
                            <img width="150" height="155" src="{{ asset($about->image ?? 'https://fakeimg.pl/250x190/') }}" alt="">
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
                        <input type="text" class="form-control" id="name" placeholder="Hakkımızda Başlık" value="{{ $about->name ?? '' }}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="editor">Hakkımızda </label>
                        <textarea type="text" class="form-control" id="editor" placeholder="Hakkımızda" rows="3"  name="content1"> {!! $about->content ?? '' !!}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="text_1_icon">text 1 icon</label>
                        <input type="text" class="form-control" id="text_1_icon" placeholder="text 1 icon" value="{{ $about->text_1_icon ?? '' }}" name="text_1_icon">
                    </div>
                    <div class="form-group">
                        <label for="text_1_title">text 1 title</label>
                        <input type="text" class="form-control" id="text_1_title" placeholder="text 1 title" value="{{ $about->text_1_title ?? '' }}" name="text_1_title">
                    </div>
                    <div class="form-group">
                        <label for="text_1_content">text 1 content</label>
                        <textarea type="text" class="form-control" id="text_1_content" placeholder="text 1 content"  name="text_1_content">{!! $about->text_1_content ?? '' !!}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="text_1_icon">text 2 icon</label>
                        <input type="text" class="form-control" id="text_2_icon" placeholder="text 2 icon" value="{{ $about->text_2_icon ?? '' }}" name="text_2_icon">
                    </div>
                    <div class="form-group">
                        <label for="text_2_title">text 2 title</label>
                        <input type="text" class="form-control" id="text_2_title" placeholder="text 2 title" value="{{ $about->text_2_title ?? '' }}" name="text_2_title">
                    </div>
                    <div class="form-group">
                        <label for="text_2_content">text 2 content</label>
                        <textarea type="text" class="form-control" id="text_2_content" placeholder="text 2 content"  name="text_2_content">{!! $about->text_2_content ?? '' !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="text_3_icon">text 3 icon</label>
                        <input type="text" class="form-control" id="text_3_icon" placeholder="text 3 icon" value="{{ $about->text_3_icon ?? '' }}" name="text_3_icon">
                    </div>
                    <div class="form-group">
                        <label for="text_3_title">text 3 title</label>
                        <input type="text" class="form-control" id="text_3_title" placeholder="text 3 title" value="{{ $about->text_3_title ?? '' }}" name="text_3_title">
                    </div>
                    <div class="form-group">
                        <label for="text_3_content">text 3 content</label>
                        <textarea type="text" class="form-control" id="text_3_content" placeholder="text 3 content"  name="text_3_content">{!! $about->text_3_content ?? '' !!}</textarea>
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
