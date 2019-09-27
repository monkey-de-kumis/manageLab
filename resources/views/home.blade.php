@extends('layouts.master')

@section('title')<title>Dashboard</title>@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content" id="dw">
          <div class="container-fluid">
            <div class="row">
              @foreach ($chemicals as $row)
                     <div class="col-lg-3 col-6">
                         <div class="small-box {{ $row['class'] }}">
                             <div class="inner">
                                 <h3>{{ $row['formula'] }}</h3>
                                 <p>{{ $row['name'] }} / {{ $row['tocsins'] }}</p>
                                 <p>{{ $row['sisa'] }} / {{ $row['stock_tot'] }}  {{$row['satuan']}}</p>

                             </div>
                             <div class="icon">
                                 <i class="ion {{ $row['icon'] }}"></i>
                             </div>

                         </div>
                     </div>
 ​             @endforeach
                     <div class="col-lg-3 col-6">
                         <div class="small-box bg-info">
                             <div class="inner">
                                 <h3>0</h3>
                                 <p>Pesanan</p>
                             </div>
                             <div class="icon">
                                 <i class="ion ion-stats-bars"></i>
                             </div>

                         </div>
                     </div>
                     <div class="col-lg-3 col-6">
                         <div class="small-box bg-warning">
                             <div class="inner">
                                 <h3>0</h3>
                                 <p>Pelanggan</p>
                             </div>
                             <div class="icon">
                                 <i class="ion ion-person-add"></i>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-3 col-6">
                         <div class="small-box bg-danger">
                             <div class="inner">
                                 <h3>0</h3>
                                 <p>Karyawan</p>
                             </div>
                             <div class="icon">
                                 <i class="ion ion-pie-graph"></i>
                             </div>
                         </div>
                     </div>
                 </div>
               </div>
      </section>
  </div>
@endsection
