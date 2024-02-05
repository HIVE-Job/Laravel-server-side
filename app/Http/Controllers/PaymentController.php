<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Order;
use App\User;
use Notification;
use Helper;
use PDF;  

class PaymentController extends Controller
{
    public function payment()
    {
         
        $userName = auth()->user()->name;

         
        $bankDetails = Bank::where('user_id', auth()->user()->id)->first();

         
        $lastOrder = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();
        $totalAmountToBePaid = $lastOrder->total_amount;  

        return view('frontend.pages.payment', compact('userName', 'bankDetails', 'totalAmountToBePaid'));
    }


    public function paymentSuccess(Request $request){
   
        return view('frontend.pages.payment');
    }

    

public function processPayment()
{
    $userBank = Bank::where('user_id', auth()->user()->id)->first();
    $lastOrder = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();
    $totalAmountToBePaid = $lastOrder->total_amount;

    if ($userBank->amount >= $totalAmountToBePaid) {
        $userBank->decrement('amount', $totalAmountToBePaid);

        $lastOrder->update([
            'payment_status' => 'paid',
        ]);

       
        $pdf = PDF::loadView('pdf.invoice', ['userBank' => $userBank, 'lastOrder' => $lastOrder]);
        $pdf->save(storage_path().'_filename.pdf');

        return redirect()->route('payment')->with('success', 'Payment successful!');
    } else {
        return redirect()->route('payment')->with('error', 'Insufficient funds. Payment failed.');
    }
}


}
