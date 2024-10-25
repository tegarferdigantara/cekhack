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

class KategoriController extends BaseController
{

    public function store(Request $request)
    {




        $id2 = DB::select("SELECT MAX(id) as id from kategori");
        if ($id2[0]->id == null) {
            $id = 1;
        } else {
            $id = $id2[0]->id + 1;
        }


        try {
            $pengingat =  DB::table('kategori')->insert([
                'id' => $id,
                'nama' => $request->nama,
                'tipe' => $request->tipe,
                'icon' => $request->icon,

            ]);
            DB::commit();
            return response()->json([
                'message' => "Data Dapat disimpan",
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => "Gagal menambahkan",
                'error' => $id
            ]);
        }
    }

    public function showList()
    {
        $list = DB::select("SELECT a.*, b.nama AS namaicon 
                FROM kategori AS a
                INNER JOIN icon AS b ON a.icon = b.id;");
        

        return response()->json($list);
    }
}
