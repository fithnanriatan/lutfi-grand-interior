@extends('admin.layouts.app')

@section('title', 'Tambah Portfolio')
@section('page-title', 'Tambah Portfolio')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form Tambah Portfolio</h5>
        </div>
        <div class="card-body">
            @if($pemesanan)
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle"></i> 
                    <strong>Portfolio dari Pemesanan #{{ $pemesanan->id }}</strong><br>
                    Layanan: {{ $pemesanan->layanan->nama }} | Pelanggan: {{ $pemesanan->nama_pelanggan }}
                </div>
            @endif

            <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @if($pemesanan)
                    <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
                @endif

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Project <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('judul') is-invalid @enderror" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul', $pemesanan ? $pemesanan->layanan->nama . ' - ' . $pemesanan->nama_pelanggan : '') }}"
                           placeholder="Contoh: Desain Interior Rumah Minimalis"
                           required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Project <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" 
                              name="deskripsi" 
                              rows="5"
                              placeholder="Jelaskan detail project ini..."
                              required>{{ old('deskripsi', $pemesanan ? $pemesanan->catatan : '') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar_cover" class="form-label">Gambar Cover <span class="text-danger">*</span></label>
                    <input type="file" 
                           class="form-control @error('gambar_cover') is-invalid @enderror" 
                           id="gambar_cover" 
                           name="gambar_cover"
                           accept="image/jpeg,image/png,image/jpg"
                           onchange="previewCover(event)"
                           required>
                    @error('gambar_cover')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                    
                    <div class="mt-3" id="coverPreview" style="display: none;">
                        <img id="previewCover" src="" alt="Preview Cover" style="max-width: 300px; height: auto; border-radius: 5px; border: 1px solid #ddd;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="galeri" class="form-label">Galeri Foto (Opsional)</label>
                    <input type="file" 
                           class="form-control @error('galeri.*') is-invalid @enderror" 
                           id="galeri" 
                           name="galeri[]"
                           accept="image/jpeg,image/png,image/jpg"
                           multiple
                           onchange="previewGallery(event)">
                    @error('galeri.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Maksimal 4 foto tambahan. Format: JPG, JPEG, PNG. Maksimal 2MB per foto</small>
                    
                    <div class="mt-3 row g-2" id="galleryPreview"></div>
                </div>

                <div class="mb-3">
                    <label for="urutan" class="form-label">Urutan Tampilan</label>
                    <input type="number" 
                           class="form-control @error('urutan') is-invalid @enderror" 
                           id="urutan" 
                           name="urutan" 
                           value="{{ old('urutan') }}"
                           min="0"
                           placeholder="Kosongkan untuk otomatis">
                    @error('urutan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Semakin kecil angka, semakin atas posisinya</small>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" 
                               type="checkbox" 
                               id="tampilkan" 
                               name="tampilkan" 
                               value="1"
                               {{ old('tampilkan', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tampilkan">
                            Tampilkan di Landing Page
                        </label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function previewCover(event) {
        const reader = new FileReader();
        const coverPreview = document.getElementById('coverPreview');
        const preview = document.getElementById('previewCover');
        
        reader.onload = function() {
            preview.src = reader.result;
            coverPreview.style.display = 'block';
        }
        
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    function previewGallery(event) {
        const galleryPreview = document.getElementById('galleryPreview');
        galleryPreview.innerHTML = '';
        
        const files = Array.from(event.target.files).slice(0, 4); // Max 4 files
        
        files.forEach((file, index) => {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-3';
                col.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Gallery ${index + 1}" 
                         style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                `;
                galleryPreview.appendChild(col);
            }
            
            reader.readAsDataURL(file);
        });
        
        if (files.length > 4) {
            alert('Maksimal 4 foto galeri. Hanya 4 foto pertama yang akan diupload.');
        }
    }
</script>
@endpush
@endsection