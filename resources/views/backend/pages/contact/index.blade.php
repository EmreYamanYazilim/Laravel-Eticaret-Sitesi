@extends('backend.layout.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">İletişim</h4>
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
                                <th>Ad Soyad </th>
                                <th>Email</th>
                                <th>Konu</th>
                                <th>Mesaj</th>
                                <th>Durum</th>
                                <th>ip</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($contacts) && $contacts->count() > 0)
                                @foreach($contacts as $contact)
                                    <tr>

                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ strLimit($contact->message,50) }}</td>
                                        <td>
                                            <div class="checkbox" item-id="{{ $contact->id }}">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="dark" {{ $contact->status == '1' ? 'checked' : '' }} data-toggle="toggle">
                                                </label>
                                            </div>

                                        </td>
                                        <td>{{ $contact->ip }}</td>


                                        <td class="d-flex">
                                            <a href="{{ route('panel.contact.edit', $contact->id) }}" class="btn btn-primary mr-2">Düzenle</a>
                                            <form action="{{ route('panel.contact.destroy',$contact->id) }}" method="POST">
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

@section('customjs')

    <script >
        $(document).on('change', '.durum', function (e) {
            id      = $(this).closest('.checkbox').attr('item-id');
            statu   = $(this).prop('checked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{route('panel.contact.status')}}",
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
    </script>
@endsection
