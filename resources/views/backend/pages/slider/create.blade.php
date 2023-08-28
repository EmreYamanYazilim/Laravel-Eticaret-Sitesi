@extends('backend.layout.app')

@section('content')
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Slider Ekle</h4>

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
                <form action="{{ route('panel.slider.store') }}" method="post"   enctype="multipart/form-data">
                    @csrf
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
                        <input type="text" class="form-control" id="name" placeholder="Slider Başlık" name="name">
                    </div>
                    <div class="form-group">
                        <label for="content">Slogan</label>
                        <input type="text" class="form-control" id="content" placeholder="Slider Slogan" name="content">
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" placeholder="Slider link" name="link">
                    </div>
                    <div class="form-group">
                        <label for="status">Durum</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0">Pasif</option>
                            <option value="1">Aktif</option>
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
