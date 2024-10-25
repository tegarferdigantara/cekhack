<?php

namespace App\Http\Controllers\api;

use Gemini\Data\Blob;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserController extends BaseController
{

    public function store(Request $request)
    {



        $id = DB::select("SELECT Max(id) as id from users");

        $id_user = $id[0]->id + 1;

        try {
            $user =  DB::table('users')->insert([
                'id' => $id_user,
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => "Gagal menambahkan",
                'error' => $th
            ]);
        }
    }



    public function login(Request $request)
    {
        // $username = $request->username;
        // $password = $request->password;

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {


            $user = DB::table('users')->where(['username' => $request->username])->first();
        }
        if ($user != null) {
            // Auth::logoutOtherDevices($request->password);


            DB::commit();
            $currentDate = Carbon::now();
            $bulan = $currentDate->month;
            $bulanNama = bulanNama($bulan);
            $data = [
                'bulan' => $bulanNama,
                'succes' => true,
                'id' => $user->id
            ];

            return response()->json($data);
        } else {
            return response()->json(
                ['message' => 'Username atau password anda salah']
            );
        }
    }

    public function userdetail(Request $request)
    {

        try {
            $user =  DB::table('users')->where('id', $request->id)->update([
                'no_hp' => $request->no_hp,
                'gaji' => $request->gaji,
                'pengeluaran' => $request->pengeluaran,
                'tabungan' => $request->tabungan,
                'pekerjaan' => $request->pekerjaan,

            ]);
            DB::commit();



            return response()->json([
                'message' => "Data Berhasil Disimpan"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => "Gagal menambahkan",
                'error' => $th
            ]);
        }
    }

    public function budgetStore(Request $request)
    {

        $id2 = DB::select("SELECT MAX(id) as id from bulanan");

        if ($id2[0]->id == null) {
            $id = 1;
        } else {
            $id = $id2[0]->id + 1;
        }
        
        $total = $request->total;
        $belanja = $request->belanja;
        $tagihan = $request->tagihan;
        $transportasi = $request->transportasi;
        $hiburan = $request->hiburan;
        $makanan = $request->makanan;
        $tabungan = $request->tabungan;
        $darurat = $request->darurat;

        if ($belanja + $tagihan + $transportasi + $hiburan + $makanan + $tabungan + $darurat > $total) {
            return response()->json([
                'message' => "Total lebih kecil di banding pengeluaran"
            ]);
        }

        try {
            $user =  DB::table('bulanan')->insert([
                'id' => $id,
                'total' => $request->total,
                'belanja' => $request->belanja,
                'tagihan' => $request->tagihan,
                'transportasi' => $request->transportasi,
                'hiburan' => $request->hiburan,
                'makanan' => $request->makanan,
                'tabungan' => $request->tabungan,
                'darurat' => $request->darurat,
                'bulan' => $request->bulan,
                'user_id' => $request->user_id,

            ]);
            DB::commit();



            return response()->json([
                'message' => "Data Berhasil Disimpan"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => "Gagal menambahkan",
                'error' => $th
            ]);
        }
    }



}
