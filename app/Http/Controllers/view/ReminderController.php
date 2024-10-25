<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReminderController extends Controller
{
    public function showList($id)
    {


        $list = DB::select("SELECT * from pengingat where user_id = $id order by tanggal");

        return view('pages.reminder', compact('list'));
    }
}
