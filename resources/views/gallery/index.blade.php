@extends('layouts.app')

@section('title', 'Gallery')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Artikel</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <x-card>
            <x-slot name="header">
                @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
                    <button onclick="addForm(`{{ route('gallery.store') }}`)" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                @else
                    <a href="{{ url('/gallery') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</a>
                @endif
            </x-slot>

            <x-table>
                <x-slot name="thead">
                    <th width="5%">No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>                    
                    <th width="15%"><i class="fas fa-cog"></i></th>
                </x-slot>
            </x-table>
        </x-card>
    </div>
</div>

@includeIf('gallery.form')
@endsection

<x-toast />
@includeIf('includes.datatable')

@push('scripts')
<script>
    let modal = '#modal-form';
    let table;

    table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('gallery.data') }}',
            data: function (d) {
                
            }
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'image', searchable: false, sortable: false},
            {data: 'judul'},
            {data: 'deskripsi', searchable: false, sortable: false},
            {data: 'action', searchable: false, sortable: false},
        ]
    });

    function addForm(url, title = 'Tambah') {
        $(modal).modal('show');
        $(`${modal} .modal-title`).text(title);
        $(`${modal} form`).attr('action', url);
        $(`${modal} [name=_method]`).val('post');

        resetForm(`${modal} form`);
    }

    function editForm(url, title = 'Edit') {
        $.get(url)
            .done(response => {
                $(modal).modal('show');
                $(`${modal} .modal-title`).text(title);
                $(`${modal} form`).attr('action', url);
                $(`${modal} [name=_method]`).val('put');

                resetForm(`${modal} form`);
                loopForm(response.data);

            })
            .fail(errors => {
                alert('Edit Tidak dapat menampilkan data');
                return;
            });
    }

    function submitForm(originalForm) {
        $.post({
                url: $(originalForm).attr('action'),
                data: new FormData(originalForm),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false
            })
            .done(response => {
                $(modal).modal('hide');
                showAlert(response.message, 'success');
                table.ajax.reload();
            })
            .fail(errors => {
                if (errors.status == 422) {
                    loopErrors(errors.responseJSON.errors);
                    return;
                }

                showAlert(errors.responseJSON.message, 'danger');
            });
    }

    function deleteData(url) {
        if (confirm('Yakin data akan dihapus?')) {
            $.post(url, {
                    '_method': 'delete'
                })
                .done(response => {
                    showAlert(response.message, 'success');
                    table.ajax.reload();
                })
                .fail(errors => {
                    showAlert('Tidak dapat menghapus data');
                    return;
                });
        }
    }
</script>
@endpush