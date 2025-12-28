@extends('admin.layouts.app')

@section('title', 'Daftar Layanan')
@section('page-title', 'Daftar Layanan')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Semua Layanan</h5>
            <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Layanan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($layanans as $index => $layanan)
                        <tr>
                            <td>{{ $layanans->firstItem() + $index }}</td>
                            <td>
                                @if($layanan->gambar)
                                    <img src="{{ asset('storage/' . $layanan->gambar) }}" 
                                         alt="{{ $layanan->nama }}" 
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                @else
                                    <span class="badge bg-secondary">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $layanan->nama }}</td>
                            <td>{{ Str::limit($layanan->deskripsi, 50) }}</td>
                            <td>
                                @if($layanan->status)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.layanan.edit', $layanan->id) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus layanan ini?')"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data layanan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $layanans->links() }}
            </div>
        </div>
    </div>
</section>
@endsection