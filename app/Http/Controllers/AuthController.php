<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    public function NB_login()
    {
        if (!session()->get('_login')) {
            return view('Auth.nb_login');
        } else {
            return redirect()->route('dashboard.index');
        }
    }

    public function NB_login_post(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        try {
            // Manual
            $User = User::where('username', $request->username)->first();

            if ($User) {
                if (Hash::check($request->password, $User->password)) {
                    session([
                        '_login' => [
                            'status' => true,
                            'id' => $User->id,
                            'name' => $User->name,
                            'phone' => $User->phone,
                            'role' => $User->role,
                        ]
                    ]);
                    // dd($request->session()->get('_login'));
                    return redirect()->route('dashboard.index');
                } else {
                    throw new Exception('Kredensial Akun Tidak Valid!');
                }
            } else {
                throw new Exception('Kredensial Akun Tidak Valid!');
            }
        } catch (Throwable $e) {
            return redirect()->back()->with('_Throw', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('_login');
        return redirect('/');
    }
}
