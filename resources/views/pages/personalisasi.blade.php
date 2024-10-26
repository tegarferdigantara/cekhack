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
                        <h4 class="card-title">Personalisasi</h4>
                        <p class="card-description"> Basic form layout </p>
                        <form class="forms-sample" method="POST" action="{{ route('personalisasi.action') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Gaji</label>
                                <input type="number" name="gaji" class="form-control" id="nama"
                                    placeholder="100000">
                            </div>
                            <div class="form-group">
                                <label for="nominal">Pengeluaran</label>
                                <input type="number" name="pengeluaran" class="form-control" id="nominal"
                                    placeholder="100000">
                            </div>
                            <div class="form-group">
                                <label for="nominal">Tabungan</label>
                                <input type="number" name="tabungan" class="form-control" id="nominal"
                                    placeholder="100000">
                            </div>
                            <div class="form-group">
                                <label for="nominal">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control" id="nominal"
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
