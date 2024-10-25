<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    public function showList($id)
    {
        $list = DB::select("SELECT a.*, COALESCE((SELECT SUM(b.total) FROM transaksi AS b
        WHERE a.id = b.goal_id), 0) AS total
        FROM goal AS a
        WHERE a.user_id = $id;
        ");

        return view('pages.goal', compact('list'));
    }
}
