<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $Auth = session()->get('_login');
        if ($Auth['role'] == 'student') {
            $response = Http::get('https://developers.madinapay.id/tagihan?id_cust=' . $Auth['id'] . '&api_key=' . env('API_KEY'))->json();
            $billing = $response['data'];
            $response2 = Http::get('https://developers.madinapay.id/tagihan/sum_tagihan?id_cust=' . $Auth['id'] . '&api_key=' . env('API_KEY'))->json();
            $TotalBill = $response2['data'];
        } else {
            $billing = null;
            $TotalBill = null;
        }
        return view('Dashboard.index', compact(['billing', 'TotalBill']));
    }
}
