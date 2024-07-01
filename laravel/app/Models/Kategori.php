<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [];

    public function produk() {
        return $this->hasMany(Produk::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function show() {
        return Self::with('produk')->latest()->get();
    }

    public static function showbyid($id) {
        return Self::with('produk','user')->where(['id_user' => $id, 'show' => '1'])->latest()->get();
    }

}
