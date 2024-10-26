@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome {{ auth()->user()->nama }}</h3>

                    </div>
                    <div class="col-12 col-xl-4">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-">Pemasukan</p>

                                @php
                                    $id = auth()->user()->id;
                                    $currentDate = 10;
                                    $totalPemasukan = DB::select(
                                        "SELECT SUM(total) as total from transaksi where jenis = 'pemasukan' and user_id = $id and MONTH(tanggal) = $currentDate",
                                    );
                                    $totalPengeluaran = DB::select(
                                        "SELECT SUM(total) as total from transaksi where jenis = 'pengeluaran' and user_id = $id and MONTH(tanggal) = $currentDate",
                                    );

                                @endphp
                                <p class="fs-30 mb-2">{{ rupiah($totalPemasukan[0]->total) }}</p>
                                {{-- <p class="fs-30 mb-2">61344</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Pengeluaran</p>
                                <p class="fs-30 mb-2">{{ rupiah($totalPengeluaran[0]->total) }}</p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-">Budget</p>

                                @php
                                    $id = auth()->user()->id;
                                    $currentDate = 10;

                                    $totalPengeluaran = DB::select(
                                        "SELECT SUM(total) as total from transaksi where jenis = 'pengeluaran' and user_id = $id and MONTH(tanggal) = $currentDate",
                                    );
                                    $budget = DB::select(
                                        "SELECT * from bulanan where user_id = $id and bulan =  $currentDate",
                                    );

                                @endphp
                                <p class="fs-30 mb-2">{{ rupiah($totalPengeluaran[0]->total) }}/
                                    {{ rupiah($budget[0]->total) }}</p>
                                {{-- <p class="fs-30 mb-2">61344</p> --}}
                            </div>
                        </div>
                    </div>

                </div>




            </div>
        </div>
    @endsection
