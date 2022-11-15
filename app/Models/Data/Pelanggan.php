<?php

namespace App\Models\Data;

use App\Models\User;
use App\Observers\UserActionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        Pelanggan::observe(new UserActionObserver);
    }

    public function catatan_pelanggan()
    {
        return $this->hasOne(CatatanPelanggan::class);
    }
}
