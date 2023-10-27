@extends('layouts.app')

@section('title', 'Kategori')
    
 @section('content')
    <div>

        <x-Breadcrumb>
            <x-slot name="title">
                <h2>Data Kategori</h2>
            </x-slot>    
            <x-slot name="bread">
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Dashboard</a>
                    </li>                  
                    <li class="active">
                        <strong>Kategori</strong>
                    </li>
                </ol>
            </x-slot>    
        </x-Breadcrumb>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">

                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        
                        <x-cardIbox>
                            <x-slot name="title">
                                @if (auth()->user()->hasRole('admin'))
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal4">
                                        <i class="fa fa-plus"></i> Inspinia
                                    </button>
                                    {{-- <x-Modal>
                                        <x-slot name="header_body">
                                            @includeIf('category.form')
                                        </x-slot>
                                    </x-Modal> --}}

                                    <button type="button" class="btn btn-primary" onclick="submitForm()">Simpan</button>
                                    <button onclick="addForm(`{{ route('category.store') }}`)" class="btn btn-primary"><i class="fa fa-plus"></i> Modal</button>
                                @else
                                    <a href="{{ url('/category') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                                @endif                        
                            </x-slot>

                            <x-slot name="content">
                                <x-DataTable>
                                    <x-slot name="thead">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama</th>
                                            <th width="25%">Slug</th>
                                            <th width="15%"><i class="fa fa-wrench"></i></th>
                                        </tr>
                                    </x-slot>
            
                                    <x-slot name="tbody">
                                        @foreach ($category as $key => $item)
                                            <tr>
                                                <td><x-number-table :key="$key" :model="$category" /></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td>
                                                    <button class="btn btn-link text-primary" onclick="editForm(`{{ route('category.show', $item->id) }}`)"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-link text-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fa fa-trash"></i></button>                                                   
                                                    {{-- <form action="{{ route('category.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')      
                                                        <a href="{{ route('category.edit', $item->id) }}" class="btn btn-link text-primary"><i class="fa fa-pencil"></i></a>
                                                    </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                        
                                    </x-slot>
            
                                </x-DataTable>                        
                            </x-slot>
                        </x-cardIbox>
                    
                    </div>
                </div>
            </div>
        </div>           
    </div>
    @includeIf('category.form')
 @endsection

 @push('scripts')
    <script>   
        let modal = '#modal-form';

        function submitForm2(originalForm)
        {
            // showAlert('message', 'oke');
            console.log(originalForm);
            alert('test');
        }

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
                alert('Tidak dapat menampilkan data');
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
     </script>
 @endpush
