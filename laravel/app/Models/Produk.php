<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public static function show() {
        return Self::with('kategori')->latest()->get();
    }

    public static function detail($id){
        return Self::with('kategori')->where('id', $id)->get();
    }
}
