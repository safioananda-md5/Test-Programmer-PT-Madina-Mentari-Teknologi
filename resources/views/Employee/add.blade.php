@extends('Layouts.main')
@push('title')
    Employee
@endpush
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between px-3 mb-3">
                <h4>{{ $edit ? 'Edit' : 'Add' }} Employee</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employee.index') }}"
                                class="text-decoration-none">Employee</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $edit ? 'Edit' : 'Add' }} Employee</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row px-3">
            @if ($edit)
                <form action="{{ route('employee.update', Crypt::encrypt($employee->id)) }}" method="POST">
                    @method('PUT')
                @else
                    <form action="{{ route('employee.store') }}" method="POST">
            @endif
            @csrf
            <div class="d-flex flex-column border-bottom pb-3 mb-3">
                <h5 class="m-0">Formulir {{ $edit ? 'Edit' : 'Tambah' }} Karyawan</h5>
                <small><em><span style="color: red">*</span>Menandakan kolom wajib diisi atau dipilih.</em></small>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Karyawan<span style="color: red">*</span></label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="Name Input"
                    @if ($edit) value="{{ $employee->name }}" @endif
                    placeholder="Masukkan nama karyawan">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">No. Telepon/HP<span style="color: red">*</span></label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" name="phone" class="form-control" id="phone"
                        @if ($edit) value="{{ $employee->phone }}" @endif placeholder="999999999">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email<span style="color: red">*</span></label>
                <input type="email" name="email" class="form-control" id="email"
                    @if ($edit) value="{{ $employee->email }}" @endif
                    placeholder="karyawan@gmail.com">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal Masuk Karyawan<span style="color: red">*</span></label>
                <div class="input-group">
                    <input type="text" name="date" class="form-control" id="date"
                        @if ($edit) value="{{ $employee->employee_start_date }}" @endif
                        placeholder="yyyy-mm-dd">
                    <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-calendar"></i></span>
                </div>
            </div>
            <div class="d-flex flex-column border-bottom pb-3 mb-3 mt-5">
                <h5 class="m-0">Akun Karyawan</h5>
            </div>
            <div class="mb-3">
                <label for="newusername" class="form-label">Username<span style="color: red">*</span></label>
                <input type="text" name="newusername" class="form-control" id="newusername"
                    @if ($edit) value="{{ $employee->username }}" @endif placeholder="karyawan456">
            </div>
            <div class="mb-3">
                <label for="newpassword" class="form-label">Password @if (!$edit)
                        <span style="color: red">*</span>
                    @endif
                </label>
                <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="*******">
            </div>
            <div class="d-flex align-items-center justify-content-end gap-2 border-top pt-3 mt-3">
                <a href="{{ route('employee.index') }}" class="btn btn-outline-danger">Kembali</a>
                @if ($edit)
                    <button type="submit" class="btn btn-success">Simpan</button>
                @else
                    <button type="submit" class="btn btn-success">Tambah</button>
                @endif

            </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <style>
        form {
            border: 1px solid #E8E2DB;
            border-radius: 5px;
            padding: 10px;
        }
    </style>
@endsection
@section('scripts')
    <script>
        flatpickr.localize(flatpickr.l10ns.id);
        $("#date").flatpickr();
    </script>
@endsection
