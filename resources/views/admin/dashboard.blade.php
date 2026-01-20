@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .stats-card {
        border-left: 4px solid;
        transition: transform 0.2s;
    }
    .stats-card:hover {
        transform: translateY(-5px);
    }
    .chart-container {
        position: relative;
        height: 300px;
    }
</style>
@endpush

@section('content')
<!-- Statistik Utama -->
<section class="row">
    <div class="col-12">
        <div class="row">
            <!-- Total Pemesanan -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #435ebe;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Pemesanan</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalPemesanan }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemesanan Bulan Ini -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #25a6e6;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon" style="background-color: #dff3fc;">
                                    <i class="iconly-boldCalendar" style="color: #25a6e6;"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Bulan Ini</h6>
                                <h6 class="font-extrabold mb-0">{{ $pemesananBulanIni }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemasukan Bulan Ini -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #57caeb;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon" style="background-color: #e0f4fc;">
                                    <i class="iconly-boldWallet" style="color: #57caeb;"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pemasukan Bulan Ini</h6>
                                <h6 class="font-extrabold mb-0">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemasukan Tahun Ini -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #5ddab4;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldBuy"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pemasukan Tahun Ini</h6>
                                <h6 class="font-extrabold mb-0">Rp {{ number_format($pemasukanTahunIni, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <!-- Pemesanan Menunggu -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #ff7976;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon red mb-2">
                                    <i class="iconly-boldDanger"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Menunggu</h6>
                                <h6 class="font-extrabold mb-0">{{ $pemesananMenunggu }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemesanan Proses -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #ffa426;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon" style="background-color: #fff4e6;">
                                    <i class="iconly-boldWork" style="color: #ffa426;"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Dalam Proses</h6>
                                <h6 class="font-extrabold mb-0">{{ $pemesananProses }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemesanan Selesai -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #5ddab4;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldTickSquare"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Selesai</h6>
                                <h6 class="font-extrabold mb-0">{{ $pemesananSelesai }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemesanan Dibatalkan -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #9ca3af;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon" style="background-color: #f3f4f6;">
                                    <i class="iconly-boldCloseSquare" style="color: #9ca3af;"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Dibatalkan</h6>
                                <h6 class="font-extrabold mb-0">{{ $pemesananDibatalkan }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Rating -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #ffce31;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon" style="background-color: #fff9e6;">
                                    <i class="iconly-boldStar" style="color: #ffce31;"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Rata-rata Rating</h6>
                                <h6 class="font-extrabold mb-0">{{ number_format($rataRating, 1) }}/5.0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Review -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card stats-card" style="border-left-color: #936cdb;">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldChat"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Review</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalReview }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>

<!-- Grafik & Tabel -->
<section class="row">
    <!-- Grafik Pemasukan -->
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Pemasukan 6 Bulan Terakhir</h4>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="pemasukanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Pemesanan Pie Chart -->
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Status Pemesanan</h4>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="row">
    <!-- Top Layanan -->
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Top 5 Layanan Terpopuler</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Layanan</th>
                                <th class="text-center">Total Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topLayanan as $index => $layanan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $layanan->nama }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ $layanan->pemesanans_count }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Sebaran Kota -->
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Top 10 Kota Pemesanan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kota</th>
                                <th class="text-center">Total Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sebaranKota as $index => $kota)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kota->kota }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success">{{ $kota->total }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Grafik Pemasukan
    const pemasukanCtx = document.getElementById('pemasukanChart');
    if (pemasukanCtx) {
        const pemasukanChart = new Chart(pemasukanCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($bulanLabels) !!},
                datasets: [{
                    label: 'Pemasukan (Rp)',
                    data: {!! json_encode($pemasukanPerBulan) !!},
                    backgroundColor: 'rgba(67, 94, 190, 0.8)',
                    borderColor: 'rgba(67, 94, 190, 1)',
                    borderWidth: 2,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Pemasukan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    },
                    legend: {
                        display: true
                    }
                }
            }
        });
    }

    // Pie Chart Status
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Proses', 'Selesai', 'Dibatalkan'],
                datasets: [{
                    data: [
                        {{ $statusPemesanan['menunggu'] }},
                        {{ $statusPemesanan['proses'] }},
                        {{ $statusPemesanan['selesai'] }},
                        {{ $statusPemesanan['dibatalkan'] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 121, 118, 0.8)',
                        'rgba(255, 164, 38, 0.8)',
                        'rgba(93, 218, 180, 0.8)',
                        'rgba(156, 163, 175, 0.8)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
</script>
@endpush