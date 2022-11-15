<?php

namespace App\Models\Data;

use App\Models\User;
use App\Observers\UserActionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        Kategori::observe(new UserActionObserver);
    }

    public function jenis_item()
    {
        return $this->hasMany(JenisItem::class);
    }
}
