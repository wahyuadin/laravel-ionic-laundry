@extends('template.app')
@section('order', 'active')

{{-- @dd($data) --}}

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">{{ config('app.name') }} /</span> Order
        </h4>

        <div class="app-ecommerce-category">
            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive p-3">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Produk</th>
                                <th>Berat</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $data)

                            <!-- order accept -->
                            <div class="modal fade" id="orderaccept{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Order - Accept || {{ config('app.name') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Yakin ?
                                    </div>
                                    <div class="modal-footer">
                                    <form method="POST" action="{{ route('order.accept', ['id' => $data->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Accept</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            {{-- end modal --}}
                            <!-- order reject -->
                            <div class="modal fade" id="ordereject{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Order - Reject || {{ config('app.name') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Yakin ?
                                    </div>
                                    <div class="modal-footer">
                                    <form method="POST" action="{{ route('order.reject', ['id' => $data->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            {{-- end modal --}}
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->produk->nama }} - Rp.{{ $data->produk->harga }}</td>
                                <td>{{ $data->berat }} Kg</td>
                                <td>{{ $data->jumlah }}</td>
                                <td>Rp.{{ $data->total }}</td>
                                <td>
                                    @if ($data->status == 0)
                                    <span class="badge rounded-pill bg-warning">Pending</span>
                                    @elseif ($data->status == 1)
                                    <span class="badge rounded-pill bg-success">Accept</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Reject</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#orderaccept{{ $data->id }}"><i class='bx bx-check' ></i></button>
                                    <botton class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ordereject{{ $data->id }}"><i class='bx bx-x'></i></botton>
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
