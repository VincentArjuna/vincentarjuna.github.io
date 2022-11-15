<?php

namespace App\Models\Transaksi;

use App\Models\Data\CatatanPelanggan;
use App\Models\Data\Pelanggan;
use App\Models\Outlet;
use App\Models\Data\Parfum;
use App\Models\Paket\PaketCuci;
use App\Models\User;
use App\Observers\UserActionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        User::observe(new UserActionObserver);
    }

    public function recalculate()
    {
        $pelanggan = Pelanggan::find($this->pelanggan_id);

        $subtotal = 0;
        $diskon = $this->diskon;
        $diskon_member = $pelanggan->member ? 10 : 0;
        $grand_total = 0;

        $sum_bobot = ItemTransaksi::where('transaksi_id', $this->id)->sum('bobot_bucket');
        $sum_harga_premium = ItemTransaksi::where('transaksi_id', $this->id)->sum('harga_premium');

        $paket_bucket = PaketCuci::where('nama_paket', 'BUCKET')->first();
        $jumlah_bucket = ceil($sum_bobot / $paket_bucket->jumlah_bobot);
        $total_harga_bucket = $jumlah_bucket * $paket_bucket->harga_paket;

        $subtotal = $sum_harga_premium + $total_harga_bucket;
        $grand_total = $subtotal * ((100 - ($diskon + $diskon_member)) / 100);

        $this->total_bobot = $sum_bobot;
        $this->jumlah_bucket = $jumlah_bucket;
        $this->subtotal = $subtotal;
        $this->grand_total = $grand_total;
        $this->save();
        return $this;
    }

    public function scopeDetail($query)
    {
        return $query->with('item_transaksi', 'pickup_delivery', 'outlet', 'parfum', 'pelanggan', 'penerima', 'pelanggan.catatan_pelanggan', 'penerima');
    }

    public function item_transaksi()
    {
        return $this->hasMany(ItemTransaksi::class);
    }

    public function pickup_delivery()
    {
        return $this->hasMany(PickupDelivery::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function parfum()
    {
        return $this->belongsTo(Parfum::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function penerima()
    {
        return $this->hasOne(Penerima::class);
    }
}
