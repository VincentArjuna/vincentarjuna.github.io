@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a><i class="fas fa-angle-right mx-2"></i><a>Data Pelanggan</a></header>
    <section id="data-pelanggan">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pelanggan</h4>
                <hr>
                <div class="d-flex justify-content-end">
                    <form method="GET" action="/data/pelanggan" class="d-flex align-items-center">
                        Search :
                        <input class="form-control mx-1" type="search" name="search" style="max-width: 200px;">
                    </form>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-striped" id="table-pelanggan">
                        <thead>
                            <tr>
                                <th>Outlet</th>
                                <th>Membership</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Jenis ID</th>
                                <th>Nomor ID</th>
                                <th>Telphone</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data1 as $pelanggan)
                            <tr>
                                <td>Outlet Pelanggan</td>
                                @if ($pelanggan->member)
                                    <td class="text-center">Member</td>
                                @else
                                    <td class="text-center">Bukan member</td>
                                @endif
                                <td>{{ $pelanggan->nama }}</td>
                                <td class="text-center">{{ $pelanggan->tanggal_lahir }}</td>
                                <td>{{ $pelanggan->alamat }}</td>
                                <td class="text-center">{{ $pelanggan->jenis_id }}</td>
                                <td class="text-center">{{ $pelanggan->no_id }}</td>
                                <td>{{ $pelanggan->telephone }}</td>
                                <td>{{ $pelanggan->email }}</td>
                                @if ($pelanggan->status)
                                    <td class="text-center">Aktif</td>
                                @else
                                    <td class="text-center">Tidak aktif</td>
                                @endif
                                <td class="cell-action">
                                    <button id="btn-{{ $pelanggan->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $data1->links() }}
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
                        <h4 class="modal-title">Data Pelanggan</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="modal-form" action="/data/pelanggan" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Nama Lengkap</h5>
                                    <input class="form-control" type="text" id="input-nama-pelanggan" name="nama" required>
                                </div>
                                <div class="col-12">
                                    <h5>Alamat</h5>
                                    <input class="form-control" type="text" id="input-alamat" name="alamat" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Tanggal Lahir</h5>
                                    <input class="form-control" id="input-tanggal-lahir" type="date" name="tanggal_lahir" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Tipe Member</h5>
                                    <div class="form-control d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-member" name="member" value=1 />
                                            <label class="form-check-label" for="formCheck-member">Member</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-non-member" name="member" value=0 />
                                            <label class="form-check-label" for="formCheck-non-member">Bukan member</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Nomor Identitas</h5>
                                    <input class="form-control" type="text" id="input-nomor-identitas" name="no_id" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Jenis Identitas</h5>
                                    <select class="form-select" id="input-jenis-identitas" name="jenis_id" required>
                                        <option value='' disabled selected hidden>-</option>
                                        <option value="ktp">KTP</option>
                                        <option value="sim">SIM</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <h5>Telephone</h5>
                                    <input class="form-control" type="text" id="input-telepon" name="telephone" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                                <div class="col-12 col-sm-4">
                                    <h5>E-mail</h5>
                                    <input class="form-control" type="text" id="input-email" name="email" required>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <h5>Status</h5>
                                    <div class="form-control d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-aktif" name="status" value=1 />
                                            <label class="form-check-label" for="formCheck-aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-tidakAktif" name="status" value=0 />
                                            <label class="form-check-label" for="formCheck-tidakAktif">Tidak aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-primary" type="submit">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/data/pelanggan.js') }}"></script>
@endsection
