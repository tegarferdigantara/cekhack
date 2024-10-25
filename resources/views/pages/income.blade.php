@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Transaksi</h4>
                        <p class="card-description"> Basic form layout </p>
                        <form class="forms-sample" method="POST" action="{{ route('pemasukan') }}">
                            @csrf
                            <div class="form-group">
                                <label for="jenis">Pilih jenis transaksi</label>
                                <select class="form-select" id="jenis" name="tipe">
                                    <option value="pemasukan">Pemasukan</option>
                                    <option value="pengeluaran">Pengeluaran</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama"
                                    placeholder="contoh: Gaji, Upah">
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="number" name="nominal" class="form-control" id="nominal"
                                    placeholder="100000">
                            </div>
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
