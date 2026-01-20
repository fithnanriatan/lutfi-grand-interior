@extends('admin.layouts.app')

@section('title', 'Daftar Portfolio')
@section('page-title', 'Daftar Portfolio')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Semua Portfolio</h5>
                <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Portfolio
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="80">Urutan</th>
                            <th width="150">Cover</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th width="100">Total Foto</th>
                            <th width="100">Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($portfolios as $portfolio)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">{{ $portfolio->urutan }}</span>
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $portfolio->gambar_cover) }}" 
                                     alt="{{ $portfolio->judul }}" 
                                     style="width: 120px; height: 80px; object-fit: cover; border-radius: 5px;">
                            </td>
                            <td>
                                <strong>{{ $portfolio->judul }}</strong>
                                @if($portfolio->pemesanan_id)
                                    <br><small class="text-muted">
                                        <i class="bi bi-link-45deg"></i> Dari Pemesanan #{{ $portfolio->pemesanan_id }}
                                    </small>
                                @endif
                            </td>
                            <td>{{ Str::limit($portfolio->deskripsi, 60) }}</td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $portfolio->total_images }} foto</span>
                            </td>
                            <td>
                                @if($portfolio->tampilkan)
                                    <span class="badge bg-success">Ditampilkan</span>
                                @else
                                    <span class="badge bg-secondary">Disembunyikan</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.portfolio.show', $portfolio->id) }}" 
                                       class="btn btn-sm btn-info" title="Detail">
                                        <i class="bi bi-info-circle"></i>
                                    </a>
                                    <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.portfolio.toggle', $portfolio->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-sm {{ $portfolio->tampilkan ? 'btn-secondary' : 'btn-success' }}"
                                                title="{{ $portfolio->tampilkan ? 'Sembunyikan' : 'Tampilkan' }}">
                                            <i class="bi {{ $portfolio->tampilkan ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.portfolio.destroy', $portfolio->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus portfolio ini?')"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada portfolio</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $portfolios->links() }}
            </div>
        </div>
    </div>
</section>
@endsection