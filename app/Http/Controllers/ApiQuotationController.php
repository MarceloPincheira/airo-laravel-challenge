<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuotationService;

use App\Http\Requests\SaveQuotationRequest;

class ApiQuotationController extends Controller
{
    protected $quotationService;

    public function __construct(QuotationService $quotationService)
    {
        $this->quotationService = $quotationService;
        $this->middleware('auth:api');
    }

    public function saveQuotation(SaveQuotationRequest $request)
    {
        $data = $request->validated();
        $quotation = $this->quotationService->createQuotation($data);

        return response()->json([
            'message' => 'Quotation created successfully',
            'quotation' =>  [
                'total' => $quotation->total,
                'currency_id' => $quotation->currency_id,
                'quotation_id' => $quotation->id,
            ]], 201);
    }

    public function getAllQuotations()
    {
        $quotations = $this->quotationService->getAllQuotations();
        return $quotations;
    }
}