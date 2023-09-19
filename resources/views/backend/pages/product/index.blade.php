@extends('backend.layout.app')



@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kategori</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.product.create' ) }}" class="btn btn-primary">Ekle</a>
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
                                <th>Resim</th>
                                <th>Başlık</th>
                                <th>Slogan</th>
                                <th>Link</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($products) && $products->count() > 0)
                                @foreach($products as $item)
                                    <tr class="item" item-id="{{ $item->id }}">
                                        <td class="py-1">
                                            <img src="{{ asset($item->image) }}" alt="image"/>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category->name ?? '' }}</td>

                                        <td>
                                            <div class="checkbox" >
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="dark" {{ $item->status == '1' ? 'checked' : '' }} data-toggle="toggle">
                                                </label>
                                            </div>

                                        </td>

                                        <td class="d-flex">
                                            <a href="{{ route('panel.product.edit', $item->id) }}" class="btn btn-primary mr-2">Düzenle</a>
                                            <form action="{{ route('panel.product.destroy',$item->id) }}" method="POST">
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

                    {{ $products->links('pagination::bootstrap-4') }}


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
                    if (response.status === "true") {
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
