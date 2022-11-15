@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Pengaturan</a><i class="fas fa-angle-right mx-2"></i><a>Pengaturan Outlet</a></header>

    <section id="pengaturan-outlet">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengaturan Data Outlet</h4>
                <hr />
                <div class="table-responsive">
                    <table class="table" id="table-pengaturan-outlet">
                        <thead>
                            <tr>
                                <th>Kode Outlet</th>
                                <th>Nama Outlet</th>
                                <th>Alamat</th>
                                <th>Telepon 1</th>
                                <th>Telepon 2</th>
                                <th>Nomor Fax</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kode 1</td>
                                <td>Outlet 1</td>
                                <td>Alamat 1</td>
                                <td>Telepon 1</td>
                                <td>Telepon 2</td>
                                <td>Fax 1</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                            <tr>
                                <td>Kode 2</td>
                                <td>Outlet 2</td>
                                <td>Alamat 2</td>
                                <td>Telepon 1</td>
                                <td>Telepon 2</td>
                                <td>Fax 2</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div><button class="btn btn-primary" type="button"><i class="fas fa-plus-circle"></i> Tambah</button>
            </div>
            <ul class="list-unstyled form-control" id="list-action">
                <li id="action-update">Rubah data</li>
                <li id="action-change-status">Rubah status</li>
            </ul>
        </div>
        <div role="dialog" tabindex="-1" class="modal fade" id="modal-update-outlet">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Rubah Data Outlet</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <h5>Kode Outlet</h5><input type="text" class="form-control" id="input-kode" name="kode_outlet" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Nama Outlet</h5><input type="text" class="form-control" id="input-nama" name="nama_outlet" />
                                </div>
                                <div class="col-12">
                                    <h5>Alamat lengkap</h5><input type="text" class="form-control" id="input-alamat" name="alamat" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Telepon 1</h5><input type="text" class="form-control" id="input-telp1" name="telepon_1" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Telepon 2</h5><input type="text" class="form-control" id="input-telp2" name="telepon_2" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Nomor Fax</h5><input type="text" class="form-control" id="input-fax" name="nomor_fax" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Status</h5>
                                    <div class="form-control d-flex justify-content-around" style="height: 38px;">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio-status-aktif" />
                                            <label class="form-check-label" for="radio-status-aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio-status-nonaktif" />
                                            <label class="form-check-label" for="radio-status-nonaktif">Non-aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-primary float-end" type="submit"><i class="fas fa-save"></i> Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

<script src="{{ asset('js/pengaturan/outlet.js') }}"></script>
@endsection
