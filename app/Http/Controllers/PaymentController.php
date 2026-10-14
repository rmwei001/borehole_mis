<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
     public function createPayment(Request $request)
    {
        $validated = $request->validate([
            'record_date' => 'required|date',
            'amount' => 'required|numeric',
            'narration' => 'required|string',
            'plot_id' => 'required|integer|exists:plots,id',
        ]);

        $payment = new Payment();
        $payment->record_date = $validated['record_date'];
        $payment->amount = $validated['amount'];
        $payment->narration = $validated['narration'];
        $payment->plot_id = $validated['plot_id'];

        try{
            $payment->save();
            return response()->json([
                'message' => 'Payment saved successfully',
                'payment'=>$payment
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Failed to save',
                'error'=>$e->getMessage()
            ], 500);
        }
    }

    public function readAllPayments()
    {
        try {
            $payments = Payment::all();

            return response()->json([
                'payments' => $payments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error trying to fetch.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function readPayment($id)
    {
        try {
            $payment = Payment::where('id', $id)->first();

            return response()->json([
                'payment' => $payment,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error trying to fetch.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function updatePayment($id, Request $request){
        
        $validated = $request->validate([
            'record_date' => 'required|date',
            'amount' => 'required|numeric',
            'narration' => 'required|string',
            'plot_id' => 'required|integer|exists:plots,id',
        ]);

        $payment = Payment::where('id', $id)->first();
        $payment->record_date = $validated ['record_date'];
        $payment->amount = $validated ['amount'];
        $payment->narration = $validated ['narration'];
        $payment->plot_id = $validated ['plot_id'];

        try{
            $payment->save();
            return response()->json([
                'message' => 'Payment updated successfully',
                'payment'=>$payment
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Failed to update',
                'error'=>$e->getMessage()
            ], 500);
        }               
    }
     public function deletePayment($id){
        try{
            $payment = Payment::where('id', $id)->first();

            if(!$payment){
                return response()->json("Record does not exist");
            }

            $payment->delete();
            return response()->json("Plot deleted successfully");
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Failed to delete',
                'error'=>$e->getMessage()
            ], 500);
        }
    }

     public function searchPayment($name){
        try{
            $payment = Payment::where('name', 'LIKE', "%{name}%")->get();
            return response()->json([
                $payment], 200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error trying to fetch.', 
                'error' => $e->getMessage()], 500);
        }
    }
}
