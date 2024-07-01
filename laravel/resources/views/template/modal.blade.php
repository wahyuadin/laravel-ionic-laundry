<!-- Modal logout -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notifikasi - Logout || {{ config('app.name') }} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        Apakah anda yakin ingin logout?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
        </div>
    </div>
    </div>
</div>

{{-- ======================== --}}
{{-- Kategori --}}
{{-- modal tambah --}}
<div class="modal fade" id="kategoritambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kategori - Tambah Data || {{ config('app.name') }} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('kategori.tambah') }}">
            @csrf
        <div class="modal-body">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                  <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Kategori" required>
                  <div id="emailHelp" class="form-text">We'll never share your nama kategori with anyone else.</div>
                </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
    </div>
</div>

{{-- ======================== --}}
{{-- Produk --}}
{{-- Produk tambah --}}
<div class="modal fade" id="produktambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Produk - Tambah Data || {{ config('app.name') }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('produk.tambah') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori_id" aria-label="Default select example" required>
                            @php
                                $kategori = App\Models\Kategori::all();
                            @endphp
                            <option disabled selected>== Pilih Salah Satu ==</option>
                            @foreach ($kategori as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi" class="form-control" cols="30" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Harga Produk</label>
                        <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga Produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Berat / Kg</label>
                        <input type="number" class="form-control" name="berat" placeholder="Masukkan Berat Kg" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar" required accept="image/jpeg, image/png, image/gif">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

