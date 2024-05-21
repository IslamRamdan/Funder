<?php

namespace App\Http\Controllers;

use App\Models\Funder;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    // get wallet details
    public function wallet()
    {
        $user = auth()->user();
        $receipts = $user->receipts;
        $receipt_not_rejected = $receipts->where('status', '!=', 'rejected');

        // my investment
        $investment = 0;
        foreach ($receipt_not_rejected as $receipt) {
            $sheres_count = $receipt->count_sheres;
            $property = Property::find($receipt->property_id);
            $receipt_price = $property->property_price * $sheres_count;
            $investment += $receipt_price;
        }

        // deposit
        $receipt_pending = $receipts->where('status', 'pending');
        $deposit = 0;
        foreach ($receipt_pending as $receipt) {
            $sheres_count = $receipt->count_sheres;
            $property = Property::find($receipt->property_id);
            $receipt_price = $property->property_price * $sheres_count;
            $deposit += $receipt_price;
        }

        // number of properties
        $properties =  $this->getPropOfFunders('', $user);
        
        // monthly income
        $monthly_income=0;
        $properties_of_monthly_income =  $this->getPropOfFunders('funder', $user);

        foreach ($properties_of_monthly_income as $prop) {
            if ($prop->approved != null) {
                $count_shere = Funder::where(['status'=>'funder', 'user_id'=>$user->id, 'property_id'=> $prop->id])->count();

                $monthly_income += (intval($prop->current_rent) * $count_shere);
            }
        }

        // annual gross yield
        $total_percent =0;
        $length  = 0;
        foreach ($properties_of_monthly_income as $prop) {
            $total_percent += $prop->percent;
            $length +=1;
        }

        if (count($properties_of_monthly_income) != 0) {
            $annual_gross_yield = $total_percent / count($properties_of_monthly_income);
        }else {
            $annual_gross_yield=0;
        };

        return response()->json([
            'receipts' => $receipts->count(),
            'my_investments' => $investment,
            'deposit' => $deposit,
            'number_of_properties' => count($properties),
            'monthly_income' => $monthly_income,
            'annual_gross_yield' => $annual_gross_yield
        ]);
    }

    public function propOfSheres()
    {
        $user = auth()->user();
        $properties =  $this->getPropOfFunders('', $user);

        $receipts = $user->receipts->where('status', 'pending');
        $properties_panding = [];
        foreach ($receipts as $receipt) {
            array_push($properties_panding, $receipt->property);
        }
        $allProperty = array_unique($properties_panding);
        $arr = [...$allProperty];

        return response()->json([
            'properties' => $properties,
            'properties_panding' => $arr
        ]);
    }

    private function getPropOfFunders($status, $user)
    {
        if ($status ==  '') {
            $funders = $user->funders;
        } else {
            $funders = $user->funders->where('status', $status);
        }

        $properties = [];
        foreach ($funders as $funder) {
            $property = $funder->property;
            array_push($properties, $property);
        }
        $allProperty = array_unique($properties);
        $arr = [...$allProperty];

        return $arr;
    }
}
