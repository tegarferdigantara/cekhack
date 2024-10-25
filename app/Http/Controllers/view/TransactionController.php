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
}
