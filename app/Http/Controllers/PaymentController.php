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

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = Payment::with('rental')->get();
        return view('admin.payment-paid', compact('payment-paid'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rentalId)
    {
        $mspayment = MasterPayment::all();
        $rental = Rental::findOrfail($rentalId);
        return view('user.rental.payment', compact('rental', 'mspayment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'rental_id'  => 'required|exists:rentals,id',
            'master_payment_id' => 'required|exists:master_payments,id',
            'nama_akun' => 'required|string|max:255',
            'no_rek' => 'nullable',
            'no_hp' => 'nullable',
            'status' => 'required',
            'status_rental' => 'required'
        ]);

        $status_rental = Rental::where('status', 'NEW')->where('id', $request->rental_id); 
        if ($status_rental) {
            $status_rental->update([
                'status' => $request->status_rental,
            ]);
        }

        Payment::create([
            'rental_id' => $request->rental_id,
            'master_payment_id' => $request->master_payment_id,
            'nama_akun' => $request->nama_akun,
            'no_rek' => $request->no_rek,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
        ]);

        return Redirect::route('user.home')->with('success', 'Payment created successfully!');
    }

    public function showPay($b)
    {
        $paymentid = Payment::withoutGlobalScopes()->FindOrFail($b);
        $masterPayment = MasterPayment::all()->where('id', $paymentid->master_payment_id);
        $rental = Rental::all();
        return view('user.rental.pay', compact('paymentid','masterPayment', 'rental'));
    }

    public function pay(Request $request, $paymentid) {

        $payment = Payment::FindOrFail($paymentid);

        $request->validate([
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'status_rental' => 'required',
        ]);

        $imagePath = $payment->bukti_pembayaran;
        if ($request->hasFile('bukti_pembayaran')) {
            if ($imagePath && Storage::exists('public/' . $imagePath)) {
                Storage::delete('public/' . $imagePath);
            }

            $imagePath = $request->file('bukti_pembayaran')->store('payments', 'public');
        }

        $status_rental = Rental::where('status', 'WAITING_PAYMENT')->where('id', $payment->rental_id); 
        if ($status_rental) {
            $status_rental->update([
                'status' => $request->status_rental,
            ]);
        }

         $payment->update([
            'bukti_pembayaran' => $imagePath,
            'status' => $request->status,
        ]);

        

        return redirect()->route('user.home');
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
