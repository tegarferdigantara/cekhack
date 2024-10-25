<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function loginView()
    {
        return view('pages.login');
    }

    public function loginAction(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $currentDate = Carbon::now();
            $bulanNama = bulanNama($currentDate->month);

            return redirect()->route('home')->with([
                'bulan' => $bulanNama,
                'success' => true,
                'id' => $user->id
            ]);
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('dashboard');
    }
}
