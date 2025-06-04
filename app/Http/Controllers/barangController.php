<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\toko;
use App\Models\kategori;
use App\Models\footer;
use Illuminate\Support\Facades\Storage;

class barangController extends Controller
{
    public function index(Request $request)
    {
        $toko = toko::first();
        $kategori = kategori::get();
        $title = 'Daftar Produk';

        $query = Produk::join('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')->inRandomOrder();

        if ($request->has('cari')) {
            $query->where('produk.nama_produk', 'LIKE', '%' . $request->get('cari') . '%');
        }

        if (isset($_GET['kategori']) && $_GET['kategori'] !== '') {
            $query->where('produk.id_kategori', '=', $request->get('kategori'));
        }

        $barang = $query->paginate(5);

        return view('barang.index', ['title' => $title, 'toko' => $toko, 'barang' => $barang, 'kategori' => $kategori]);
    }

    public function tambah()
    {
        $toko = toko::first();
        $kategori = kategori::get();
        $title = 'Tambah produk';
        return view('barang.tambah', ['title' => $title, 'toko' => $toko, 'kategori' => $kategori]);
    }

    public function plus(Request $r)
    {
        $toko = toko::first();

        $r->validate(
            [
                'nama' => 'required',
                'deskripsi' => 'required',
                'kategori' => 'required',
                'ukuran' => 'required',
                'foto_1' => 'required|image|mimes:jpg,jpeg,png,gif',
                'foto_2' => 'required|image|mimes:jpg,jpeg,png,gif',
                'foto_3' => 'required|image|mimes:jpg,jpeg,png,gif',
                'harga' => 'required'
            ],
            [
                'nama.required' => 'Nama produk harus diisi',
                'deskripsi.required' => 'Deskripsi produk harus diisi',
                'kategori.required' => 'Tolong pilih kategori',
                'ukuran.required' => 'Ukuran produk harus diisi',
                'foto_1.required' => 'Tolong inputkan foto utama',
                'foto_1.image' => 'Yang anda inputkan bukan foto',
                'foto_1.mimes' => 'Yang anda inputkan bukan foto',
                'foto_2.required' => 'Tolong inputkan foto kedua',
                'foto_2.image' => 'Yang anda inputkan bukan foto',
                'foto_2.mimes' => 'Yang anda inputkan bukan foto',
                'foto_3.required' => 'Tolong inputkan foto ketuga',
                'foto_3.image' => 'Yang anda inputkan bukan foto',
                'foto_3.mimes' => 'Yang anda inputkan bukan foto',
                'harga.required' => 'Harga harus diisi'
            ]
        );

        if ($r->hasFile('foto_1')) {
            $foto_1 = $r->file('foto_1');
            $foto_1Name = $foto_1->hashName();
            Storage::disk('public')->putFileAs('foto_barang', $foto_1, $foto_1Name);
        } else {
            $foto_1Name = 'default.png';
        }
        if ($r->hasFile('foto_2')) {
            $foto_2 = $r->file('foto_2');
            $foto_2Name = $foto_2->hashName();
            Storage::disk('public')->putFileAs('foto_barang', $foto_2, $foto_2Name);
        } else {
            $foto_2Name = 'default.png';
        }
        if ($r->hasFile('foto_3')) {
            $foto_3 = $r->file('foto_3');
            $foto_3Name = $foto_3->hashName();
            Storage::disk('public')->putFileAs('foto_barang', $foto_3, $foto_3Name);
        } else {
            $foto_3Name = 'default.png';
        }

        produk::create([
            'toko' => $toko->id_toko,
            'nama_produk' => $r->nama,
            'deskripsi' => $r->deskripsi,
            'foto_1' => $foto_1Name,
            'foto_2' => $foto_2Name,
            'foto_3' => $foto_3Name,
            'id_kategori' => $r->kategori,
            'harga' => $r->harga,
            'ukuran' => $r->ukuran
        ]);


        return redirect('/produk')->with('berhasil', 'Produk berhasil di tambah');
    }

    public function edit($id_barang)
    {
        $kategori = kategori::get();
        $toko = toko::first();
        $barang = produk::findorfail($id_barang);

        $title = 'Ubah data produk';

        return view('barang.ubah', ['toko' => $toko, 'barang' => $barang, 'title' => $title, 'kategori' => $kategori]);
    }

    public function ubah($id_barang, Request $r)
    {
        $toko = toko::first();
        $barang = produk::findorfail($id_barang);

        $r->validate(
            [
                'nama' => 'required',
                'deskripsi' => 'required',
                'kategori' => 'required',
                'ukuran' => 'required',
                'foto_1' => 'image|mimes:jpg,jpeg,png,gif',
                'foto_2' => 'image|mimes:jpg,jpeg,png,gif',
                'foto_3' => 'image|mimes:jpg,jpeg,png,gif',
                'harga' => 'required'
            ],
            [
                'nama.required' => 'Nama produk harus diisi',
                'deskripsi.required' => 'Deskripsi produk harus diisi',
                'kategori.required' => 'Tolong pilih kategori',
                'ukuran.required' => 'Ukuran produk harus diisi',

                'foto_1.image' => 'Yang anda inputkan bukan foto',
                'foto_1.mimes' => 'Yang anda inputkan bukan foto',

                'foto_2.image' => 'Yang anda inputkan bukan foto',
                'foto_2.mimes' => 'Yang anda inputkan bukan foto',

                'foto_3.image' => 'Yang anda inputkan bukan foto',
                'foto_3.mimes' => 'Yang anda inputkan bukan foto',
                'harga.required' => 'Harga harus diisi'
            ]
        );
        if ($r->hasFile('foto_1')) {

            if ($barang->foto_1) {
                Storage::disk('public')->delete('foto_barang/' . $barang->foto_1);
            }

            $foto_1 = $r->file('foto_1');
            $foto_1Name = $foto_1->hashName();
            Storage::disk('public')->putFileAs('foto_barang', $foto_1, $foto_1Name);
        } else {
            $foto_1Name = $barang->foto_1;
        }

        if ($r->hasFile('foto_2')) {

            if ($barang->foto_2) {
                Storage::disk('public')->delete('foto_barang/' . $barang->foto_2);
            }

            $foto_2 = $r->file('foto_2');
            $foto_2Name = $foto_2->hashName();
            Storage::disk('public')->putFileAs('foto_barang', $foto_2, $foto_2Name);
        } else {
            $foto_2Name = $barang->foto_2;
        }

        if ($r->hasFile('foto_3')) {

            if ($barang->foto_3) {
                Storage::disk('public')->delete('foto_barang/' . $barang->foto_3);
            }

            $foto_3 = $r->file('foto_3');
            $foto_3Name = $foto_3->hashName();
            Storage::disk('public')->putFileAs('foto_barang', $foto_3, $foto_3Name);
        } else {
            $foto_3Name = $barang->foto_3;
        }


        $barang->nama_produk = $r->nama;
        $barang->deskripsi = $r->deskripsi;
        $barang->foto_1 = $foto_1Name;
        $barang->foto_2 = $foto_2Name;
        $barang->foto_3 = $foto_3Name;
        $barang->id_kategori = $r->kategori;
        $barang->harga = $r->harga;
        $barang->ukuran = $r->ukuran;
        $barang->save();

        return redirect('/produk')->with('berhasil', 'Data produk berhasil di ubah');
    }

    public function destroy($id)
    {
        $barang = produk::findOrFail($id);

        if ($barang->foto_1) {
            Storage::disk('public')->delete('foto_barang/' . $barang->foto_1);
        }
        if ($barang->foto_2) {
            Storage::disk('public')->delete('foto_barang/' . $barang->foto_2);
        }
        if ($barang->foto_3) {
            Storage::disk('public')->delete('foto_barang/' . $barang->foto_3);
        }


        $barang->delete();

        return redirect()->back()->with('berhasil', 'Barang berhasil dihapus.');
    }

    public function review($id)
    {
        $footer = footer::first();
        $barang = produk::join('toko', 'produk.toko', '=', 'toko.id_toko')->join('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')->findorfail($id);
        $title = $barang->nama_produk;
        $toko = toko::first();
        $kategori = kategori::get();
        $message = str_replace(['${NamaProduk}', '${url}'], [$barang->nama_produk, url()->current()], $toko->pesan);
        $produkLainnya = produk::join('toko', 'produk.toko', '=', 'toko.id_toko')->join('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
            ->where('id_produk', '!=', $barang->id_produk)
            ->orderByRaw("CASE WHEN kategori.kategori = ? THEN 0 ELSE 1 END", [$barang->kategori])
            ->inRandomOrder()
            ->paginate(3);

        return view('barang.review', ['message' => $message, 'title' => $title, 'barang' => $barang, 'footer' => $footer, 'produkLainnya' => $produkLainnya, 'toko' => $toko, 'kategori' => $kategori]);
    }

    public function kategori()
    {
        $title = 'Pengaturan kategori produk';
        $kategori = kategori::get();

        foreach ($kategori as $k) {
            $k->jumlah_produk = produk::where('id_kategori', $k->id_kategori)->count();
        }
        $toko = toko::first();
        return view('kategori.index', ['title' => $title, 'kategori' => $kategori, 'toko' => $toko]);
    }

    public function tambah_kategori()
    {
        $title = 'Tambah kategori produk';
        $kategori = kategori::get();
        $toko = toko::first();
        return view('kategori.tambah', ['title' => $title, 'kategori' => $kategori, 'toko' => $toko]);
    }

    public function plus_kategori(Request $r)
    {
        $r->validate(
            [
                'kategori' => 'required|unique:kategori,kategori',

            ],
            [
                'kategori.required' => "Kategori harus diisi",
                'kategori.unique' => "Kategori " . $r->kategori . " sudah ada",

            ]
        );

        kategori::create([
            'kategori' => $r->kategori,
        ]);

        return redirect('/kategori')->with('berhasil', 'Data kategori berhasil di tambah');
    }

    public function hapus_kategori($id)
    {
        $kategori = kategori::findorfail($id);
        $nama_kategori = $kategori->kategori;
        $kategori->delete();
        return redirect('/kategori')->with('berhasil', 'Data kategori ' . $nama_kategori . ' berhasil di hapus');
    }

    public function edit_kategori($id)
    {
        $title = 'Pengaturan kategori produk';
        $kategori = kategori::findorfail($id);
        $toko = toko::first();
        return view('kategori.ubah', ['title' => $title, 'kategori' => $kategori, 'toko' => $toko]);
    }

    public function ubah_kategori($id, Request $r)
    {
        $kategori = kategori::findorfail($id);
        $r->validate(
            [
                'kategori' => 'required|unique:kategori,kategori,' . $kategori->id_kategori . ',id_kategori',

            ],
            [
                'kategori.required' => "Kategori harus diisi",
                'kategori.unique' => "Kategori " . $r->kategori . " sudah ada",

            ]
        );

        $kategori->kategori = $r->kategori;
        $kategori->save();

        return redirect('/kategori')->with('berhasil', 'Data kategori berhasil di ubah');
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->input('query');
        $suggestions = produk::where('nama_produk', 'LIKE', "%{$query}%")
            ->limit(4)
            ->pluck('nama_produk');

        return response()->json($suggestions);
    }
}
