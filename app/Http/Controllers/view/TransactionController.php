<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function showList($id)
    {
        $bulan = Carbon::now()->month;
        $list = DB::select("SELECT * from transaksi where user_id = $id  and month(tanggal) =$bulan order by tanggal");

        return view('pages.transaction', compact('list'));
    }

    public function incomeView()
    {
        return view('pages.income');
    }

    public function income(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'nominal' => 'required|integer',
            'id' => 'required|integer',
            'tipe' => 'required'
        ]);

        $maxId = DB::table('transaksi')->max('id');
        $exec = DB::table('transaksi')->insert([
            'id' => $maxId + 1,
            'user_id' => $data['id'],
            'nama' => $data['nama'],
            'total' => $data['nominal'],
            'jenis' => $data['tipe'],
            'tanggal' => Carbon::now()
        ]);

        if ($exec) {
            return redirect()->back()->with('success', 'Pemasukan berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Pemasukan gagal ditambahkan');
        }
    }
}
