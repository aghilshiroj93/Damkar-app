<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::latest()->paginate(15);
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|max:100|unique:petugas,username',
            'password'     => 'required|string|min:6|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);

        Petugas::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'username'     => $data['username'],
            'password'     => $data['password'],
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function show(Petugas $petugas)
    {
        return view('petugas.show', compact('petugas')); // optional
    }

    public function edit(Petugas $petugas)
    {
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, Petugas $petugas)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => ['required', 'string', 'max:100', Rule::unique('petugas', 'username')->ignore($petugas->id)],
            'password'     => 'nullable|string|min:6|confirmed',
        ]);

        $update = [
            'nama_lengkap' => $data['nama_lengkap'],
            'username'     => $data['username'],
        ];

        if (!empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }

        $petugas->update($update);

        return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil diperbarui.');
    }

    public function destroy(Petugas $petugas)
    {
        $petugas->delete();
        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
