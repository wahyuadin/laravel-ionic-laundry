<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('custom.auth', ['except' => ['produk','login','register','produk_detail']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['username', 'password']);

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => true, 'data' => 'Username atau Password salah !'], 401);
        }

        return $this->respondWithToken($token, User::where('username', $credentials['username'])->get());
    }

    public function register(Request $request) {
        try {
            $this->validate($request, [
                'nama'      => 'required',
                'username'  => 'required',
                'password'  => 'required',
                'email'     => 'required|email|unique:users,email',
                'hp'        => 'nullable',
                'alamat'    => 'nullable',
            ]);

            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            if (User::create($data)) {
                return response()->json(['error' => false, 'data' => 'Register Berhasil!']);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => true, 'message' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Logout Berhasil!']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $data)
    {
        Auth::guard('api')->factory()->getTTL() * 180;
        return response()->json([
            'error'         => false,
            'data'          => $data,
            'token'         => $token

        ]);
    }
}
