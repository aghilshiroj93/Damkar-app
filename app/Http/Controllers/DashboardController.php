<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kejadian;
use App\Models\Petugas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $end = Carbon::today();
        $start = (clone $end)->subDays(6);

        /**
         * Ambil jumlah kejadian per hari (7 hari terakhir)
         * Gunakan selectRaw untuk mengembalikan kolom "date" dan "total" jelas
         */
        $rows = Kejadian::selectRaw("DATE(COALESCE(waktu_kejadian, created_at)) as date, COUNT(*) as total")
            ->whereDate(DB::raw("COALESCE(waktu_kejadian, created_at)"), '>=', $start->toDateString())
            ->whereDate(DB::raw("COALESCE(waktu_kejadian, created_at)"), '<=', $end->toDateString())
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Buat array associative [ '2025-12-05' => 3, ... ]
        $counts = [];
        foreach ($rows as $r) {
            // $r bisa jadi Model / stdClass tapi memiliki property date & total
            $dateKey = (string) $r->date;
            $counts[$dateKey] = (int) ($r->total ?? 0);
        }

        // Build labels & data untuk 7 hari terakhir (pastikan hari tanpa kejadian = 0)
        $labels = [];
        $data = [];
        for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
            $key = $d->toDateString();
            $labels[] = $d->format('d M');
            $data[] = $counts[$key] ?? 0;
        }

        // KPI
        $totalKejadian = Kejadian::count();
        $totalPetugas = Petugas::count();
        $avgRespon = Kejadian::whereNotNull('respon_time')->avg('respon_time');
        $avgResponRounded = $avgRespon !== null ? round($avgRespon, 1) : null;

        // Recent lists
        $recentKejadian = Kejadian::latest()->limit(8)->get();
        $petugas = Petugas::latest()->limit(10)->get();

        return view('dashboard.index', compact(
            'labels',
            'data',
            'totalKejadian',
            'totalPetugas',
            'avgResponRounded',
            'recentKejadian',
            'petugas'
        ));
    }
}
