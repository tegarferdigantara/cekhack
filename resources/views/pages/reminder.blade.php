@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pengingat</h4>
                        <p class="card-description">
                            Dibawah ini merupakan transaksi yang belum selesai
                        </p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>{{ $data->nominal }}</td>
                                            <td>{{ $data->detail }}</td>
                                        </tr>
                                        {{-- @else
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr> --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
