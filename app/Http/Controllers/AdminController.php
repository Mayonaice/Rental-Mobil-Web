<?php

namespace App\Http\Controllers;

use App\Models\MasterPayment;
use App\Models\Rental;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function payShowAdmin(Request $request)
    {
        $getUser = $request->user()->id;
        $getPayment = Payment::with('rental')->with('masterpayment')->get();

        return view('admin.show-payment.show-payment-index', compact('getUser', 'getPayment'));
    }

    public function confirmPay($payment)
    {
        $dataid = Payment::FindOrFail($payment);
        $idpayment = $dataid->id;
        $status = [
            'status' => 'CONFIRMED'
        ];
        $status_rental = [
            'status' => 'ON_RENTAL'
        ];

        $updated = DB::table('payments')->where('id', $idpayment)->update($status);

        if ($updated) {
            DB::table('rentals')->where('id', $dataid->rental_id)->update($status_rental);
        }

        return redirect()->route('showpayment.index');
    }

    public function showConfirmReturn (Request $request) {

        $getUser = $request->user()->id;
        $getReturn = Rental::with('user')->with('product')->get();

        return view('admin.show-rental.confirm-pengembalian', compact('getUser', 'getReturn'));
    }

    public function confirmReturn ($return) {
        $dataid = Rental::FindOrFail($return);
        $idreturn = $dataid->id;
        $status = [
            'status' => 'DONE'
        ];

        $updated = DB::table('rentals')->where('id', $idreturn)->update($status);

        return redirect()->route('confirmReturn.index');
    }

    public function adminDecline(Payment $payment) {}

    public function historyRental (Rental $rental) {
        $done = Rental::with('product')
            ->where('status', 'DONE')
            ->get();
        
        return view('admin.show-rental.history-rental', compact('done'));
    }
}
