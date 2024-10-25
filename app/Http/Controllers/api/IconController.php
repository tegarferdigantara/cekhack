<?php

namespace App\Http\Controllers\api;

use Gemini\Data\Blob;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Validator;


class IconController extends BaseController
{

    public function store(Request $request)
    {
     
        // Validasi input
        $validator = Validator::make($request->all(), [
            'icon' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $id2 = DB::select("SELECT MAX(id) as id from goal");
        if ($id2[0]->id == null) {
            $id = 1;
        } else {
            $id = $id2[0]->id + 1;
        }

        try {
            DB::beginTransaction(); // Memulai transaksi

            // Menyimpan file gambar
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $path = $file->store('icons', 'public'); // Menyimpan file ke direktori 'icons' di storage/app/public

                // Menyimpan path file ke dalam basis data
                $iconId = DB::table('icon')->insert([
                    'id' => $id,
                    'nama' => $path,


                ]);

                DB::commit(); // Menyimpan transaksi
                return response()->json([
                    'message' => 'Data berhasil disimpan',
                    'icon_id' => $iconId,
                    'icon_path' => $path,
                ]);
            }

            return response()->json([
                'message' => 'File gambar tidak ditemukan'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack(); // Membatalkan transaksi jika terjadi kesalahan
            return response()->json([
                'message' => 'Data gagal disimpan',
                'error' => $th->getMessage()
            ]);
        }
    }



    public function showList($id)
    {
        $list = DB::select("SELECT a.*, COALESCE((SELECT SUM(b.total) FROM transaksi AS b 
        WHERE a.id = b.goal_id), 0) AS total  
        FROM goal AS a 
        WHERE a.user_id = $id;
        ");

        return response()->json($list);
    }
}
