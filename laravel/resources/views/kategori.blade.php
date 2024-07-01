@extends('template.app')
@section('kategori', 'active')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">{{ config('app.name') }} /</span> Kategori
        </h4>

        <div class="app-ecommerce-category">
            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive p-3">
                    <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#kategoritambah"><i class='bx bx-plus'></i></button>
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $data)
                            <!-- Edit Modal -->
                            <div class="modal fade" id="kategoriedit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kategori - Edit Data || {{ config('app.name') }} </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('kategori.edit',['id' => $data->id]) }}">
                                        @csrf
                                        @method('PUT')
                                    <div class="modal-body">
                                            <div class="mb-3">
                                              <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                                              <input type="text" class="form-control" value="{{ $data->nama }}" name="nama" placeholder="Masukan Nama Kategori" required>
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
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#kategoriedit{{ $data->id }}"><i class='bx bx-edit'></i></button>
                                    <a href="{{ route('kategori.hapus', ['id' => $data->id]) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class='bx bx-trash'></i></a>
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
