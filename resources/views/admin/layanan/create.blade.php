@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')
@section('page-title', 'Tambah Layanan')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form Tambah Layanan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           placeholder="Contoh: Desain Interior Rumah"
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" 
                              name="deskripsi" 
                              rows="5"
                              placeholder="Jelaskan detail layanan ini..."
                              required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Layanan <span class="text-secondary">(opsional)</span></label>
                    <input type="file" 
                           class="form-control @error('gambar') is-invalid @enderror" 
                           id="gambar" 
                           name="gambar"
                           accept="image/jpeg,image/png,image/jpg"
                           onchange="previewImage(event)">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                    
                    <div class="mt-3" id="imagePreview" style="display: none;">
                        <img id="preview" src="" alt="Preview" style="max-width: 300px; height: auto; border-radius: 5px; border: 1px solid #ddd;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" 
                               type="checkbox" 
                               id="status" 
                               name="status" 
                               value="1"
                               {{ old('status', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">
                            Aktif
                        </label>
                    </div>
                    <small class="text-muted">Layanan yang aktif akan ditampilkan di halaman profil</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">
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
    function previewImage(event) {
        const reader = new FileReader();
        const imagePreview = document.getElementById('imagePreview');
        const preview = document.getElementById('preview');
        
        reader.onload = function() {
            preview.src = reader.result;
            imagePreview.style.display = 'block';
        }
        
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endpush
@endsection