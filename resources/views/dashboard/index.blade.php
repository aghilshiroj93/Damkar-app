@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">

        {{-- KPI cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-5 transform hover:-translate-y-1 transition">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-xs text-gray-500">Total Kejadian</div>
                        <div class="mt-2 text-2xl font-bold text-gray-800">{{ number_format($totalKejadian) }}</div>
                    </div>
                    <div class="bg-indigo-50 text-indigo-600 p-2 rounded">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3 text-sm text-gray-500">Ringkasan jumlah kejadian selama sistem</div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 transform hover:-translate-y-1 transition">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-xs text-gray-500">Total Petugas</div>
                        <div class="mt-2 text-2xl font-bold text-gray-800">{{ number_format($totalPetugas) }}</div>
                    </div>
                    <div class="bg-green-50 text-green-600 p-2 rounded">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5.121 17.804A9 9 0 1118.879 6.196 9 9 0 015.121 17.804z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3 text-sm text-gray-500">Jumlah akun petugas terdaftar</div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 transform hover:-translate-y-1 transition">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-xs text-gray-500">Rata-rata Respon (menit)</div>
                        <div class="mt-2 text-2xl font-bold text-gray-800">
                            {{ $avgResponRounded !== null ? $avgResponRounded . ' menit' : '-' }}</div>
                    </div>
                    <div class="bg-yellow-50 text-yellow-600 p-2 rounded">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3 text-sm text-gray-500">Rata-rata waktu respon (hanya kejadian berset respon_time)</div>
            </div>
        </div>

        {{-- Chart + recent lists --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Statistik Kejadian</h3>
                        <p class="text-sm text-gray-500 mt-1">7 hari terakhir</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 mr-2"></div>
                            <span class="text-xs text-gray-600">Kejadian</span>
                        </div>
                        <div class="text-xs text-gray-400 border-l pl-2">Update realtime</div>
                    </div>
                </div>
                <div class="relative h-64">
                    <canvas id="kejadianChart" height="240"></canvas>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <h4 class="font-semibold mb-3">Kejadian Terbaru</h4>

                    @if ($recentKejadian->isEmpty())
                        <div class="text-sm text-gray-500">Belum ada kejadian.</div>
                    @else
                        <ul class="space-y-3">
                            @foreach ($recentKejadian as $k)
                                <li class="flex items-start gap-3">
                                    <div class="w-2.5 h-2.5 mt-2 rounded-full bg-indigo-500"></div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div class="text-sm font-medium">{{ $k->jenis_kejadian }}</div>
                                            <div class="text-xs text-gray-400">
                                                {{ $k->waktu_kejadian ? $k->waktu_kejadian->format('Y-m-d H:i') : $k->created_at->format('Y-m-d H:i') }}
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-600">{{ Str::limit($k->lokasi ?? '-', 80) }}</div>
                                        <div class="mt-1 text-xs text-gray-500">Respon:
                                            {{ $k->respon_time !== null ? $k->respon_time . ' menit' : '-' }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="bg-white rounded-lg shadow p-4">
                    <h4 class="font-semibold mb-3">Daftar Petugas</h4>
                    @if ($petugas->isEmpty())
                        <div class="text-sm text-gray-500">Belum ada petugas.</div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-xs text-gray-500">
                                    <tr>
                                        <th class="px-3 py-2 text-left">#</th>
                                        <th class="px-3 py-2 text-left">Nama</th>
                                        <th class="px-3 py-2 text-left">Username</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($petugas as $p)
                                        <tr>
                                            <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                            <td class="px-3 py-2">{{ $p->nama_lengkap }}</td>
                                            <td class="px-3 py-2">{{ $p->username }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Footer small note --}}
        <div class="text-xs text-gray-500">Data diperbarui saat halaman dimuat. Untuk data realtime, pertimbangkan
            websockets / polling.</div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function() {
            const labels = @json($labels);
            const data = @json($data);

            const ctx = document.getElementById('kejadianChart').getContext('2d');

            // Hapus grid lama jika ada
            if (window.kejadianChartInstance) {
                window.kejadianChartInstance.destroy();
            }

            // Buat gradient yang lebih menarik
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(99,102,241,0.8)');
            gradient.addColorStop(0.7, 'rgba(99,102,241,0.15)');
            gradient.addColorStop(1, 'rgba(99,102,241,0.05)');

            const hoverGradient = ctx.createLinearGradient(0, 0, 0, 400);
            hoverGradient.addColorStop(0, 'rgba(79,70,229,0.9)');
            hoverGradient.addColorStop(1, 'rgba(79,70,229,0.2)');

            // Warna chart
            const chartColors = {
                primary: '#4f46e5',
                primaryLight: '#6366f1',
                gridLine: '#e5e7eb',
                text: '#6b7280'
            };

            window.kejadianChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Kejadian',
                        data: data,
                        backgroundColor: gradient,
                        borderColor: chartColors.primary,
                        borderWidth: 1.5,
                        hoverBackgroundColor: hoverGradient,
                        hoverBorderColor: chartColors.primary,
                        borderRadius: {
                            topLeft: 8,
                            topRight: 8
                        },
                        borderSkipped: false,
                        barPercentage: 0.65,
                        categoryPercentage: 0.8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleColor: '#f1f5f9',
                            bodyColor: '#f1f5f9',
                            borderColor: 'rgba(99, 102, 241, 0.5)',
                            borderWidth: 1,
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return `📊 ${context.parsed.y} kejadian`;
                                },
                                title: function(tooltipItems) {
                                    return tooltipItems[0].label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: chartColors.text,
                                font: {
                                    size: 12,
                                    family: "'Inter', sans-serif"
                                },
                                padding: 10
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(229, 231, 235, 0.6)',
                                drawBorder: false,
                                tickLength: 0
                            },
                            ticks: {
                                color: chartColors.text,
                                font: {
                                    size: 11,
                                    family: "'Inter', sans-serif"
                                },
                                padding: 8,
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            },
                            border: {
                                display: false,
                                dash: [4, 4]
                            }
                        }
                    },
                    elements: {
                        bar: {
                            borderWidth: 0
                        }
                    },
                    layout: {
                        padding: {
                            top: 10,
                            right: 10,
                            bottom: 5,
                            left: 5
                        }
                    }
                }
            });

            // Tambahkan efek hover pada bar
            const chartCanvas = document.getElementById('kejadianChart');
            chartCanvas.addEventListener('mousemove', function(e) {
                const bars = window.kejadianChartInstance.getElementsAtEventForMode(e, 'index', {
                    intersect: false
                }, true);
                chartCanvas.style.cursor = bars.length ? 'pointer' : 'default';
            });
        })();
    </script>

    <style>
        /* Tambahkan custom styles untuk chart yang lebih halus */
        #kejadianChart {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
@endsection
