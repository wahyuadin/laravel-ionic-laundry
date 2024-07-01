@extends('template.app')
@section('produk', 'active')


@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">{{ config('app.name') }} /</span> Produk
        </h4>

        <div class="app-ecommerce-category">
            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive p-3">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#produktambah"><i class='bx bx-plus'></i></button>
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Berat / KG</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $data)
                            <div class="modal fade" id="produkedit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Produk - Edit Data || {{ config('app.name') }} </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('produk.edit', ['id' => $data]) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                                    <input type="text" class="form-control" value="{{ $data->nama }}" name="nama" placeholder="Masukkan Nama Produk" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Kategori</label>
                                                    <select class="form-select" name="kategori_id" aria-label="Default select example" required>
                                                        <option selected value="{{ $data->kategori->id }}">{{  $data->kategori->nama }}</option>
                                                        <option disabled>===========</option>
                                                        @php
                                                            $kategori = App\Models\Kategori::all();
                                                        @endphp
                                                        @foreach ($kategori as $kategori)
                                                        <option value="{{ $kategori->id }}">{{  $kategori->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Deskripsi Produk</label>
                                                    <textarea name="deskripsi" class="form-control" cols="30" rows="5" required>{{ $data->deskripsi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Harga Produk</label>
                                                    <input type="number" class="form-control" name="harga" value="{{ $data->harga }}" placeholder="Masukkan Harga Produk" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Berat / Kg</label>
                                                    <input type="number" class="form-control" name="berat" value="{{ $data->berat }}" placeholder="Masukkan Berat Kg" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Gambar</label><br>
                                                    <img src="{{ asset('assets/produk/'. $data->gambar) }}" alt="{{ $data->gambar }}" width="200">
                                                    <input type="file" class="form-control" name="gambar" accept="image/jpeg, image/png, image/gif">
                                                    <p style="color: red">*Abaikan jika gambar tidak dirubah.</p>
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
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->deskripsi }}</td>
                                <td>Rp.{{ $data->harga }}</td>
                                <td>{{ $data->berat }} Kg</td>
                                <td>
                                    <img src="{{ asset('assets/produk/'.$data->gambar) }}" width="100" alt="{{ $data->gambar }}">
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#produkedit{{ $data->id }}"><i class='bx bx-edit'></i></button>
                                    <a href="{{ route('produk.hapus', ['id' => $data->id]) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
