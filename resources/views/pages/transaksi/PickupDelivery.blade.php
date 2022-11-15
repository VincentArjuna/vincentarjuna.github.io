@extends('layouts.users')

@section('content')
<div class="container">
    <header class="my-3" style="color: var(--bs-gray);">
        <a>Transaksi</a>
        <i class="fas fa-angle-right mx-2"></i>
        <a>Pickup &amp; Delivery</a>
    </header>
    <div class="card">
        <div class="card-body">
            <section id="section-pickup" class="mb-4">
                <h4>Pickup</h4>
                <hr />
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Driver</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data1 as $pickup)
                                <tr>
                                    <td class="text-center">{{ $pickup->id }}</td>
                                    <td class="text-center">{{ $pickup->pelanggan->nama }}</td>
                                    <td class="text-center">{{ $pickup->nama_driver }}</td>
                                    <td>{{ $pickup->alamat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-end">
                    <button id="create-pickup" class="btn btn-primary">Pickup Baru</button>
                </div>
            </section>
            <hr style="margin: 1rem -1rem;" />
            <section id="section-delivery" class="mb-4">
                <h4>Delivery</h4>
                <hr />
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Driver</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data2 as $delivery)
                                <tr>
                                    <td class="text-center">{{ $delivery->id }}</td>
                                    <td class="text-center">{{ $delivery->pelanggan->nama }}</td>
                                    <td class="text-center">{{ $delivery->nama_driver }}</td>
                                    <td>{{ $delivery->alamat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-end">
                    <button id="create-delivery" class="btn btn-primary">Delivery Baru</button>
                </div>
            </section>
            <hr style="margin: 1rem -1rem;" />
            <section id="section-ambil-outlet" class="mb-4">
                <h4>Ambil di outlet</h4>
                <hr />
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Penerima</th>
                                <th>Outlet</th>
                                <th>Tanggal Ambil</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($data3 as $ambil_di_outlet)
                                <tr>
                                    <td>{{ $ambil_di_outlet->id }}</td>
                                    <td>{{ $ambil_di_outlet->penerima }}</td>
                                    <td>{{ $ambil_di_outlet->outlet->nama }}</td>
                                    <td>{{ $ambil_di_outlet->tanggal_penerimaan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <div role="dialog" tabindex="-1" class="modal fade" id="modal-create-pickup">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Pickup</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/transaksi/pickup-delivery" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <div>
                                    <h5>Pilih Pelanggan</h5>
                                    <select class="form-control" name="pelanggan_id">
                                        <option value="" selected hidden>-</option>
                                        @foreach ($dataPelanggan as $pelanggan)
                                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div>
                                    <h5>Pilih Driver</h5>
                                    <select class="form-control" name="driver_id">
                                        <option value="" selected hidden>-</option>
                                        @foreach ($dataDriver as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div>
                                    <h5>Alamat</h5>
                                    <input type="text" class="form-control" name="alamat" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="pickup">
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div role="dialog" tabindex="-1" class="modal fade" id="modal-create-delivery">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Delivery</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/transaksi/pickup-delivery" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <div>
                                    <h5>Pilih Pelanggan</h5>
                                    <select class="form-control" name="pelanggan_id">
                                        <option value="" selected hidden>-</option>
                                        @foreach ($dataPelanggan as $pelanggan)
                                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div>
                                    <h5>Pilih Driver</h5>
                                    <select class="form-control" name="driver_id">
                                        <option value="" selected hidden>-</option>
                                        @foreach ($dataDriver as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div>
                                    <h5>Alamat</h5>
                                    <input type="text" class="form-control" name="alamat" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="delivery">
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/transaksi/pickupDelivery.js') }}"></script>
@endsection
