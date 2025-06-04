<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\kategori;
use App\Models\toko;
use App\Models\session;
use App\Models\footer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{

    public function login()
    {
        $title = 'Login Admin';
        $kategori = kategori::get();
        $footer = footer::first();
        $toko = toko::first();
        return view('admin.login', ['title' => $title, 'toko' => $toko, 'kategori' => $kategori, 'footer' => $footer]);
    }

    public function logins(Request $r)
    {
        $r->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi'
        ]);

        $credentials = [
            'username' => $r->username,
            'password' => $r->password
        ];

        $remember = $r->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            return redirect('/')->with('login', 'Selamat Datang');
        }
        return redirect()->back()->withInput()->with('gagal', 'Username atau Password salah');
    }

    public function editToko()
    {
        $toko = toko::first();
        $title = 'Ubah data toko';
        return view('toko.ubah_toko', ['toko' => $toko, 'title' => $title]);
    }

    public function ubahToko(Request $r)
    {
        $toko = toko::first();

        $r->validate([
            'nama' => 'required|unique:toko,nama_toko,' . $toko->id_toko . ',id_toko',
            'telp' => 'required|numeric|unique:toko,telp,' . $toko->id_toko . ',id_toko',
            'alamat' => 'required',
            'deskripsi' => 'required'
        ], [
            'nama.unique' => 'Nama toko ' . $r->nama . ' sudah ada',
            'nama.required' => 'Nama toko harus diisi',
            'telp.unique' => 'Nomor telephone ' . $r->telp . ' sudah ada di toko lain',
            'telp.required' => 'Nomor telephone WhatsApp harus diisi',
            'telp.numeric' => 'Nomor telephone harus berupa angka',
            'alamat.required' => 'Alamat toko harus diisi',
            'deskripsi.required' => 'Deskripsi toko harus diisi'
        ]);


        $toko->alamat = $r->alamat;
        $toko->nama_toko = $r->nama;
        $toko->telp = $r->telp;
        $toko->deskripsi_toko = $r->deskripsi;
        $toko->pesan = $r->pesan;
        $toko->save();

        return redirect('/toko')->with('berhasil', 'Data toko berhasil di ubah');
    }

    public function gantiFotoToko()
    {
        $toko = toko::first();

        $title = 'Ubah Foto Toko';
        return view('toko.ubahFotoToko', ['title' => $title, 'toko' => $toko]);

    }

    public function gantiFotoTokos(Request $r)
    {
        $r->validate(
            [
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif'
            ],
            [
                'foto.required' => 'Tolong inputkan foto kamu',
                'foto.image' => 'Yang kamu inputkan bukan foto',
                'foto.mimes' => 'Yang kamu inputkan bukan foto'
            ]
        );

        $toko = toko::first();


        if ($toko->foto_toko != 'default.png') {
            Storage::delete('foto_toko/' . $toko->foto_toko, 'public');
        }


        $file = $r->file('foto');
        $fotoName = $file->hashName();
        Storage::disk('public')->putFileAs('foto_toko', $file, $fotoName);

        $toko->foto_toko = $fotoName;
        $toko->save();

        return redirect('/toko')->with('berhasil', 'Foto toko berhasil diubah');
    }

    public function activity()
    {
        $title = 'Activity';
        $toko = toko::first();
        $activity = session::join('users', 'sessions.user_id', '=', 'users.id')->select('users.username', 'sessions.*')->get();

        return view('admin.activity', ['title' => $title, 'toko' => $toko, 'activity' => $activity]);
    }

    public function hapus_activity($id)
    {
        $activity = session::findorfail($id);

        $activity->delete();
        return redirect('/activity')->with('berhasil', 'Activity berhasil di hapus');
    }

    public function users()
    {
        $users = User::get();
        $title = 'Daftar Admin';
        $toko = toko::first();
        return view('users.index', ['users' => $users, 'title' => $title, 'toko' => $toko]);
    }

    public function tambah_user()
    {
        $title = 'Tambah Admin';
        $toko = toko::first();
        return view('users.tambah', ['title' => $title, 'toko' => $toko]);
    }

    public function store_user(Request $r)
    {

        $r->validate(
            [
                'username' => 'required|unique:users,username',
                'name' => 'required',
                'password' => 'required',
                'passwordAseli' => 'required',
                'foto' => 'image|mimes:jpg,jpeg,png,gif',

            ],
            [
                'username.required' => 'Username harus diisi',
                'name.required' => 'Nama harus diisi',
                'username.unique' => 'Username ' . $r->username . ' sudah ada',
                'password.required' => 'Password harus diisi',
                'passwordAseli' => 'tolong verifikasi password',
                'foto.image' => 'Yang anda inputkan bukan foto',
                'foto.mimes' => 'Yang anda inputkan bukan foto',
                'hak_akses.required' => 'Tolong pilih salah satu hak akses',
                'status.required' => 'Tolong pilih statusnya'
            ]
        );
        if ($r->password != $r->passwordAseli) {
            return redirect()->back()->withInput()->with('pass', 'Password dan varifikasi password tidak sesuai');
        }

        if ($r->hasFile('foto')) {
            $foto = $r->file('foto');
            $fotoName = $foto->hashName();
            Storage::disk('public')->putFileAs('fotoProfileAdmin', $foto, $fotoName);
        } else {
            $fotoName = 'default.png';
        }
        User::insert([
            'username' => $r->username,
            'nama' => $r->name,
            'password' => bcrypt($r->password),
            'foto' => $fotoName,
        ]);

        return redirect('/Users')->with('berhasil', 'Data Admin berhasil di tambah');

    }

    public function ubah_user($id)
    {
        $user = User::findorfail($id);
        $title = 'Ubah Data Users';
        $toko = toko::first();
        return view('users.ubah', ['title' => $title, 'user' => $user, 'toko' => $toko]);
    }

    public function edit_user($id, request $r)
    {
        $user = User::findorfail($id);
        if ($r->ubahPass == '0') {
            $r->validate(
                [
                    'username' => 'required|unique:users,username,' . $user->id,
                    'name' => 'required',
                    'foto' => 'image|mimes:jpg,jpeg,png,gif',
                ],
                [
                    'username.required' => 'Username harus diisi',
                    'name.required' => 'Nama harus diisi',
                    'username.unique' => 'Username ' . $r->username . ' sudah ada',
                    'foto.image' => 'Yang anda inputkan bukan foto',
                    'foto.mimes' => 'Yang anda inputkan bukan foto',
                ]
            );
            if ($r->hasFile('foto')) {
                if ($user->foto != 'default.png') {
                    Storage::disk('public')->delete('fotoProfileAdmin/' . $user->foto);
                }

                $foto = $r->file('foto');
                $fotoName = $foto->hashName();
                Storage::disk('public')->putFileAs('fotoProfileAdmin', $foto, $fotoName);
                $user->foto = $fotoName;
            }
        } elseif ($r->ubahPass == '1') {
            $r->validate(
                [
                    'username' => 'required|unique:users,username,' . $user->id,
                    'name' => 'required',
                    'password' => 'required',
                    'passwordAseli' => 'required',
                    'foto' => 'image|mimes:jpg,jpeg,png,gif',
                ],
                [
                    'username.required' => 'Username harus diisi',
                    'name.required' => 'Nama harus diisi',
                    'username.unique' => 'Username ' . $r->username . ' sudah ada',
                    'password.required' => 'Password harus diisi',
                    'passwordAseli' => 'tolong isikan Password baru',
                    'foto.image' => 'Yang anda inputkan bukan foto',
                    'foto.mimes' => 'Yang anda inputkan bukan foto',
                ]
            );

            if (Hash::check($r->password, $user->password)) {
                if ($r->hasFile('foto')) {
                    if ($user->foto != 'default.png') {
                        Storage::disk('public')->delete('fotoProfileAdmin/' . $user->foto);
                    }
                    $foto = $r->file('foto');
                    $fotoName = $foto->hashName();
                    Storage::disk('public')->putFileAs('fotoProfileAdmin', $foto, $fotoName);
                    $user->foto = $fotoName;
                }
                $user->password = bcrypt($r->passwordAseli);
                $user->username = $r->username;
                $user->nama = $r->name;
                $user->save();

            } else {
                return redirect()->back()->withInput()->with('pass', 'Password lama tidak sesuai');
            }
        }

        $user->username = $r->username;
        $user->nama = $r->name;
        $user->save();
        return redirect('/Users')->with('berhasil', 'Data Users berhasil diubah');
    }

    public function hapus_user($id)
    {
        $user = User::findorfail($id);
        if ($user->foto != 'default.png') {
            Storage::disk('public')->delete('fotoProfileAdmin/' . $user->foto);
        }
        $user->delete();
        return redirect('/Users')->with('berhasil', 'Data Admin berhasil di Hapus');
    }

    public function tampilan()
    {
        $title = 'Tampilan web';
        $toko = toko::first();
        $footer = footer::first();
        return view('tampilan.index', ['title' => $title, 'toko' => $toko, 'footer' => $footer]);
    }

    public function ubah_tampilan(Request $request)
    {
        $request->validate([
            'header' => 'required|string|max:255',
            'text1' => 'required|string|max:255',
            'text1R' => 'required|string|max:255',
            'text2' => 'required|string|max:255',
            'text2R' => 'required|string|max:255',
            'text3' => 'required|string|max:255',
            'text3R' => 'required|string|max:255',
            'copy' => 'required|string|max:255',
        ]);

        $footer = Footer::first();
        $footer->header = $request->header;
        $footer->text1 = $request->text1;
        $footer->text1R = $request->text1R;
        $footer->text2 = $request->text2;
        $footer->text2R = $request->text2R;
        $footer->text3 = $request->text3;
        $footer->text3R = $request->text3R;
        $footer->copyRight = $request->copy;
        $footer->save();

        return redirect()->back()->with('berhasil', 'Footer berhasil diupdate');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('berhasil', 'Berhasil logout');
        ;
    }

}
