<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Payment;
use App\Models\MasterPayment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home(Request $request)
    {
        $getUser = $request->user()->id;
        $getpaymentRental = Payment::with('rental')->with('masterpayment');

        $newRental = Rental::with('product')
            ->where('user_id', $getUser)
            ->where('status', 'NEW')
            ->get();
        $waitingPayment = Rental::with('product')
            ->where('user_id', $getUser)
            ->where('status', 'WAITING_PAYMENT')
            ->get();
        $waitingConfirm = Rental::with('product')
            ->where('user_id', $getUser)
            ->where('status', 'WAITING_PAYMENT_CONFIRM')
            ->get();
        $paymentNew = Payment::with('rental')
            ->with('masterpayment')
            ->where('bukti_pembayaran', NULL)
            ->get();
        $paymentNotNew = Payment::with('rental')
            ->with('masterpayment')
            ->where('bukti_pembayaran')
            ->get();
        $onRental = Rental::with('product')
            ->where('user_id', $getUser)
            ->where('status', 'ON_RENTAL')
            ->get();
        $waitingPengembalian = Rental::with('product')
            ->where('user_id', $getUser)
            ->where('status', 'WAITING_PENGEMBALIAN')
            ->get();
        $waitingReturnConf = Rental::with('product')
            ->where('user_id', $getUser)
            ->where('status', 'WAITING_PENGEMBALIAN_CONFIRMED')
            ->get();


        return view('user.home', compact(
            'newRental',
            'waitingPayment',
            'waitingConfirm',
            'onRental',
            'waitingPengembalian',
            'paymentNew',
            'paymentNotNew',
            'waitingReturnConf'
        ));
    }

    public function showHistory(Request $request)
    {

        $getUser = $request->user()->id;
        $getpaymentRental = Payment::with('rental')->with('masterpayment');

        $done = Rental::with('product')
            ->where('user_id', $getUser)
            ->where('status', 'DONE')
            ->get();

        return view('user.rental.history', compact('done'));
    }
}
