<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataUserController extends Controller
{
    public function index() {
        confirmDelete('Peringatan', 'Apakah Anda Yakin Untuk Hapus Data ?');
        return view('user', ['data' => User::all()]);
    }

    public function user_hapus($id) {
        if (User::find($id)->delete()) {
            Alert::success('Berhasil', 'Data Berhasil Dihapus!');
            return redirect()->back();
        }
    }

    public function user_edit(Request $request, $id) {
        $this->validate($request, [
            'nama'          => 'required',
            'username'      => 'required',
            'email'         => 'required|email',
            'password'      => 'nullable',
            'repassword'    => 'nullable|same:password',
            'alamat'        => 'nullable',
            'hp'            => 'nullable',
        ]);

        $data = $request->except(['_token', 'repassword']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        if (User::find($id)->update($data)) {
            Alert::success('Berhasil', 'Data berhasil diupdate!');
            return redirect()->back();
        }
    }
}
