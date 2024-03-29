<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function addProduk(Request $request)
    {
        $produk_id = $request->input('produk_id');
        $produk_check = Produk::where('id', $produk_id)->first();

        if (Produk::where('is_active', 1)->where('id', $produk_id)->exists()) {
            if ($produk_check) {
                if (Keranjang::where('prod_id', $produk_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => 'info', 'message' => "Produk $produk_check->name sudah ada di keranjang"]);
                } else {
                    if (Auth::check()) {
                        if (Produk::find($produk_id)) {
                            $keranjang = new Keranjang();
                            $keranjang->prod_id = $produk_id;
                            $keranjang->user_id = Auth::id();
                            $keranjang->save();

                            return response()->json(['status' => 'success', 'message' => "Produk berhasil ditambahkan ke keranjang"]);
                        } else {
                            return response()->json(['status' => 'error', 'message' => "Produk tidak ditemukan"]);
                        }
                    } else {
                        return response()->json(['status' => 'warning', 'message' => "Anda belum login"]);
                    }
                }
            }
        } else {
            return response()->json(['status' => 'error', 'message' => "Produk tidak ditemukan / sudah tidak aktif"]);
        }
    }


    public function cartcount()
    {
        $cartcount = Keranjang::where('user_id', Auth::id())->count();

        return response()->json(['count' => $cartcount]);
    }


    public function cartview()
    {
        $produk = Keranjang::where('user_id', Auth::id())->get();

        return view('frontend.cart.index', compact('produk'));
    }


    public function deleteproduk(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if (Keranjang::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $keranjang = Keranjang::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $keranjang->delete();

                return response()->json(['status' => 'success', 'message' => "Produk berhasil dihapus dari keranjang"]);
            }
        } else {
            return response()->json(['status' => 'success', 'message' => "Login terlebih dahulu"]);
        }
    }


    public function updatecart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if (Auth::check()) {
            if (Keranjang::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cart = Keranjang::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => "Quantity Update"]);
            }
        }
    }
}
