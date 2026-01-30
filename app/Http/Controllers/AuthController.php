<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

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

    public function B_login()
    {
        if (!session()->get('_login')) {
            return view('Auth.b_login');
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
                    return redirect()->route('employee.index');
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

    public function B_login_post(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ], [
                'username.required' => 'Username wajib diisi.',
                'password.required' => 'Password wajib diisi.',
            ]);

            $response = Http::post('https://developers.madinapay.id/auth_siswa/', [
                'username' => $request->username,
                'password' => $request->password,
                'api_key' => env('API_KEY'),
            ])->json();
            if (isset($response['data'])) {
                $User = $response['data'];
                session([
                    '_login' => [
                        'status' => true,
                        'id' => $User['id_cust'],
                        'name' => $User['NMCUST'],
                        'phone' => $User['MOBILE'],
                        'role' => "student",
                        'other' => [
                            'NOCUST' => $User['NOCUST'],
                            'TAHUN_ANGKATAN' => $User['TAHUN_ANGKATAN'],
                            'KELAS' => $User['KELAS'],
                            'NOVA' > $User['NOVA'],
                        ]
                    ]
                ]);
                return redirect()->route('dashboard.index');
            } else {
                throw new Exception('Kredensial Akun Tidak Valid!');
            }
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $allErrors = collect($errors)->flatten()->implode('<br> • ');
            flash()->addError('Inputan Gagal! Periksa kembali isian Anda. <br> • ' . $allErrors);
            return redirect()->back();
        } catch (Throwable $e) {
            DB::rollback();
            flash()->addError('Inputan Gagal! Periksa kembali isian Anda. <br> ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
