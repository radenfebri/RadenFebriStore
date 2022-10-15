<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super Admin|Admin']);
    }


    public function index()
    {
        $slide = Slide::latest()->get();
        return view('backend.slide.index', compact('slide'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'button_text' => 'required|min:3|max:20',
            'status' => 'required',
        ]);


        $imageName = date(now()->format('d-m-Y-H-i-s')) . '_' . $request->file('image')->getClientOriginalName();
        $image = $request->file('image')->storeAs('image-slider', $imageName);
        Slide::create([
            'title1' => $request->title1,
            'title2' => $request->title2,
            'title3' => $request->title3,
            'link' => $request->link,
            'image' => $image,
            'button_text' => $request->button_text,
            'status' => $request->status == TRUE ? '1' : '0',
        ]);

        toast('Nomor Rekening Berhasil Ditambahkan', 'success');
        return back();
    }
}
