<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\MultiImage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;
use App\Models\Rating;
use App\Models\Slide;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Output\Output;

use function GuzzleHttp\Promise\all;

class LandingController extends Controller
{
    public function index()
    {
        $kategoriproduk = KategoriProduk::latest()->where('popular', 1)->where('is_active', 1)->get();
        $produks = Produk::latest()->where('is_active', 1)->limit(6)->get();
        $popular = Produk::latest()->where('popular', 1)->where('is_active', 1)->get();
        $ratings = Rating::all();
        $slider = Slide::where('status', 1)->latest()->get();
        $pengunjung = Visitor::latest()->paginate(10);
        Visitor::increment('visitors');

        return view('frontend.landing', compact('kategoriproduk', 'produks', 'popular', 'ratings', 'slider'));
    }


    public function detail($slug)
    {
        if (Produk::where('slug', $slug)->exists()) {
            $produk = Produk::where('slug', $slug)->first();
            $populer = Produk::where('popular', 1)->limit(4)->latest()->get();
            $kategoriproduk = KategoriProduk::all();
            $images = MultiImage::where('prod_id', $produk->id)->get();
            $ratings = Rating::where('prod_id', $produk->id)->get();
            $rating_sum = Rating::where('prod_id', $produk->id)->sum('stars_rated');
            $user_rating = Rating::where('prod_id', $produk->id)->where('user_id', Auth::id())->first();
            $cek_user = Order::where('orders.user_id', Auth::id())->where('orders.status', '1')
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.prod_id', $produk->id)->get();

            if ($ratings->count() > 0) {
                $rating_avg = $rating_sum / $ratings->count();
            } else {
                $rating_avg = 0;
            }

            return view('frontend.shop.detail', compact('produk', 'ratings', 'cek_user', 'kategoriproduk', 'images', 'populer', 'rating_avg', 'user_rating'));
        } else {
            return back();
        }
    }


    public function detailkategori($slug)
    {
        if (KategoriProduk::where('slug', $slug)->exists()) {
            $kategoriproduk = KategoriProduk::where('slug', $slug)->first();
            $populer = Produk::where('popular', 1)->limit(4)->latest()->get();
            $produk = Produk::where('kategori_id', $kategoriproduk->id)->latest()->paginate(20);
            $ratings = Rating::all();

            return view('frontend.shop.detail-kategori', compact('kategoriproduk', 'populer', 'produk', 'ratings'));
        } else {
            return back();
        }
    }


    public function semuaproduk(Request $request)
    {
        if (Produk::where('is_active', 1)->exists()) {
            $keyword = $request->keyword;
            $kategoriproduk = KategoriProduk::where('is_active', 1)->latest()->get();
            $produks = Produk::latest()->where('is_active', 1)
                ->where('name', 'LIKE', '%' . $keyword . '%')
                ->orwhere('small_description', 'LIKE', '%' . $keyword . '%')
                ->paginate(20);
            $allproduk = Produk::where('is_active', 1)->latest()->get();
            $ratings = Rating::all();

            return view('frontend.shop.index', compact('produks', 'kategoriproduk', 'allproduk', 'keyword', 'ratings'));
        } else {
            return back();
        }
    }



    public function semuakategori(Request $request)
    {
        if (KategoriProduk::where('is_active', 1)->exists()) {
            $keyword = $request->keyword;

            $kategoriproduk = KategoriProduk::where('is_active', 1)
                ->where('name', 'LIKE', '%' . $keyword . '%')
                ->orwhere('description', 'LIKE', '%' . $keyword . '%')
                ->latest()->paginate(20);

            $allkategori = KategoriProduk::where('is_active', 1)->latest()->get();
            return view('frontend.shop.kategori', compact('kategoriproduk', 'keyword', 'allkategori'));
        } else {
            return back();
        }
    }



    public function search()
    {
        $produk = Produk::select('name')->where('is_active', 1)->get();
        $data = [];

        foreach ($produk as $item) {
            $data[] = $item['name'];
        }

        return $data;
    }



    public function searchproduk(Request $request)
    {
        $search_produk = $request->produk_name;

        if ($search_produk != "") {
            $produk = Produk::where("name", "LIKE", "%$search_produk%")->first();
            if ($produk) {
                return redirect('detail-produk/' . $produk->slug);
            } else {
                return back()->with('error', 'Produk Tidak dapat Ditemukan');
            }
        } else {
            return back()->with('error', 'Produk Tidak dapat Ditemukan');
        }
    }



    public function settingprofile()
    {
        return view('frontend.setting.index');
    }



    public function updatepassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('error', 'Password lama tidak sesuai');
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('status', 'Password berhasil diubah');
    }



    public function updatedata(Request $request)
    {
        $request->validate([
            'email' => 'required|email|min:3|max:191|string|unique:users,email,' . auth()->user()->id,
            'name' => 'required|min:3|max:191|string',
            'no_hp' => 'required|min:10|max:30|string',
        ]);


        if ($request->email != auth()->user()->email) {
            User::whereId(auth()->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                $request->email == auth()->user()->email ? '' : 'email_verified_at' => null,
            ]);
        } else {
            User::whereId(auth()->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
            ]);
        }

        return back()->with('status', 'Data berhasil diubah');
    }
}
