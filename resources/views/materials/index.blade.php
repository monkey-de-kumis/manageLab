@extends('layouts.master')
​
@section('title')
    <title>Manajemen Bentuk Bahan</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Bentuk Bahan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Bentuk Bahan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        @component('components.card')
                            @slot('title')
                            Tambah
                            @endslot

                            @if (session('error'))
                                @component('components.alert',['type' => 'danger'])
                                    {!! session('error') !!}
                                @endcomponent
                            @endif
​
                            <form role="form" action="{{ route('bahan.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Bentuk Bahan</label>
                                    <input type="text"
                                    name="name"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" id="name" required>
                                </div>

                            @slot('footer')
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            @endslot
                        @endcomponent
                    </div>
                    <div class="col-md-8">
                        @component('components.card')
                            @slot('title')
                            List Bentuk Bahan
                            @endslot

                            @if (session('success'))
                                @component('components.alert',['type' => 'success'])
                                    {!! session('success') !!}
                                @endcomponent
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Bahan</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($materials as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>
                                                <form action="{{ route('bahan.destroy', $row->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('bahan.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @slot('footer')
​
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
