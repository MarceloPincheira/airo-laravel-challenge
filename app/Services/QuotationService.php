<?php

namespace App\Services;

use App\Models\Quotation;
use Carbon\Carbon;


class QuotationService
{
    private function getAgeLoad($age)
    {
        switch (true) {
            case ($age >= 18 && $age <= 30):
                return 0.6;
            case ($age >= 31 && $age <= 40):
                return 0.7;
            case ($age >= 41 && $age <= 50):
                return 0.8;
            case ($age >= 51 && $age <= 60):
                return 0.9;
            case ($age >= 61 && $age <= 70):
                return 1.0;
            default:
                return null;
        }
    }


    private function totalAmountAgeLoad($age, $start_date, $end_date)
    {
        $fixed_rate = 3;
        $start_date = Carbon::parse($start_date);
        $end_date = Carbon::parse($end_date);
        $trip_length = $start_date->diffInDays($end_date) + 1;

        $totalAmountAgeLoad = $fixed_rate * $this->getAgeLoad($age) * $trip_length;

        return $totalAmountAgeLoad;
    }


    private function createQuotationInstance(array $data): Quotation
    {

        $quotation = new Quotation();

        $total = 0;
        $ages = explode(',', $data['age']);

        $quotation->age = $data['age'];
        $quotation->currency_id = $data['currency_id'];
        $quotation->start_date = Carbon::parse($data['start_date']);
        $quotation->end_date = Carbon::parse($data['end_date']);

        foreach ($ages as $age) {
            $age = (int)$age;

            $ageLoad = $this->totalAmountAgeLoad(
                $age,
                $quotation->start_date,
                $quotation->end_date
            );

            if ($ageLoad === null) {
                return response()->json([
                    'error' => 'The age provided is invalid'
                ], 400);
            }

            $total += $ageLoad;
        }

        $quotation->total = $total;

        return $quotation;
    }

    public function createQuotation(array $data): Quotation
    {
        $quotation = $this->createQuotationInstance($data);
        $quotation->save();

        return $quotation;
    }

    public function getAllQuotations()
    {
        return Quotation::all();
    }
}