<?php

namespace App\Http\Controllers;

use App\Models\Kejadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class KejadianController extends Controller
{
    /**
     * Tampilkan list kejadian (index)
     */
    public function index(Request $request)
    {
        // optional: filter sederhana (cari jenis atau lokasi)
        $query = Kejadian::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($s) use ($q) {
                $s->where('jenis_kejadian', 'like', "%{$q}%")
                    ->orWhere('lokasi', 'like', "%{$q}%")
                    ->orWhere('objek', 'like', "%{$q}%");
            });
        }

        $kejadian = $query->latest()->paginate(15)->withQueryString();

        return view('kejadian.index', compact('kejadian'));
    }

    /**
     * Form create
     */
    public function create()
    {
        return view('kejadian.create');
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_kejadian'   => 'required|string|max:255',
            'objek'            => 'nullable|string|max:255',
            'lokasi'           => 'nullable|string',
            'waktu_kejadian'   => 'nullable|date',
            'terima_berita'    => 'nullable|date',
            'berangkat'        => 'nullable|date',
            'tiba_di_lokasi'   => 'nullable|date',
            'kembali_ke_pos'   => 'nullable|date',
            'foto'             => 'nullable|image|max:5120', // 5MB
        ]);

        // Hitung respon_time otomatis (menit)
        if (! empty($data['berangkat']) && ! empty($data['tiba_di_lokasi'])) {
            $berangkat = Carbon::parse($data['berangkat']);
            $tiba = Carbon::parse($data['tiba_di_lokasi']);
            $data['respon_time'] = $tiba->diffInMinutes($berangkat);
        } else {
            $data['respon_time'] = null;
        }

        // Simpan file foto (jika ada) ke disk public/kejadian
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('kejadian', $filename, 'public');
            $data['foto'] = $filename;
        }

        Kejadian::create($data);

        return redirect()->route('kejadian.index')->with('success', 'Data kejadian berhasil disimpan.');
    }

    /**
     * Tampilkan detail (opsional)
     */
    public function show(Kejadian $kejadian)
    {
        return view('kejadian.show', compact('kejadian'));
    }

    /**
     * Form edit
     */
    public function edit(Kejadian $kejadian)
    {
        return view('kejadian.edit', compact('kejadian'));
    }

    /**
     * Update data
     */
    public function update(Request $request, Kejadian $kejadian)
    {
        $data = $request->validate([
            'jenis_kejadian'   => 'required|string|max:255',
            'objek'            => 'nullable|string|max:255',
            'lokasi'           => 'nullable|string',
            'waktu_kejadian'   => 'nullable|date',
            'terima_berita'    => 'nullable|date',
            'berangkat'        => 'nullable|date',
            'tiba_di_lokasi'   => 'nullable|date',
            'kembali_ke_pos'   => 'nullable|date',
            'foto'             => 'nullable|image|max:5120',
        ]);

        // Hitung respon_time otomatis (menit)
        if (! empty($data['berangkat']) && ! empty($data['tiba_di_lokasi'])) {
            $berangkat = Carbon::parse($data['berangkat']);
            $tiba = Carbon::parse($data['tiba_di_lokasi']);
            $data['respon_time'] = $tiba->diffInMinutes($berangkat);
        } else {
            // kalau input kosong set null (atau biarkan tetap apa adanya sesuai kebutuhan)
            $data['respon_time'] = null;
        }

        // Jika upload foto baru, hapus yang lama (jika ada) lalu simpan baru
        if ($request->hasFile('foto')) {
            if ($kejadian->foto && Storage::disk('public')->exists('kejadian/' . $kejadian->foto)) {
                Storage::disk('public')->delete('kejadian/' . $kejadian->foto);
            }
            $file = $request->file('foto');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('kejadian', $filename, 'public');
            $data['foto'] = $filename;
        }

        $kejadian->update($data);

        return redirect()->route('kejadian.index')->with('success', 'Data kejadian berhasil diperbarui.');
    }

    /**
     * Hapus data
     */
    public function destroy(Kejadian $kejadian)
    {
        // Hapus file foto jika ada
        if ($kejadian->foto && Storage::disk('public')->exists('kejadian/' . $kejadian->foto)) {
            Storage::disk('public')->delete('kejadian/' . $kejadian->foto);
        }

        $kejadian->delete();

        return redirect()->route('kejadian.index')->with('success', 'Data kejadian berhasil dihapus.');
    }
}
