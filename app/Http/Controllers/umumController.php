<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\produk;
use App\Models\toko;
use App\Models\kategori;
use App\Models\footer;
use App\Models\session;
use App\Models\carousel;

class umumController extends Controller
{

    public function index(Request $request)
    {
        $toko = toko::first();
        $footer = footer::first();
        $kategori = kategori::get();
        $carousel_active = carousel::where('utama', '1')->first();
        $carousel = carousel::where(function ($query) {
            $query->where('utama', '0');
        })->where('status', '1')->get();

        $index_kategori = kategori::inRandomOrder()
            ->limit(6)
            ->get();

        foreach ($index_kategori as $k) {
            $foto_kategori = produk::where('id_kategori', $k->id_kategori)->inRandomOrder()->first();

            if ($foto_kategori) {
                $k->foto = $foto_kategori->foto_1;
            } else {
                $ki->foto = null;
            }
        }

        if (auth()->check()) {
            $admin = User::count();
            $jumlah_produk = produk::count();
            $aktivitas = session::count();
            $jumlah_kategori = kategori::count();
            $title = 'Dashboard admin';
            return view('admin.index', ['title' => $title, 'jumlah_kategori' => $jumlah_kategori, 'toko' => $toko, 'admin' => $admin, 'jumlah_produk' => $jumlah_produk, 'aktivitas' => $aktivitas]);
        }
        $title = $toko->nama_toko;
        $query = Produk::join('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')->inRandomOrder();

        if ($request->has('cari')) {
            $query->where('produk.nama_produk', 'LIKE', '%' . $request->get('cari') . '%');
        }

        if (isset($_GET['kategori']) && $_GET['kategori'] !== '') {
            $query->where('produk.id_kategori', '=', $request->get('kategori'));
        }

        $barang = $query->paginate(9);

        return view('welcome', ['title' => $title, 'barang' => $barang, 'toko' => $toko, 'kategori' => $kategori, 'footer' => $footer, 'index_kategori' => $index_kategori, 'carousel' => $carousel, 'carousel_active' => $carousel_active]);
    }

    public function review_toko($id)
    {
        $kategori = kategori::get();
        $toko = toko::first();
        $footer = footer::first();
        $title = $toko->nama_toko;

        $barang = Produk::where('toko', $toko->id_toko)->paginate(6);
        return view('toko_review', ['title' => $title, 'toko' => $toko, 'barang' => $barang, 'kategori' => $kategori, 'footer' => $footer]);
    }

    public function toko()
    {
        $kategori = kategori::get();
        $toko = toko::first();
        $footer = footer::first();
        if (auth()->check()) {
            $title = 'Pengaturan ' . $toko->nama_toko;
            return view('toko.toko', ['title' => $title, 'toko' => $toko, 'kategori' => $kategori, 'footer' => $footer]);
        } else {
            $title = $toko->nama_toko;
            return view('toko_review', ['title' => $title, 'toko' => $toko, 'kategori' => $kategori, 'footer' => $footer]);
        }
    }
}
