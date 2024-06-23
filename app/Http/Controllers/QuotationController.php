<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use App\Http\Controllers\AuthController;

use App\Http\Requests\SaveQuotationRequest;


class QuotationController extends Controller
{

    public function showForm()
    {
        return view('form');
    }

    public function submitForm(SaveQuotationRequest $request)
    {
        $auth = new AuthController();
        $token = $auth->getBearerToken();
        if (!$token) {
            return back()->withErrors([
                'error' => 'Unable to authenticate.'
            ]);
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ])->post('http://nginx/api/quotation/save', [
            'age' => $request->age,
            'currency_id' => $request->currency_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        if (!$response->successful()) {
            return back()->withErrors([
                'error' => 'Unable to get quotation. Please try again.'
            ]);
        }

        $quotation = $response->json();
        return view('form', ['quotation' => $quotation]);
    }
}