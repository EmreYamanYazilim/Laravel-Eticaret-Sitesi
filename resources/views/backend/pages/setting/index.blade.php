@extends('backend.layout.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Site Ayarları</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.setting.create') }}" class="btn btn-primary">Yeni</a>
                    </p>
                    <div>
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Resim </th>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($settings) && $settings->count() > 0)
                                @foreach($settings as $setting)
                                    <tr>
                                        <td class="py-1">
                                            @if($setting->set_type == 'image')
                                                <img src="{{ asset($setting->data) }}" alt="image"/>
                                            @endif
                                        </td>
                                        <td>{{ $setting->name }}</td>
                                        <td>{{ $setting->data ?? ''}}</td>
                                        <td>{{ $setting->set_type }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('panel.setting.edit', $setting->id) }}" class="btn btn-primary mr-2">Düzenle</a>
                                            <form action="{{ route('panel.setting.destroy', $setting->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Sil</button>
                                            </form>

                                        </td>
                                    </tr>

                                @endforeach
                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

