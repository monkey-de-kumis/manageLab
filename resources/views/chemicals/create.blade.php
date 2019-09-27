@extends('layouts.master')

@section('title')
  <title>Tambah Bahan Kimia</title>
@endsection

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Tambah Bahan Kimia</h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrum-item"><a href="#">Home</a> >> </li>
              <li class="breadcrum-item"><a
                href="{{ route('kimia.index')}}">Bahan kimia</a>>></li>
              <li class="breadcrum-item active">Tambah</li>
            </ol>
          </div>
        </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @component('components.card')
                @slot('title')

                @endslot

                @if (session('success'))
                  @component('components.alert',['type'=>'success'])
                    {{!! session('success') !!}}
                  @endcomponent
                @endif
    <form action="{{ route('kimia.store') }}" method="post"
    enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
          <label for=" ">Nama Bahan</label>
          <input type="text" name="name" required
          class="form-control {{ $errors->has('name') ? 'is-invalid':''}}">
          <p class=="text-danger">{{ $errors->first('name') }}</p>
      </div>
      <div class="form-group">
          <label for=" ">Deskripsi</label>
          <textarea name="description" id="description"
            cols="5" rows="5"
            class="form-control
            {{ $errors->has('description') ? 'is-invalid':''}}"></textarea>
          <p class=="text-danger">{{ $errors->first('description') }}</p>
      </div>
      <div class="form-group">
          <label for=" ">Rumus Kimia</label>
          <input type="text" name="formula" required
          class="form-control {{ $errors->has('formula') ? 'is-invalid':''}}">
          <p class=="text-danger">{{ $errors->first('formula') }}</p>
      </div>
      <div class="form-group">
          <label for=" ">Catalog No</label>
          <input type="text" name="catalog" required
          class="form-control {{ $errors->has('catalog') ? 'is-invalid':''}}">
          <p class=="text-danger">{{ $errors->first('catalog') }}</p>
      </div>
      <div class="form-group">
           <label for=" ">Tanda Bahaya</label>
           <select name="tocsin_id" id="tocsin_id" required
           class="form-control {{ $errors->has('tocsin_id') ? 'is-invalid':''}}">
               <option value="">Pilih</option>
               @foreach ($tocsins as $tocsin)
                 <option value="{{ $tocsin->id }}">{{ ucfirst($tocsin->name) }}</option>
              @endforeach
           </select>
           <p class=="text-danger">{{ $errors->first('tocsin_id') }}</p>
      </div>
      <div class="form-group">
          <label for=" ">Kemasan</label>
          <select name="package_id" id="package_id" required
          class="form-control {{ $errors->has('package_id') ? 'is-invalid':''}}">
              <option value="">Pilih</option>
              @foreach ($packages as $package)
                <option value="{{ $package->id }}">{{ ucfirst($package->name) }}</option>
              @endforeach
          </select>
          <p class=="text-danger">{{ $errors->first('package_id') }}</p>
      </div>
      <div class="form-group">
          <label for=" ">Bentuk Bahan</label>
          <select name="material_id" id="material_id" required
          class="form-control {{ $errors->has('material_id') ? 'is-invalid':''}}">
              <option value="">Pilih</option>
              @foreach ($materials as $material)
                <option value="{{ $material->id }}">{{ ucfirst($material->name) }}</option>
              @endforeach
          </select>
          <p class=="text-danger">{{ $errors->first('material_id') }}</p>
      </div>

      <div class="form-group">
          <label for=" ">Volume</label>
          <input type="text" name="volume" required
          class="form-control {{ $errors->has('volume') ? 'is-invalid':''}}">
          <p class=="text-danger">{{ $errors->first('volume') }}</p>
      </div>
      <div class="form-group">
          <label for=" ">Satuan</label>
          <select name="unit_id" id="unit_id" required
          class="form-control {{ $errors->has('unit_id') ? 'is-invalid':''}}">
              <option value="">Pilih</option>
              @foreach ($units as $unit)
                <option value="{{ $unit->id }}">{{ ucfirst($unit->name) }}</option>
              @endforeach
          </select>
          <p class=="text-danger">{{ $errors->first('unit_id') }}</p>
      </div>
      <div class="form-group">
        <button class="btn btn-primary btn-sm">
          <i class="fa fa-send"></i> Simpan
        </button>
      </div>
    </form>
              @slot('footer')

              @endslot
            @endcomponent
          </div>
        </div>
      </div>
    </section>
      </div>
    </div>
  </div>
@endsection
