<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Redirect;

class UserProductController extends Controller
{
    public function mobil()
    {
        $mobil = Product::with('category')->get();
        return view('user.mobil', compact('mobil'));
    }

    public function reqMethod(Request $request)
    {
        $reqId = $request->session()->get('user_id');
        return view('user.mobil', $reqId);
    }

    
}
