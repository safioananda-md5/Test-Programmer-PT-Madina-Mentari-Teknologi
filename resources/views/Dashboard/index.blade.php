@extends('Layouts.main')
@push('title')
    Dashboard
@endpush
@section('css')
    <style>
        .custom-card {
            border-left: 5px solid;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between px-3 mb-3">
                <h4>Dashboard</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row px-3">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card border-success custom-card">
                        <div class="card-body">
                            <p class="card-text">Total Tagihan</p>
                            <h5 class="card-title">{{ 'Rp ' . number_format($TotalBill['0']['BILLAM'], 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card border-warning custom-card mt-0 mt-lg-0 mt-3">
                        <div class="card-body">
                            <p class="card-text">Total Potongan</p>
                            <h5 class="card-title">{{ 'Rp ' . number_format($TotalBill['0']['POTONGAN'], 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="responsive-table">
                <div class="d-flex align-items-center justify-content-between my-3 border-bottom pb-3">
                    <h5>Data Tagihan</h5>
                </div>
                <table class="table table-striped table-hover" id="billingTable">
                    <thead>
                        <tr>
                            <th class="text-center">Id Tagihan</th>
                            <th>Nama Tagihan</th>
                            <th class="text-center">Jumlah Tagihan</th>
                            <th class="text-center">Potongan</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($billing as $bill)
                            <tr>
                                <td class="text-center">{{ $bill['id_bill'] }}</td>
                                <td>{{ $bill['BILLNM'] }}</td>
                                <td class="text-center">{{ 'Rp ' . number_format($bill['BILLAM'], 0, ',', '.') }}</td>
                                <td class="text-center">{{ 'Rp ' . number_format($bill['POTONGAN'], 0, ',', '.') }}</td>
                                <td class="text-center">{{ 'Rp ' . number_format($bill['TOTAL'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#billingTable').DataTable({
            scrollX: true
        });
    </script>
@endsection
