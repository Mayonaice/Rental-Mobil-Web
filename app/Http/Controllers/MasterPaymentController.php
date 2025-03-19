<?php

namespace App\Http\Controllers;

use App\Models\MasterPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class MasterPaymentController extends Controller
{
    public function index()
    {
        $mspayment = MasterPayment::all();
        return view('admin.masterPayment.index', compact('mspayment'));
    }

    public function create()
    {
        return view('admin.masterPayment.create');
    }
    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'tipe_payment' => 'required',
            'nama_akun' => 'required|string|max:255',
            'no_rek' => 'nullable|string|max:128',
            'no_hp' => 'nullable|string|max:128',
            'qrcode' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('qrcode')) {
            $imagePath = $request->file('qrcode')->store('mspayment', 'public');
        }

        MasterPayment::create([
            'tipe_payment' => $request->tipe_payment,
            'nama_akun' => $request->nama_akun,
            'no_rek' => $request->no_rek,
            'no_hp' => $request->no_hp,
            'qrcode' => $imagePath,
        ]);

        return redirect()->route('masterPayment.index');
    }

    public function edit(MasterPayment $masterPayment)
    {
        return view('admin.masterPayment.edit', compact('masterPayment'));
    }

    public function update(Request $request, MasterPayment $masterPayment)
    {
        $request->validate([
            'tipe_payment' => 'required',
            'nama_akun' => 'required|string|max:255',
            'no_rek' => 'nullable|string|max:128',
            'no_hp' => 'nullable|string|max:128',
            'qrcode' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $masterPayment->qrcode;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::exists('public/' . $imagePath)) {
                Storage::delete('public/' . $imagePath);
            }

            $imagePath = $request->file('image')->store('masterPayment', 'public');
        }

        if ($masterPayment->no_rek != NULL){
            if ($request->filled('no_hp')) {
                $masterPayment->update([
                    'no_rek' => NULL,
                    'no_hp' => $request->no_hp,
                ]);
            } elseif ($request->filled('no_rek')) {
                $masterPayment->update([
                    'no_rek' => $request->no_rek,
                ]);
            }
        } elseif ($masterPayment->no_hp != NULL){
            if ($request->filled('no_rek')) {
                $masterPayment->update([
                    'no_hp' => NULL,
                    'no_rek' => $request->no_rek,
                ]);
            } elseif ($request->filled('no_hp')) {
                $masterPayment->update([
                    'no_hp' => $request->no_hp,
                ]);
            }
        } else {
            $masterPayment->update([
                'no_hp' => $request->no_hp,
                'no_rek' => $request->no_rek,
            ]);
        }

        $masterPayment->update([
           'tipe_payment' => $request->tipe_payment,
            'nama_akun' => $request->nama_akun,
            'qrcode' => $imagePath,
        ]);

        return redirect()->route('masterPayment.index');
    }

    public function destroy(MasterPayment $masterPayment)
    {
        // $mspDel = $mspayment->$msp;

        // Delete image if exists
        if ($masterPayment->qrcode && Storage::exists('public/' . $masterPayment->qrcode)) {
            Storage::delete('public/' . $masterPayment->qrcode);
        }

        $masterPayment->delete();
        return redirect()->route('masterPayment.index');
    }
}
