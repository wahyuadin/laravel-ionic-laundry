<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function produk() {
        return $this->belongsTo(Produk::class);
    }

    public static function show() {
        return Self::with('user','produk.kategori')->where(['show' => '0'])->latest()->get();
    }

    public static function showbyid($id) {
        return Self::with('produk.kategori')->where(['user_id' => $id, 'show' => '1'])->latest()->get()->map(function ($order) {
            if ($order->produk) {
                $order->produk->link = url($order->produk->link);
            }
            return $order;
        });
    }

    public static function riwayat($id) {
        return Self::with('produk.kategori')->where(['user_id' => $id, 'show' => '0'])->latest()->get()->map(function ($order) {
            if ($order->produk) {
                $order->produk->link = url($order->produk->link);
            }
            return $order;
        });
    }

    public static function order($data) {
        return Order::create($data);
    }



}
