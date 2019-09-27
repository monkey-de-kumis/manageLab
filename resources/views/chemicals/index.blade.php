@extends('layouts.master')

@section('title')
    <title>Manajemen Bahan Kimia</title>
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @component('components.card')
                @slot('title')
                  <a href="{{ route('kimia.create')}}"
                      class="btn btn-primary btn-sm">
                  <i class="fa fa-edit"></i>Tambah</a>
                @endslot

                @if (session('success'))
                    @component('components.alert',['type'=>'success'])
                              {!! session('success') !!}
                    @endcomponent
                @endif

                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Kimia</th>
                        <th>Rumus</th>
                        <th>Katalog No</th>
                        <th>Tanda Bahaya</th>
                        <th>Bentuk</th>
                        <th>Kemasan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Last Update</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($chemicals as $row)
                      <tr>
                        <td>@if (isset($row->photo))
                            <img src="{{ asset('upload/chemicals' .
                              $row->photo)}}" alt="{{ $row->name }}"
                              width="50px" height="50px">
                            @else
                            <img src="http://via.placeholder.com/50x50"
                            alt="{{ $row->name }}">
                            @endif
                        </td>
                        <td><strong>{{ $row->name }}</strong></td>
                        <td>{{ $row->formula }}</td>
                        <td>{{ $row->catalog }}</td>
                        <td>{{ $row->tocsin->name }}</td>
                        <td>{{ $row->material->name }}</td>
                        <td>{{ $row->package->name }}</td>
                        <td>{{ $row->volume }}</td>
                        <td>{{ $row->unit->name }}</td>
                        <td>{{ $row->updated_at }}</td>
                        <td>
                          <form action="{{ route('kimia.destroy', $row->id)}}"
                            method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method"
                            value="DELETE">
                            <a href="{{ route('kimia.edit',$row->id)}}"
                              class="btn btn-warning btn-sm">
                              <i class="fa fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm">
                              <i class="fa fa-edit"></i>
                            </button>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="11" class="text-center">
                          Tidak ada data
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                  <div class="float-right">
                      {!! $chemicals->links() !!}
                  </div>
                </div>
                @slot('footer')

                @endslot
              @endcomponent
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection
