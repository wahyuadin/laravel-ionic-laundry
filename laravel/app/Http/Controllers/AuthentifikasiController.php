<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthentifikasiController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function proses(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username Wajib Diisi!',
            'password.required' => 'Password Wajib Diisi!',
        ]);

        $credentials = $request->except('_token');
        if (!Auth::attempt($credentials)) {
            Alert::error('Gagal', 'Username atau Password Salah!');
            return redirect()->route('login');
        }
        Alert::success('Berhasil', 'Login Berhasil!');
        return redirect()->route('dashboard');
    }

    public function logout() {
        Alert::success('Success', 'logout Berhasil !');
        Auth::logout();
        return redirect(route('login'));
    }
}
