<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $petugas = Petugas::where('username', $data['username'])->first();

        if (! $petugas || ! Hash::check($data['password'], $petugas->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
        }

        $request->session()->regenerate();
        $request->session()->put('petugas_id', $petugas->id);
        $request->session()->put('petugas_nama', $petugas->nama_lengkap);
        $request->session()->put('petugas_username', $petugas->username);

        $intended = $request->session()->pull('url.intended', route('dashboard'));
        return redirect()->to($intended)->with('success', 'Selamat datang, ' . $petugas->nama_lengkap . '!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerateToken();
        return redirect()->route('login.form')->with('success', 'Kamu berhasil logout.');
    }
}
