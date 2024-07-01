<?php

namespace App\Http\Controllers;

use App\Models\Order;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index() {
        return view('order', ['data' => Order::show()]);
    }

    public function order_accept($id) {
        if (Order::find($id)->update(['status' => '1'])) {
            Alert::success('Berhasil', 'Data Berhasil diaccept');
            return redirect()->back();
        }
    }

    public function order_reject($id) {
        if (Order::find($id)->update(['status' => '2'])) {
            Alert::success('Berhasil', 'Data Berhasil direjct');
            return redirect()->back();
        }
    }
}
