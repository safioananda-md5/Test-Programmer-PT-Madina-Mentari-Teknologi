<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'employee')->get();
        return view('Employee.index', compact(['employees']));
    }

    public function add()
    {
        $edit = false;
        return view('Employee.add', compact(['edit']));
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|max:150',
                    'phone' => 'required|max:20',
                    'email' => 'required|max:150',
                    'date' => 'required',
                    'newusername' => 'required|max:150',
                    'newpassword' => 'required',
                ],
                [
                    'name.required' => 'Nama karyawan wajib diisi.',
                    'name.max' => 'Nama karyawan maksimal 150 karakter.',
                    'phone.required' => 'Nomor telepon wajib diisi.',
                    'phone.max' => 'Nomor telepon maksimal 20 karakter',
                    'email.required' => 'Email wajib diisi.',
                    'email.max' => 'Email maksimal 150 karakter',
                    'date.required' => 'Tanggal masuk wajib diisi.',
                    'newusername.required' => 'Username wajib diisi.',
                    'newusername.max' => 'Username maksimal 150 karakter',
                    'newpassword' => 'Password wajib diisi.',
                ]
            );

            DB::beginTransaction();
            User::create([
                'name' => $request->name,
                'username' => $request->newusername,
                'email' => $request->email,
                'password' => $request->newpassword,
                'phone' => $request->phone,
                'employee_start_date' => $request->date,
                'role' => 'employee',
            ]);
            DB::commit();
            flash()->addSuccess('Data karyawan berhasil ditambahkan.');
            return redirect(route('employee.index'));
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

    public function edit($id)
    {
        $ID = Crypt::decrypt($id);
        $edit = true;
        $employee = User::find($ID);
        return view('Employee.add', compact(['edit', 'employee']));
    }

    public function update(Request $request, $id)
    {
        $ID = Crypt::decrypt($id);
        try {
            $request->validate(
                [
                    'name' => 'required|max:150',
                    'phone' => 'required|max:20',
                    'email' => 'required|max:150',
                    'date' => 'required',
                    'newusername' => 'required|max:150',
                ],
                [
                    'name.required' => 'Nama karyawan wajib diisi.',
                    'name.max' => 'Nama karyawan maksimal 150 karakter.',
                    'phone.required' => 'Nomor telepon wajib diisi.',
                    'phone.max' => 'Nomor telepon maksimal 20 karakter',
                    'email.required' => 'Email wajib diisi.',
                    'email.max' => 'Email maksimal 150 karakter',
                    'date.required' => 'Tanggal masuk wajib diisi.',
                    'newusername.required' => 'Username wajib diisi.',
                    'newusername.max' => 'Username maksimal 150 karakter',
                ]
            );

            DB::beginTransaction();
            $user = User::find($ID);

            if (isset($request->name)) {
                $user->update([
                    'name' => $request->name
                ]);
            }
            if (isset($request->phone)) {
                $user->update([
                    'phone' => $request->phone
                ]);
            }
            if (isset($request->email)) {
                $user->update([
                    'email' => $request->email
                ]);
            }
            if (isset($request->date)) {
                $user->update([
                    'employee_start_time' => $request->employee_start_time
                ]);
            }
            if (isset($request->newusername)) {
                $user->update([
                    'username' => $request->newusername
                ]);
            }
            if (isset($request->newpassword)) {
                $user->update([
                    'password' => $request->newpassword
                ]);
            }
            DB::commit();
            flash()->addSuccess('Data karyawan berhasil diperbarui.');
            return redirect(route('employee.index'));
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

    public function delete(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate(
                [
                    'id' => 'required',
                ],
                [
                    'id.required' => 'Data karyawan tidak ditemukan.',
                ]
            );

            DB::beginTransaction();
            // $ID = Crypt::decrypt($request->id);
            User::where('id', $request->id)->delete();
            DB::commit();
            flash()->addSuccess('Data karyawan berhasil dihapus.');
            return redirect()->back();
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
