<?php

namespace App\Http\Controllers;

use App\Models\Data\JenisItem;
use App\Models\Data\Kategori;
use App\Models\Data\Parfum;
use App\Models\Data\Pelanggan;
use App\Models\Data\Pengeluaran;
use App\Models\Outlet;
use App\Models\Paket\PaketCuci;
use App\Models\Paket\PaketDeposit;
use App\Models\Transaksi\Penerima;
use App\Models\Transaksi\PickupDelivery;
use App\Models\Transaksi\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Gd\Driver;

class PageController extends Controller
{
    /**
     * Route To login page
     *
     * @return View login
     */
    public function login()
    {
        return view('pages.session.login');
    }

    /**
     * Reset Password Page
     *
     * @return View reset password
     */
    public function resetPassword()
    {
        return view('pages.session.ubahPassword');
    }

    public function dashboard()
    {
        return view('pages.session.home');
    }

    public function jenisItem(Request $request)
    {
        return view(
            'pages.data.Item',
            [
                'data1' => JenisItem::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("unit", $request->get("search"));
                })->orderBy("nama", "asc")->paginate(5),
                'data2' => Kategori::all()
            ]
        );
    }

    public function kategori(Request $request)
    {
        return view(
            'pages.data.Kategori',
            [
                'data' => Kategori::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("deskripsi", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5)
            ]
        );
    }

    public function parfum(Request $request)
    {
        return view(
            'pages.data.Parfum',
            [
                'data1' => Parfum::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("deskripsi", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5),
                'data2' => Parfum::select('jenis')->orderBy("jenis", "asc")->distinct()->get()
            ]
        );
    }

    public function pelanggan(Request $request)
    {
        return view(
            'pages.data.Pelanggan',
            [
                'data1' => Pelanggan::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("no_id", "like", "%" . $request->get("search") . "%")
                        ->orWhere("telephone", "like", "%" . $request->get("search") . "%")
                        ->orWhere("email", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5),
                'data2' => Pelanggan::select('member')->orderBy("member", "asc")->distinct()->get()
            ]
        );
    }

    public function pengeluaran(Request $request)
    {
        return view(
            'pages.data.Pengeluaran',
            [
                'data' => Pengeluaran::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("deskripsi", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5)
            ]
        );
    }

    public function rewash()
    {
        return view(
            'pages.data.Rewash'
        );
    }

    public function karyawan()
    {
        return view(
            'pages.pengaturan.Karyawan',
            ['data' => User::paginate(5)]
        );
    }

    public function outlet(Request $request)
    {
        return view(
            'pages.pengaturan.Outlet',
            [
                'data' => Outlet::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("kode", "like", "%" . $request->get("search") . "%")
                        ->orWhere("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("alamat", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5)
            ]
        );
    }

    public function paket()
    {
        return view(
            'pages.pengaturan.Paket',
            [
                'data1' => PaketCuci::paginate(),
                'data2' => PaketDeposit::paginate()
            ]
        );
    }

    public function pickupDelivery()
    {
        return view(
            'pages.transaksi.PickupDelivery',
            [
                'data1' => PickupDelivery::where('action', 'pickup')->paginate(5),
                'data2' => PickupDelivery::where('action', 'delivery')->paginate(5),
                'data3' => Penerima::where('ambil_di_outlet', 1)->paginate(5),
                'dataPelanggan' => Pelanggan::get(),
                'dataDriver' => User::role('delivery')->get(),
            ]
        );
    }

    public function transaksi()
    {
        $data = [];
        $data['transaksi_id'] = Transaksi::latest()->first()->count == null ? 1 : Transaksi::latest()->first()->id + 1;
        $data['last_transaksi'] = Transaksi::latest()->take(5)->get();
        $data['driver'] = User::role('delivery')->get();
        $data['parfum'] = Parfum::get();
    }

    public function bucket()
    {
        $data['transaksi_id'] = Transaksi::count() == 0 ? 1 : Transaksi::latest()->first()->id + 1;
        $data['last_transaksi'] = Transaksi::latest()->take(5)->get();
        $data['pelanggan'] = Pelanggan::latest()->take(5)->get();
        $data['driver'] = User::role('delivery')->get();
        $data['parfum'] = Parfum::get();
        $data['outlet'] = Outlet::get();

        // dd($data['driver']);

        return view(
            'pages.transaksi.Bucket',
            [
                'data' => $data
            ]

        );
    }
}
