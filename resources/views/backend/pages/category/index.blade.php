@extends('backend.layout.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kategori</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.category.create' ) }}" class="btn btn-primary">Ekle</a>
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
                                <th>Başlık</th>
                                <th>Slogan</th>
                                <th>Link</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($categories) && $categories->count() > 0)
                                @foreach($categories as $category)
                                    <tr class="item" item-id="{{ $category->id }}">
                                        <td class="py-1">
                                            <img src="{{ asset($category->image) }}" alt="image"/>
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->category->name ?? '' }}</td>

                                        <td>
                                            <div class="checkbox" >
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="dark" {{ $category->status == '1' ? 'checked' : '' }} data-toggle="toggle">
                                                </label>
                                            </div>

                                        </td>

                                        <td class="d-flex">
                                            <a href="{{ route('panel.category.edit', $category->id) }}" class="btn btn-primary mr-2">Düzenle</a>
                                            <form action="{{ route('panel.category.destroy',$category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Sil</button>
                                            </form>

{{--                                            Ajax ile silme bölümü  --}}

{{--                                            <button type="button" class="silBtn btn btn-danger">Sil</button>---}}
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

@section('customjs')

    <script >
        $(document).on('change', '.durum', function (e) {
            id      = $(this).closest('.item').attr('item-id');
            statu   = $(this).prop('checked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{route('panel.category.status')}}",
                data:{
                    id:id,
                    statu:statu
                },
                success:function (response) {
                    if (response.status == "true") {
                        alertify.success("Durum Aktif Edildi");
                    } else {
                        alertify.error("Durum Pasif Edildi");
                    }
                }
            });
        });


        {{--$(document).on('click', '.silBtn', function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    id      = $(this).closest('.item').attr('item-id');--}}

        {{--    $.ajax({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        },--}}
        {{--        type:"DELETE",--}}
        {{--        url:"{{route('panel.category.destroy')}}",--}}
        {{--        data:{--}}
        {{--            id:id,--}}
        {{--        },--}}
        {{--        success:function (response) {--}}
        {{--            if (response.error == "false") {--}}
        {{--                alertify.success("Başarı ile silindi");--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}

        {{--});--}}
    </script>
@endsection
