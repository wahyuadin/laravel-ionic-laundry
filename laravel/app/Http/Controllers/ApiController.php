<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Order;
use App\Models\Produk;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('custom.auth', ['except' => ['produk','login','register','produk_detail'] ]);
    }

    public function produk() {
        $produks = Produk::show()->map(function ($produk) {
            $produk->link = url($produk->link);
            return $produk;
        });

        return response()->json(['error' => false, 'data' => $produks]);
    }


    public function order(Request $request) {
        try {
            $this->validate($request, [
                'user_id'   => 'required',
                'produk_id' => 'required',
                'berat'     => 'required',
                'jumlah'    => 'required',
                'total'     => 'required'
            ]);
            if (Order::create($request->all())) {
                return response()->json(['error' => false, 'message' => "Berhasil data ditambah!"], 200);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => true, 'message' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function order_cekout(Request $request) {
        try {
            $this->validate($request, [
                'user_id' => 'required'
            ]);
            if (Order::where('user_id', $request->user_id)->update(['show' => '0'])) {
                return response()->json(['error' => false, 'message' => "Berhasil data ditambah!"], 200);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => true, 'message' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function order_history($id) {
        return response()->json(['error' => false, 'data' => Order::riwayat($id)]);
    }

    public function produk_detail($id) {
        $detail = Produk::detail($id)->map(function ($produk) {
            $produk->link = url($produk->link);
            return $produk;
        });
        return response()->json(['error' => false, 'data' => $detail]);
    }

    public function kategori() {
        return response()->json(['error' => false, 'data' => Kategori::show()]);
    }

    public function kategoriById($id) {
        return response()->json(['error' => false, 'data' => Kategori::showbyid($id)]);
    }

    public function history_show($id) {
        $orders = Order::showbyid($id);
        if ($orders->isEmpty()) {
            return response()->json(['error' => true, 'message' => "Data tidak ada"], 404);
        }
        return response()->json(['error' => false, 'data' => $orders], 200);
    }


    public function history_add(Request $request) {
        try {
            $this->validate($request, [
                'user_id'   => 'required',
                'produk_id' => 'required',
                'berat'     => 'required',
                'jumlah'    => 'required',
                'total'     => 'required',
            ]);

            if (Order::create($request->all())) {
                return response()->json(['error' => false, 'data' => 'Berhasil menambah data']);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => true, 'message' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit_profile(Request $request, $id) {
        try {
            $this->validate($request, [
                'nama'          => 'required',
                'username'      => 'required',
                'email'         => 'required|email',
                'password'      => 'nullable',
                'alamat'       => 'required',
                'hp'         => 'required',
            ]);

            $data = $request->all();

            if (filled($request->password)) {
                $password = bcrypt($request->password);
                $data['password'] = $password;
            }

            if (User::find($id)->update($data)) {
                return response()->json(['error' => false, 'data' => 'Data Berhasil di Update'], 200);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => true, 'message' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function profile_show($id) {
        return response()->json(['error' => false, 'data' => User::where('id',$id)->get()]);
    }

    public function wa($phone) {
        $data = [
            'apiKey' => 'ac6510ceffcc46679a59b1ef86828a61',
            'phone' => $phone,
            'message' => "Terimakasih telah order di kami! Mohon ditunggu, kami akan segera ke alamat anda.",
        ];

        // URL API yang akan dituju
        $apiUrl = 'http://98.142.245.14:41243/api/sendMessage';

        // Menggunakan Guzzle untuk membuat permintaan POST
        $client = new Client();
        try {
            $response = $client->request('POST', $apiUrl, [
                'form_params' => $data,
            ]);

            // Mendapatkan status code dari response
            $statusCode = $response->getStatusCode();

            // Mendapatkan body response
            $body = $response->getBody()->getContents();

            return response()->json(['error' => false, 'data' => $body], $statusCode);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to send message: ' . $e->getMessage(),
            ], 500);
        }
    }
}
