@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Transaksi</h4>
                        </table>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>jenis</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach ($transaksi as $data)
                                        @php
                                            $no++;
                                        @endphp
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->jenis }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>{{ rupiah($data->total) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="fw-bold fs-2">
                                        <td class="text-center">Nama : {{ $user[0]->nama }}</td>
                                        <td colspan="2" class="text-center">Total Pengeluaran :
                                            {{ rupiah($totalPengeluaran[0]->total) }}</td>
                                        <td colspan="2" class="text-center">Total Pemasukan :
                                            {{ rupiah($totalPemasukan[0]->total) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
