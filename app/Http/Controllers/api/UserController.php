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
        $name = $request->name;
        $password = $request->password;
        $username = $request->username;


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
}
