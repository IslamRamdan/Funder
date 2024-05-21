<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function all()
    {
        $payments = Payment::all();
        return response()->json([
            'success' => true,
            'payments' => $payments
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'bank' => 'required',
            'account_number' => 'required',
        ]);

        $payment = new Payment();
        $payment->title = $request->title;
        $payment->description = $request->description;
        $payment->bank = $request->bank;
        $payment->account_number = $request->account_number;
        $payment->save();
        return response()->json([
            'success' => true,
            'message' => 'payment created successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'bank' => 'required',
            'account_number' => 'required',
        ]);

        $payment = Payment::find($id);
        $payment->title = $request->title;
        $payment->description = $request->description;
        $payment->bank = $request->bank;
        $payment->account_number = $request->account_number;
        $payment->save();
        return response()->json([
            'success' => true,
            'message' => 'payment updated successfully'
        ]);
    }
    public function delete( $id)
    {
        $payment = Payment::find($id);
        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'payment deleted successfully'
        ]);
    }
}
