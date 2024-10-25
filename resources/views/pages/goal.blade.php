@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tujuan</h4>
                        <p class="card-description">
                            Dibawah ini merupakan tujuan anda
                        </p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Keinginan</th>
                                        <th>Status</th>
                                        <th>Target</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>{{ rupiah($data->target) }}</td>
                                            <td>{{ $data->deskripsi }}</td>
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
