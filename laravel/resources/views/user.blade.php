@extends('template.app')
@section('user', 'active')

@section('content')
     <!-- Content -->
     <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">{{ config('app.name') }} /</span> Data User
        </h4>

        <div class="app-ecommerce-category">
            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive p-3">
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Alamat</th>
                                <th>No Whatsapp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $data)
                            <!-- Modal -->
                            <div class="modal fade" id="useredit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit - Data User || {{ config('app.name') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('user.edit', ['id' => $data->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama</label>
                                                <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" requi>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" name="username" value="{{ $data->username }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" value="{{ $data->email }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Masukan Password (optional)">
                                                <p style="color: red">*isi password jika ingin ganti password.</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">repassword</label>
                                                <input type="password" name="repassword" class="form-control" placeholder="Masukan Kembali Password">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alamat</label>
                                                <textarea name="alamat" class="form-control" cols="30" rows="5">{{ $data->alamat }}</textarea>
                                                <p style="color: green">*isi jika perlu</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">No Whatsapp</label>
                                                <input type="number" name="hp" value="{{ $data->hp }}" class="form-control" placeholder="Masukan No Whatsapp (optional)">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->alamat ? $data->alamat : '-' }}</td>
                                <td>{{ $data->hp ? $data->hp : '-' }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#useredit{{ $data->id }}"><i class='bx bx-edit'></i></button>
                                    <a href="{{ route('user.hapus', ['id' => $data->id]) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class='bx bx-trash'></i></a>
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
