@extends('layouts.users')

@section('content')
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="container">
    <header class="my-3 d-flex justify-content-between" style="color: var(--bs-gray);">
        <div class="d-flex align-items-center">
            <a>Transaksi</a>
            <i class="fas fa-angle-right mx-2"></i>
            <a>Cuci Bucket</a>
        </div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bss-tooltip="" id="show-option" type="button" title="Show options">
            <i class="fas fa-cog"></i>
        </button>
    </header>

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-opsi-trans">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Opsi Transaksi</h4>
                </div>
                <div class="modal-body">
                    <div class="d-flex mb-3">
                        <input class="form-control" type="search" id="input-key-trans" placeholder="Kata kunci">
                        <button class="btn btn-primary mx-3" data-bs-toggle="tooltip" data-bss-tooltip="" id="search-key-trans" type="button" title="Cari transaksi">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="tooltip" data-bss-tooltip="" id="add-new-trans" type="button" title="Buat transaksi baru">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-list-trans">
                            <thead class="text-center">
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Outlet</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th colspan="2">Harga Total</th>
                                    <th>Lunas</th>
                                </tr>
                            </thead>
                            <tbody style="cursor: pointer">
                                @foreach ($data['last_transaksi'] as $trans)
                                <tr data-bs-toggle="tooltip" data-bss-tooltip="" title="Double klik untuk memilih">
                                    <td>{{ $trans->id }}</td>
                                    <td>{{ $trans->outlet->nama }}</td>
                                    <td class="text-center">{{ $trans->created_at }}</td>
                                    <td>{{ $trans->pelanggan->nama }}</td>
                                    <td>Rp</td>
                                    <td class="text-end thousand-separator">{{ $trans->grand_total }}</td>
                                    <td class="text-center">
                                    @if($trans->lunas)
                                        Lunas
                                    @else
                                        Belum Lunas
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="dialog" id="modal-new-trans" tabindex="-1" class="modal fade">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Transaksi Baru</h4>
                    <button type="button" class="btn btn-sm btn-primary" id="new-trans-back" data-bs-dismiss="modal" aria-label="">Kembali</button>
                </div>
                <div class="modal-body">
                    <section id="section-info-pelanggan-2">
                        <header class="d-flex align-items-center">
                            <h4>Pelanggan</h4>
                        </header>
                        <div id="info-pelanggan-2" class="mt-2">
                            <div class="mb-2 position-relative">
                                <button class="btn btn-primary" id="search-pelanggan-2" type="button"><i class="fas fa-search"></i> Cari Pelanggan</button>
                                <div class="position-absolute card card-body w-100 mt-2" style="background-color: white;height: 342px; display: none;">
                                    <form class="mb-3">
                                        <div class="d-flex">
                                            <input type="search" class="form-control" id="input-nama-pelanggan-2" placeholder="Nama Pelanggan" />
                                            <button class="btn btn-primary mx-3" data-bs-toggle="tooltip" id="search-nama-pelanggan-2" type="button" title="Cari transaksi"><i class="fas fa-search"></i></button>
                                            <button class="btn btn-primary" data-bs-toggle="tooltip" id="add-new-pelanggan-2" type="button" title="Buat transaksi baru"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="table-list-pelanggan-2">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Alamat</th>
                                                    <th>Membership</th>
                                                </tr>
                                            </thead>
                                            <tbody style="cursor: pointer">
                                                @foreach ($data['pelanggan'] as $pelanggan)
                                                <tr id="row-{{ $pelanggan->id }}" data-bs-toggle="tooltip" data-bss-tooltip="" title="Double klik untuk memilih">
                                                    <td>{{ $pelanggan->nama }}</td>
                                                    <td class="text-center">{{ $pelanggan->tanggal_lahir }}</td>
                                                    <td>{{ $pelanggan->alamat }}</td>
                                                    <td class="text-center">
                                                    @if($pelanggan->member)
                                                        Member
                                                    @else
                                                        Bukan member
                                                    @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <form id="data-pelanggan-2">
                                <div class="row">
                                    <input type="hidden" id="input-id-2" />
                                    <div class="col-12 mb-2">
                                        <h5>Nama</h5>
                                        <input type="text" class="form-control disabled" id="input-nama-2" />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <h5>Alamat</h5>
                                        <input type="text" class="form-control disabled" id="input-alamat-2" />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <h5>Telepon</h5>
                                        <input type="text" class="form-control disabled" id="input-telepon-2" />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <h5>E-mail</h5>
                                        <input type="text" class="form-control disabled" id="input-email-2" />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <h5>Tanggal Lahir</h5>
                                        <input type="date" class="form-control disabled" id="input-tanggal-lahir-2" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="create-trans">Create trans</button>
                </div>
            </div>
        </div>
    </div>

    <section id="section-info">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 position-relative">
                        <section id="section-info-pelanggan">
                            <header class="d-flex justify-content-between align-items-center">
                                <h5>Pelanggan</h5>
                                <button class="btn show-data" id="show-data-pelanggan" type="button">
                                    <i class="fas fa-chevron-down large"></i>
                                </button>
                            </header>
                            <div id="info-pelanggan" class="mt-2" style="display: none;">
                                <div class="modal fade" role="dialog" tabindex="-1" id="modal-list-pelanggan">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Cari Pelanggan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="mb-3">
                                                    <div class="d-flex">
                                                        <input class="form-control" type="search" id="input-nama-pelanggan" placeholder="Nama Pelanggan">
                                                        <button class="btn btn-primary mx-3" data-bs-toggle="tooltip" data-bss-tooltip="" id="search-nama-pelanggan" type="button" title="Cari transaksi">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                        <button class="btn btn-primary" data-bs-toggle="tooltip" data-bss-tooltip="" id="add-new-pelanggan" type="button" title="Buat transaksi baru">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover" id="table-list-pelanggan">
                                                        <thead class="text-center">
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th>Tanggal Lahir</th>
                                                                <th>Alamat</th>
                                                                <th>Membership</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="cursor: pointer">
                                                            @foreach ($data['pelanggan'] as $pelanggan)
                                                            <tr id="row-{{ $pelanggan->id }}" data-bs-toggle="tooltip" data-bss-tooltip="" title="Double klik untuk memilih">
                                                                <td>{{ $pelanggan->nama }}</td>
                                                                <td class="text-center">{{ $pelanggan->tanggal_lahir }}</td>
                                                                <td>{{ $pelanggan->alamat }}</td>
                                                                <td class="text-center">
                                                                @if($pelanggan->member)
                                                                    Member
                                                                @else
                                                                    Bukan member
                                                                @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form id="data-pelanggan">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h6>Nama</h6>
                                            <input class="form-control disabled" type="text" id="input-nama" name="username" value="temp">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h6>Alamat</h6>
                                            <input class="form-control disabled" type="text" id="input-alamat">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h6>Telepon</h6>
                                            <input class="form-control disabled" type="text" id="input-telepon">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h6>E-mail</h6>
                                            <input class="form-control disabled" type="text" id="input-email">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h6>Tanggal Lahir</h6>
                                            <input class="form-control disabled" id="input-tanggal-lahir" type="date">
                                        </div>
                                        <div class="col-12">
                                            <h6>Catatan Pelanggan</h6>
                                            <textarea class="form-control disabled" style="resize: none;" id="input-catatan-pelanggan"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                    <div class="col-3 position-relative">
                        <div class="vr position-absolute" style="height: calc(100% + 2rem); margin: -1rem 0; border-left: 1px solid rgba(0,0,0,.125); top: 0; left: 0;"></div>
                        <section id="section-info-pickup-delivery" class="h-100">
                            <header class="d-flex justify-content-between align-items-center">
                                <h5 class="d-flex justify-content-between align-items-center">Pickup &amp; Delivery</h5>
                                <button class="btn show-data" id="show-data-pickup-delivery" type="button">
                                    <i class="fas fa-chevron-down large"></i>
                                </button>
                            </header>
                            <div id="info-pickup-delivery" class="mt-2" style="display: none;">
                                <div class="mb-5 disabled">
                                    <div class="form-check" id="check-pickup" style="margin-bottom: .5rem;">
                                        <input class="form-check-input" type="checkbox" id="formCheck-pickup">
                                        <label class="form-check-label" for="formCheck-pickup">Pickup</label>
                                    </div>
                                    <div id="container-pickup" class="position-relative mb-2" style="display: none;">
                                        <h6>Nama driver</h6>
                                        <select class="form-control" id="select-driver-pickup">
                                            <option value="" selected hidden>-</option>
                                            @foreach ($data['driver'] as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->username }}</option>
                                            @endforeach
                                        </select>
                                        <h6 class="mt-2">Alamat ambil</h6>
                                        <input type="text" class="form-control" id="input-alamat-ambil">
                                    </div>
                                    <div class="form-check" id="check-delivery" style="margin-bottom: .5rem;">
                                        <input class="form-check-input" type="checkbox" id="formCheck-delivery" />
                                        <label class="form-check-label" for="formCheck-delivery">Delivery</label>
                                    </div>
                                    <div id="container-delivery" class="position-relative mb-2" style="display: none;">
                                        <h6>Nama driver</h6>
                                        <select class="form-control" id="select-driver-delivery">
                                            <option value="" selected hidden>-</option>
                                            @foreach ($data['driver'] as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->username }}</option>
                                            @endforeach
                                        </select>
                                        <h6 class="mt-2">Alamat antar</h6>
                                        <input type="text" class="form-control" id="input-alamat-antar">
                                    </div>
                                </div>
                                <div class="position-absolute bottom-0" style="right: 0.75rem;">
                                    <button class="btn btn-primary" id="to-pickup-delivery">Edit Pickup & Delivery</button>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-3 position-relative">
                        <div class="vr position-absolute" style="height: calc(100% + 2rem); margin: -1rem 0; border-left: 1px solid rgba(0,0,0,.125); top: 0; left: 0;"></div>
                        <section id="section-info-outlet">
                            <header>
                                <h5 class="d-flex justify-content-between align-items-center">
                                    Outlet
                                    <button class="btn show-data" id="show-data-outlet" type="button">
                                        <i class="fas fa-chevron-down large"></i>
                                    </button>
                                </h5>
                            </header>
                            <div id="info-outlet" class="position-relative mt-2" style="display: none;">
                                <h6>Outlet input</h6>
                                <select class="form-control disabled" id="select-outlet">
                                    <option value="" selected hidden>-</option>
                                    @foreach ($data['outlet'] as $outlet)
                                        <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </section>
                    </div>
                    <div class="col-3 position-relative">
                        <div class="vr position-absolute" style="height: calc(100% + 2rem); margin: -1rem 0; border-left: 1px solid rgba(0,0,0,.125); top: 0; left: 0;"></div>
                        <section id="section-info-penerimaan" class="h-100">
                            <header>
                                <h5 class="d-flex justify-content-between align-items-center">
                                    Penerimaan
                                    <button class="btn show-data" id="show-data-penerimaan" type="button">
                                        <i class="fas fa-chevron-down large"></i>
                                    </button>
                                </h5>
                            </header>
                            <div id="info-penerimaan" class="mt-2" style="display: none;">
                                <div class="mb-5">
                                    <h6 class="mt-2">Outlet Ambil</h6>
                                    <select class="form-control" id="select-outlet-ambil">
                                        <option value="">-</option>
                                        @foreach ($data['outlet'] as $outlet)
                                            <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                                        @endforeach
                                    </select>
                                    <h6 class="mt-2">Nama Penerima</h6>
                                    <input type="text" class="form-control" id="input-nama-penerima" name="penerima">
                                    <h6 class="mt-2">Tanggal Penerimaan</h6>
                                    <input type="date" class="form-control" id="input-date-penerimaan" name=tanggal_penerimaan>
                                    <h6 class="mt-2">Foto Penerima</h6>
                                    <input type="file" class="form-control" id="input-foto-penerima" name="image" accept="image/*">
                                </div>
                                <div class="position-absolute bottom-0" style="right: 0.75rem;">
                                    <button class="btn btn-primary" id="simpan-info-penerimaan">Simpan Penerimaan</button>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-transaksi-cuci">
        <section id="section-detail-transaksi">
            <div class="card">
                <div class="card-body">
                    <header>
                        <h3>Kode Transaksi : <span id="kode-trans"></span><span id="id-trans" class="d-none"></span></h3>
                    </header>
                    <div class="table-responsive my-2">
                        <table class="table table-striped mb-0" id="table-trans-item">
                            <thead>
                                <tr>
                                    <th>Nama Item</th>
                                    <th>Kategori</th>
                                    <th>Pencuci</th>
                                    <th>Penyetrika</th>
                                    <th>Proses</th>
                                    <th>Catatan</th>
                                    <th colspan="2">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center" colspan="8" style="padding-top: 4px;padding-bottom: 4px;">
                                        <button class="btn btn-primary btn-sm" id="add-item" type="button">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="6">Sub Total</td>
                                    <td>Rp</td>
                                    <td class="text-end thousand-separator" id="sub-total"></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Diskon</td>
                                    <td>Rp</td>
                                    <td class="text-end thousand-separator" id="diskon"></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Diskon Member</td>
                                    <td>Rp</td>
                                    <td class="text-end thousand-separator" id="diskon-member"></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Grand Total</td>
                                    <td>Rp</td>
                                    <td class="text-end thousand-separator" id="grand-total"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <form method="POST" id="form-transaksi">
                        @csrf
                        <div class="row">
                            <div class="col-4 p-2">
                                <h5>Parfum</h5>
                                <select class="form-select-sm form-control" id="input-parfum" name="parfum_id" style="max-width: 200px;">
                                    <option value="" selected hidden>-</option>
                                    @foreach ($data['parfum'] as $parfum)
                                        <option value="{{ $parfum->id }}">{{ $parfum->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 p-2">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <div class="form-check me-1">
                                        <input class="form-check-input" type="checkbox" id="formCheck-express" name="express" value=0>
                                        <label class="form-check-label" for="formCheck-express">Express</label>
                                    </div>
                                    <div class="form-check ms-1">
                                        <input class="form-check-input" type="checkbox" id="formCheck-setrika" name="setrika_only" value=0>
                                        <label class="form-check-label" for="formCheck-setrika">Setrika only</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 p-2 d-flex align-items-center justify-content-end">
                                <button class="btn btn-primary" type="button">Kode Promosi</button>
                            </div>
                            <div class="col-9 p-2 d-flex align-items-center">
                                <div class="position-relative w-100">
                                    <button class="btn btn-primary" id="show-catatan-trans" type="button" style="width: 200px;">Catatan Transaksi</button>
                                    <div class="position-absolute mt-1 w-100 card p-2" style="z-index: 1;display: none;">
                                        <textarea class="form-control" id="input-catatan-trans" name="catatan"></textarea>
                                        <button class="btn btn-primary" id="save-catatan-trans" type="button">Simpan Catatan</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 p-2 d-flex align-items-center justify-content-end">
                                <button id="save-trans" class="btn btn-primary" type="submit">Simpan Transaksi</button>
                            </div>
                        </div>
                    </form>

                    <div role="dialog" tabindex="-1" class="modal fade" id="modal-add-item">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pilih Item</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex mb-3">
                                        <input class="form-control" type="search" id="input-nama-item" placeholder="Nama Item">
                                        <button class="btn btn-primary ms-3" data-bs-toggle="tooltip" data-bss-tooltip="" id="search-item" type="button" title="Cari Item">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="table-items">
                                            <thead>
                                                <tr>
                                                    <th>Nama Item</th>
                                                    <th>Kategori</th>
                                                    <th>Bobot</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="dialog" tabindex="-1" class="modal fade" id="modal-list-catatan-item">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Catatan Item</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table" id="table-list-catatan">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Noted By</th>
                                                    <th>Catatan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-center" colspan="3"><button class="btn btn-primary btn-sm" type="button" id="add-catatan-item"><i class="fas fa-plus"></i></button></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="dialog" tabindex="-1" class="modal fade" id="modal-catatan-item">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Catatan Item <span id="catatan-item-name">nama item</span></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-2">
                                                <h5>Noted by</h5>
                                                <input type="text" class="form-control" id="penulis-catatan-item" />
                                            </div>
                                            <div class="h-100">
                                                <h5>Notes</h5>
                                                <textarea class="form-control" id="catatan-item"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div>
                                                <ul role="tablist" class="nav nav-tabs">
                                                    <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link active" href="#tab-foto">Foto</a></li>
                                                    <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link" href="#tab-noda">Tandai Noda</a></li>
                                                </ul>
                                                <div class="tab-content card" style="border-top: none;border-radius: 0;height: 513px;">
                                                    <div role="tabpanel" class="tab-pane active p-2" id="tab-foto">
                                                        <img id="container-image-item" class="w-100 mb-2" style="object-fit: contain;max-height: 450px;height: 450px;" />
                                                        <div class="text-end">
                                                            <input type="file" class="form-control" id="input-foto-item" accept="image/*" onchange="document.getElementById('container-image-item').src = window.URL.createObjectURL(this.files[0])"/>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane p-2" id="tab-noda">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5>Tampak Depan</h5>
                                                                <div id="tampak-depan" class="position-relative">
                                                                    <div class="card p-2" style="height: 230px;">
                                                                        <div class="w-100 h-100" style="background-image: url({{asset('image/tshirt-front.jpg')}});background-size: cover;"></div>
                                                                    </div>
                                                                    <div id="td-kiri-atas" class="position-absolute w-50 h-50 card stain-selection" style="top: 0;left: 0;"></div>
                                                                    <div id="td-kanan-atas" class="position-absolute w-50 h-50 card stain-selection" style="top: 0;left: 50%;"></div>
                                                                    <div id="td-kiri-bawah" class="position-absolute w-50 h-50 card stain-selection" style="top: 50%;left: 0;"></div>
                                                                    <div id="td-kanan-bawah" class="position-absolute w-50 h-50 card stain-selection" style="top: 50%;left: 50%;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h5>Tampak Belakang</h5>
                                                                <div id="tampak-belakang" class="position-relative">
                                                                    <div class="card p-2" style="height: 230px;">
                                                                        <div class="w-100 h-100" style="background-image: url({{asset('image/tshirt-back.jpg')}});background-size: cover;"></div>
                                                                    </div>
                                                                    <div id="tb-kiri-atas" class="position-absolute w-50 h-50 card stain-selection" style="top: 0;left: 0;"></div>
                                                                    <div id="tb-kanan-atas" class="position-absolute w-50 h-50 card stain-selection" style="top: 0;left: 50%;"></div>
                                                                    <div id="tb-kiri-bawah" class="position-absolute w-50 h-50 card stain-selection" style="top: 50%;left: 0;"></div>
                                                                    <div id="tb-kanan-bawah" class="position-absolute w-50 h-50 card stain-selection" style="top: 50%;left: 50%;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="simpan-catatan-item">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>

<script src="{{ asset('js/transaksi/bucket.js') }}"></script>
@endsection
