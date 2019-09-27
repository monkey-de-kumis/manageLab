@extends('layouts.master')

@section('title')
  <title>Kegiatan Analisa</title>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Kegiatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a> >> </li>
                            <li class="breadcrumb-item active">Kegiatan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content" id="dw">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        @component('components.card')
                            @slot('title')
                              <i class="fa fa-flask"></i>Pilih Bahan
                            @endslot

                            <div class="row">
                              <div class="col-md-4">

                                <!--submit run when click button-->
                                <form action="#" @submit.prevent="addToElenmeyer"
                                method="post">
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
                                <label for="">Jumlah</label>
                                <input type="number" name="qty"
                                v-model="chemicals.qty"
                                id="qty" class="form-control">
                                </div>
                                <div class="form-group">
                                <button class="btn btn-primary btn-sm"
                                :disabled="submitChart">
                                <i class="fa fa-flask"></i>
                                @{{ submitChart ? 'Loading...':'Ke Erlenmeyer' }}
                                </button>
                                </div>
                                </form>
                              </div>

                              <!--display detail chemicals-->
                              <div class="col-md-5">
                                <h4>Detail Bahan Kimia</h4>
                                <div c-if="chemicals.name">
                                  <table class="table table-striped">
                                    <tr>
                                      <th width="3%">Nama</th>
                                      <td width="2%">:</td>
                                      <td>@{{ chemicals.name }}</td>
                                    </tr>
                                    <tr>
                                      <th>Rumus</th>
                                      <td width="2%">:</td>
                                      <td>@{{ chemicals.formula }}</td>
                                    </tr>
                                  </table>
                                </div>
                              </div>

                            </div>
                            @slot('footer')

                            @endslot
                          @endcomponent
                        </div>
                        @include('analyses.elenmeyer')
                </div>
            </div>
        </section>
      </div>
@endsection

@section('js')
  <script src="{{ asset('js/select2.min.js')}}"></script>
  <script src="{{ asset('js/accounting.min.js')}}"></script>
  <script src="{{ asset('js/transaksi.js')}}"></script>
@endsection
