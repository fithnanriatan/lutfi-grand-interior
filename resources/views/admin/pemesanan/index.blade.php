@extends('admin.layouts.app')

@section('title', 'Daftar Pemesanan')
@section('page-title', 'Daftar Pemesanan')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Semua Pemesanan</h5>
                <a href="{{ route('admin.pemesanan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Pemesanan
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Filter -->
            <form method="GET" action="{{ route('admin.pemesanan.index') }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="layanan_id" class="form-select">
                            <option value="">Semua Layanan</option>
                            @foreach($layanans as $layanan)
                                <option value="{{ $layanan->id }}" {{ request('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                    {{ $layanan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="kota" class="form-control" placeholder="Cari berdasarkan kota" value="{{ request('kota') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Kota</th>
                            <th>Tanggal Mulai</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemesanans as $index => $pemesanan)
                        <tr>
                            <td>{{ $pemesanans->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $pemesanan->nama_pelanggan }}</strong><br>
                                <small class="text-muted">{{ $pemesanan->telepon_pelanggan }}</small>
                            </td>
                            <td>{{ $pemesanan->layanan->nama }}</td>
                            <td>{{ $pemesanan->kota }}</td>
                            <td>{{ $pemesanan->tanggal_mulai->format('d/m/Y') }}</td>
                            <td>Rp {{ number_format($pemesanan->harga_final, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $pemesanan->status == 'pending' ? 'warning' : ($pemesanan->status == 'proses' ? 'info' : ($pemesanan->status == 'selesai' ? 'success' : 'danger')) }}">
                                    {{ ucfirst($pemesanan->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.pemesanan.show', $pemesanan->id) }}" 
                                       class="btn btn-sm btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pemesanan.edit', $pemesanan->id) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    {{-- <form action="{{ route('admin.pemesanan.destroy', $pemesanan->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus pemesanan ini?')"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data pemesanan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $pemesanans->links() }}
            </div>
        </div>
    </div>
</section>
@endsection