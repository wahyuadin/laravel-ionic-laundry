<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index() {
        confirmDelete('Peringatan', 'Apakah Anda Yakin Untuk Hapus ?');
        return view('kategori', ['data' => Kategori::all()]);
    }

    public function kategori_tambah(Request $request) {
        $this->validate($request, [
            'nama' => 'required',
        ]);

        if (Kategori::create($request->all())) {
            Alert::success('Berhasil', 'Data Berhasil Ditambah!');
            return redirect()->back();
        }
    }

    public function kategori_edit(Request $request, $id) {
        $this->validate($request, [
            'nama' => 'required'
        ]);
        if (Kategori::find($id)->update($request->all())) {
            Alert::success('Berhasil', 'Data Berhasil Diedit!');
            return redirect()->back();
        }
    }

    public function kategori_hapus($id) {
        if (Kategori::find($id)->delete()) {
            Alert::success('Berhasil', 'Data Berhasil Dihapus!');
            return redirect()->back();
        }
    }
}
