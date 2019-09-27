@extends('layouts.master')

@section('title')
  <title>Checkout</title>
@endsection

@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="content-wrapper">
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Checkout</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('analisa.kegiatan') }}">Kegiatan</a></li>
                            <li class="breadcrumb-item active">Analisa</li>
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
                              <h4 class="card-title">Penetapan Kegiatan</h4>
                            @endslot
                            <!-- JIKA VALUE DARI message ada, maka alert success akan ditampilkan -->
                                <div v-if="message" class="alert alert-success">
                                  Transaksi telah disimpan, Kegiatan: <strong>#@{{ message }}</strong>
                                </div>
                                <div class="form-group">
                                  <label for="">Penetapan</label>
                                    <input type="text" name="name"
                                    v-model="activity.name"
                                        class="form-control"
                                        @keyup.enter.prevent="searchActivity"
                                        required
                                        >
                                        <p>Tekan enter untuk mengecek Penetapan.</p>
                                    <!-- EVENT KETIKA TOMBOL ENTER DITEKAN, MAKA AKAN MEMANGGIL METHOD searchCustomer dari Vuejs -->
                                  </div>

                                <!-- JIKA formCustomer BERNILAI TRUE, MAKA FORM AKAN DITAMPILKAN -->
                                <div v-if="formCustomer">
                                  <div class="form-group">
                                      <label for="">Nama Penetapan</label>
                                        <input type="text" name="name"
                                            v-model="customer.name"
                                            :disabled="resultStatus"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="">Deskripsi</label>
                                        <textarea name="address"
                                          class="form-control"
                                            :disabled="resultStatus"
                                            v-model="customer.address"
                                            cols="5" rows="5" required></textarea>
                                    </div>

                                @slot('footer')
                            <div class="card-footer text-muted">
                                  <!-- JIKA VALUE DARI errorMessage ada, maka alert danger akan ditampilkan -->
                                    <div v-if="errorMessage" class="alert alert-danger">
                                      @{{ errorMessage }}
                                      </div>
                                    <!-- JIKA TOMBOL DITEKAN MAKA AKAN MEMANGGIL METHOD sendOrder -->
                                    <button class="btn btn-primary btn-sm float-right"
                                    :disabled="submitForm"
                                        @click.prevent="sendAnalysis">
                                        @{{ submitForm ? 'Loading...':'Analysis Now' }}
                                      </button>
                                  </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="{{ asset('js/transaksi.js') }}"></script>
    @endsection
