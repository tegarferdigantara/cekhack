<?php

namespace App\Http\Controllers\api;

use Gemini\Data\Blob;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class ReminderController extends BaseController
{

    public function store(Request $request)
    {



        $user_id = $request->user_id;
        $id2 = DB::select("SELECT MAX(id) as id from pengingat");
        if ($id2[0]->id == null){
            $id = 1;
        } else{
            $id = $id2[0]->id+1;
        }
    

        try {
            $pengingat =  DB::table('pengingat')->insert([
                'id' => $id,
                'nama' => $request->nama,
                'user_id' => $request->user_id,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'detail' => $request->detail,
                
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

    public function showList($id) {


        $list = DB::select("SELECT * from pengingat where user_id = $id order by tanggal");

        return response()->json($list);
    }


    


}
