<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    public function index() {
        confirmDelete('Peringatan', 'Apakah Anda Yakin Untuk Hapus ?');
        return view('produk', ['data' => Produk::show()]);
    }

    public function produk_tambah(Request $request) {
        $this->validate($request, [
            'nama'          => 'required',
            'kategori_id'   => 'required',
            'deskripsi'     => 'required',
            'harga'         => 'required|numeric',
            'berat'         => 'required|numeric',
            'gambar'        => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $data = $request->all();
        $file = $request->file('gambar');
        $nama_file = time() . '_' . $file->getClientOriginalName();
        $path = 'assets/produk/';
        $file->move(public_path($path), $nama_file);
        $data['gambar'] = $nama_file;
        $data['link'] = $path . $nama_file;

        if (Produk::create($data)) {
            Alert::success('Berhasil', 'Data Berhasil Ditambah!');
            return redirect()->back();
        }
    }

    public function produk_edit(Request $request, $id) {
        $this->validate($request, [
            'nama'          => 'required',
            'kategori_id'   => 'required',
            'deskripsi'     => 'required',
            'harga'         => 'required|numeric',
            'berat'         => 'required|numeric',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $data = $request->all();
        if (filled($request->gambar)) {
            $file = $request->file('gambar');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $path = 'assets/produk/';
            $file->move(public_path($path), $nama_file);
            $data['gambar'] = $nama_file;
            $data['link'] = "127.0.0.1:8000" . $path . $nama_file;
        }

        if (Produk::find($id)->update($data)) {
            Alert::success('Berhasil', 'Data Berhasil Diedit!');
            return redirect()->back();
        }
    }

    public function produk_hapus($id) {
        if (Produk::find($id)->delete()) {
            Alert::success('Berhasil', 'Data Berhasil Dihapus!');
            return redirect()->back();
        }
     }
}
