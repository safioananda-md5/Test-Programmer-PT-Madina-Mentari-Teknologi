@extends('Layouts.main')
@push('title')
    Employee
@endpush
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between px-3 mb-3">
                <h4>Employee</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Employee</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row px-3">
            <div class="responsive-table">
                <div class="d-flex align-items-center justify-content-between my-3 border-bottom pb-3">
                    <h5>Data Karyawan</h5>
                    <a href="{{ route('employee.add') }}" class="btn btn-primary">Tambah Karyawan</a>
                </div>
                <table class="table table-striped table-hover" id="employeeTable">
                    <thead>
                        <tr>
                            <th class="text-center">Nama</th>
                            <th class="text-center">No. HP</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Tanggal Masuk</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $EP)
                            <tr>
                                <td class="text-center">{{ $EP->name }}</td>
                                <td class="text-center">+62{{ $EP->phone }}</td>
                                <td class="text-center">{{ $EP->email }}</td>
                                <td class="text-center">
                                    @php
                                        Carbon\Carbon::setlocale('id');
                                    @endphp
                                    {{ Carbon\Carbon::parse($EP->date)->translatedFormat('d F Y') }}
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('employee.edit', Crypt::encrypt($EP->id)) }}">Edit</a>
                                            </li>
                                            <li><button type="button" class="dropdown-item"
                                                    onclick="deleteK('{{ $EP->id }}')">Delete</button></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id">
        </form>
    </div>
@endsection
@section('css')
    <style>
        .responsive-table {
            border: 1px solid #E8E2DB;
            border-radius: 5px;
        }

        .dt-length label {
            margin-left: 10px;
        }
    </style>
@endsection
@section('scripts')
    <script>
        $('#employeeTable').DataTable({
            columnDefs: [{
                targets: [4],
                orderable: false,
                searchable: false,
            }]
        });

        function deleteK(id) {
            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                confirmButtonText: "Iya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm').attr('action', '{{ route('employee.delete') }}');
                    $('#deleteForm').find('input[name="id"]').val(id);
                    $('#deleteForm').submit();
                }
            });
        }
    </script>
@endsection
