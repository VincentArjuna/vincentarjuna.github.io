@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a><i class="fas fa-angle-right mx-2"></i><a>Data Rewash</a></header>
    <section id="data-pengeluaran">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Rewash</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="table-rewash">
                        <thead>
                            <tr>
                                <th>ID Cuci</th>
                                <th>Jenis Rewash</th>
                                <th>Alasan Rewash</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ID001</td>
                                <td>Salah Parfum</td>
                                <td>07.01.2020 00:07:27</td>
                                <td>Freddy</td>
                                <td>07.01.2020 00:07:27<br></td>
                                <td>Freddy</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                            <tr>
                                <td>ID002</td>
                                <td>Masih Kotor</td>
                                <td>07.01.2020 00:07:27<br></td>
                                <td>Freddy</td>
                                <td>07.01.2020 00:07:27<br></td>
                                <td>Freddy</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary btn-tambah" type="button">
                    <i class="fas fa-plus-circle"></i>
                    &nbsp;Tambah
                </button>
                <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-update">Rubah data</li>
                    <li id="action-change-status">Rubah status</li>
                </ul>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-update">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Rewash</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>ID Cuci</h5><input class="form-control" type="text" id="input-nama-pengeluaran" name="username">
                                </div>
                                <div class="col-12">
                                    <h5>Alasan Rewash</h5><textarea class="form-control" id="input-deskripsi" style="resize: none;"></textarea>
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

<script src="{{ asset('js/data/rewash.js') }}"></script>
@endsection
