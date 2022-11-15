@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a>
        <i class="fas fa-angle-right mx-2"></i>
        <a>Data Pengeluaran</a>
    </header>
    <section id="data-pengeluaran">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pengeluaran</h4>
                <hr>
                <div class="d-flex justify-content-end">
                    <form method="GET" action="/data/pengeluaran" class="d-flex align-items-center">
                        Search :
                        <input class="form-control mx-1" type="search" name="search" style="max-width: 200px;">
                    </form>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-striped" id="table-pengeluaran">
                        <thead>
                            <tr>
                                <th>Nama Pengeluaran</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th colspan="2">Nominal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $pengeluaran)
                            <tr>
                                <td>{{ $pengeluaran->nama }}</td>
                                <td>{{ $pengeluaran->deskripsi }}</td>
                                <td class="text-center">{{ $pengeluaran->created_at }}</td>
                                <td>Rp</td>
                                <td class="text-end thousand-separator">{{ $pengeluaran->nominal }}</td>
                                <td class="cell-action">
                                    <button id="btn-{{ $pengeluaran->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $data->links() }}
                <button class="btn btn-primary btn-tambah mt-2" type="button">
                    <i class="fas fa-plus-circle"></i>
                    &nbsp;Tambah
                </button>
                <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-update">Rubah data</li>
                    <li id="action-delete">Hapus data</li>
                </ul>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-update">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Rubah Data</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="modal-form" action="/data/pengeluaran" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Nama Pengeluaran</h5>
                                    <input class="form-control" type="text" id="input-nama-pengeluaran" name="nama" required>
                                </div>
                                <div class="col-12">
                                    <h5>Deskripsi</h5>
                                    <textarea class="form-control" id="input-deskripsi" style="resize: none;" name="deskripsi"></textarea>
                                </div>
                                <div class="col-12">
                                    <h5>Nominal</h5>
                                    <div class="form-control d-flex">
                                        <p>Rp</p>
                                        <input class="w-100 ms-2 input-thousand-separator" type="text" id="input-nominal" min=0 name="nominal" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/data/pengeluaran.js') }}"></script>
@endsection
