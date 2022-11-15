<?php

namespace App\Models\Transaksi;

use App\Models\Data\JenisItem;
use App\Models\Data\Kategori;
use App\Models\User;
use App\Observers\UserActionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [
        'nama',
        'nama_kategori'
    ];

    public static function boot()
    {
        parent::boot();
        ItemTransaksi::observe(new UserActionObserver);
    }

    public function getNamaAttribute()
    {
        $jenis_item = JenisItem::find($this->jenis_item_id);
        return $jenis_item->nama;
    }

    public function getNamaKategoriAttribute()
    {
        $jenis_item = JenisItem::find($this->jenis_item_id);
        $kategori = Kategori::find($jenis_item->kategori_id);
        return $kategori->nama;
    }

    public function jenis_item()
    {
        return $this->belongsTo(JenisItem::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
