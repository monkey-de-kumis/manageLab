@extends('layouts.master')

  @section('title')
    <title>Manajemen Unit</title>
  @endsection
@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Stock</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Stock</li>
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
                            <form role="form" action="{{ route('stocks.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                  <label for="">Bahan Kimia</label>
                                    <select name="chemicals_id" id="chemicals_id"
                                    class="form-control" required width="100%">
                                        <option value="">Pilih</option>
                                      @foreach($chemicals as $alchemy)
                                        <option value="{{ $alchemy->id}}">{{ $alchemy->name }}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Jumlah</label>
                                    <input type="text"
                                    name="qty"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Tanggal Masuk</label>
                                    <input type="text"
                                    name="tgl_masuk"
                                    class="form-control {{ $errors->has('tgl_masuk') ? 'is-invalid':'' }}"
                                    id="tgl_masuk" required>
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
                            List Satuan
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
                                            <td>Jumlah</td>
                                            <td>Tanggal</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($stocks as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->chemicals->name }}</td>
                                            <td>{{ $row->qty }}</td>
                                            <td>{{ $row->tgl_masuk }}</td>
                                            <td>
                                                <form action="{{ route('stocks.destroy', $row->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('stocks.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
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

@section('js')
  <script>
    $( document ).ready(function() {
        $('#tgl_masuk').datepicker();
    });
    </script>
@endsection
