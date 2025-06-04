<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\carousel;
use App\Models\toko;
use Illuminate\Support\Facades\Storage;

class carouselController extends Controller
{
    public function index()
    {
        $title = 'Edit carousel';
        $toko = toko::first();
        $carousel = carousel::get();
        return view('carousel.index', ['title' => $title, 'carousel' => $carousel, 'toko' => $toko]);
    }

    public function updateCarousel(Request $request)
    {
        $carousel = carousel::all();

        foreach ($carousel as $index => $c) {

            if ($request->hasFile('foto_' . $index)) {
                $file = $request->file('foto_' . $index);
                $filename = $file->hashName();
                $file->storeAs('public/carousel', $filename);


                if ($c->foto && Storage::exists('public/carousel/' . $c->foto)) {
                    Storage::delete('public/carousel/' . $c->foto);
                }

                $c->foto = $filename;
            }


            $c->utama = $request->input('utama') == $index ? '1' : '0';
            $c->status = $request->input('status_' . $index) ? '1' : '0';


            $c->save();
        }

        return redirect()->back()->with('berhasil', 'Carousel berhasil diubah!');
    }
}
