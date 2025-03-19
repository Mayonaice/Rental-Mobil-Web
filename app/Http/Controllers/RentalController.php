<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Product;
use App\Models\User;
use App\Models\Session;
use App\Models\Payment;
use App\Models\Category;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;


class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rental = Rental::with('user', 'product', 'payment')->get();
        return view('user.rental.rental', compact('rental'));
    }

    public function showRental(Request $request) {
       
        $getUser = $request->user()->id;

        $getNewRentalbyUser = Rental::with('product')->where('user_id', $getUser)->get();
        return view('user.showRent', compact(
         'getNewRentalbyUser'
        ));
    }

    public function create(Product $product, $m, Request $request, string $id)
    {

        // $getMobil = Product::findOrfail($m);
        // $user = User::all();
        // $today = date('Y-m-d');

        // $value = $request->session()->get('key', function() {
        //     return 'default';
        // });
        // $user = $value->users->find($id);

        // return view('user.rental.rental-create', compact('user', 'getMobil'), ['defaultDate' => $today], ['user' => $user]);
    }

    public function getMobil(Request $request, Product $product, $m)
    {
        $getMobil = Product::findOrfail($m);
        $today = date('Y-m-d');

        $user = $request->user();

        return view('user.rental.rental-create', compact('getMobil', 'user'), ['defaultDate' => $today]);
    }

     function store(Request $request): RedirectResponse
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'status' => 'required',
            'waktu_pinjam' => 'required|date|after_or_equal:today',
            'waktu_pengembalian' => 'required|date|after:waktu_pinjam',
            'total_harga' => 'required',
        ]);


        $rentalData =
        Rental::create([
            'user_id'  => $request->user_id,
            'product_id' => $request->product_id,
            'status' => $request->status,
            'waktu_pinjam' => $request->waktu_pinjam,
            'waktu_pengembalian' => $request->waktu_pengembalian,
            'total_harga' => $request->total_harga,
        ]);

        return Redirect::route('rental.payment', ['rentalId' => $rentalData->id])->with('success', 'Silahkan lanjut ke pembayaran!');;
    }

    // public function edit(Product $product)
    // {
    //     $categories = Category::all();
    //     return view('admin.products.edit', compact('product', 'categories'));
    // }

    public function update(Request $request, Rental $rental)
    {
        $rental->validate([
            'user_id'  => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'waktu_pinjam' => 'date|required',
            'waktu_pengembalian' => 'date|required',
            'total_harga' => 'required',
        ]);

        $rental->update([
            'nama_mobil' => $request->nama_mobil,
            'category_id' => $request->category_id,
            'tahun' => $request->tahun,
            'harga_sewa' => $request->harga_sewa,
        ]);

        // return redirect()->route('products.index');
    }

    public function getReturn(Request $request, $rental)
    {
        $getReturn = Rental::with('product')->with('user')->findOrfail($rental);
        $user = $request->user();

        return view('user.rental.rental-return', compact('getReturn', 'user'));
    }

    public function returnRental(Request $request, $getReturn) {
        $returnProduct = Rental::with('product')->with('user')->findOrfail($getReturn);

        $request->validate([
            'status' => 'required',
            'bukti_pengembalian' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('bukti_pengembalian')) {
            $imagePath = $request->file('bukti_pengembalian')->store('pengembalian', 'public');
        }

        $returnProduct->update([
            'status' => $request->status,
            'bukti_pengembalian' => $imagePath,
        ]);

        return Redirect::route('user.home');
        
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->route('rental');
    }

    public function update_status1(Rental $rental)
    {
        $rental->update([
            'status' => 'waiting_payment'
        ]);
    }

    public function update_status2(Rental $rental)
    {
        $rental->update([
            'status' => 'on_rental'
        ]);
    }

    public function update_status3(Rental $rental)
    {
        $rental->update([
            'status' => 'waiting_pengembalian'
        ]);
    }
}
