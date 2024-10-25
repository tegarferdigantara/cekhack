<?php

namespace App\Http\Controllers\api;

use Gemini\Data\Blob;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class GoalController extends BaseController
{

    public function store(Request $request)
    {




        $id2 = DB::select("SELECT MAX(id) as id from goal");
        if ($id2[0]->id == null) {
            $id = 1;
        } else {
            $id = $id2[0]->id + 1;
        }


        try {
            $goal =  DB::table('goal')->insert([
                'id' => $id,
                'user_id' => $request->user_id,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'status' => 0,
                'target' => $request->target,

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
