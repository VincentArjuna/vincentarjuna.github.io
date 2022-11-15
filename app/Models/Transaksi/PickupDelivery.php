<?php

namespace App\Models\Transaksi;

use App\Models\Data\Pelanggan;
use App\Models\User;
use App\Observers\UserActionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupDelivery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [
        'nama_pelanggan',
        'nama_driver',
    ];

    public static function boot()
    {
        parent::boot();
        PickupDelivery::observe(new UserActionObserver);
    }

    public function getNamaDriverAttribute()
    {
        $driver = User::find($this->driver_id);
        return $driver->username;
    }

    public function getNamaPelangganAttribute()
    {
        return $this->pelanggan->nama;
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'id', 'driver_id');
    }
}
