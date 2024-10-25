<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporan($id)
    {
        $user = DB::select("SELECT * from users where id = $id");
        $currentMonth = Carbon::now()->month;

        $totalPengeluaran = DB::select("SELECT SUM(total) as total from transaksi where jenis = 'pengeluaran' and user_id = $id and MONTH(tanggal) = $currentMonth");        
        $totalPemasukan = DB::select("SELECT SUM(total) as total from transaksi where jenis = 'pemasukan' and user_id = $id and MONTH(tanggal) = $currentMonth");        
    
        
        $transaksi = DB::select("SELECT * from transaksi where user_id = $id and MONTH(tanggal) = $currentMonth order by tanggal");




        $data = [
            'user'=> $user,
            'totalPengeluaran' => $totalPengeluaran,
            'totalPemasukan' => $totalPemasukan,
            'transaksi' => $transaksi,
        ];
        // dd($data);
        return view('pages.laporan')->with($data);
    }

   
}
