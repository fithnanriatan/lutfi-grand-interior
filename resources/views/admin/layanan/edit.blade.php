@extends('admin.layouts.app')

@section('title', 'Edit Layanan')
@section('page-title', 'Edit Layanan')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form Edit Layanan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $layanan->nama) }}"
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
                              required>{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Layanan</label>
                    
                    @if($layanan->gambar)
                        <div class="mb-2">
                            <p class="mb-1"><strong>Gambar saat ini:</strong></p>
                            <img src="{{ asset('storage/' . $layanan->gambar) }}" 
                                 alt="{{ $layanan->nama }}"
                                 id="currentImage" 
                                 style="max-width: 300px; height: auto; border-radius: 5px; border: 1px solid #ddd;">
                        </div>
                    @endif
                    
                    <input type="file" 
                           class="form-control @error('gambar') is-invalid @enderror" 
                           id="gambar" 
                           name="gambar"
                           accept="image/jpeg,image/png,image/jpg"
                           onchange="previewImage(event)">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                    
                    <div class="mt-3" id="imagePreview" style="display: none;">
                        <p class="mb-1"><strong>Preview gambar baru:</strong></p>
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
                               {{ old('status', $layanan->status) ? 'checked' : '' }}>
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
                        <i class="bi bi-save"></i> Update
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
        const currentImage = document.getElementById('currentImage');
        
        reader.onload = function() {
            preview.src = reader.result;
            imagePreview.style.display = 'block';
            if(currentImage) {
                currentImage.style.opacity = '0.5';
            }
        }
        
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        } else {
            imagePreview.style.display = 'none';
            if(currentImage) {
                currentImage.style.opacity = '1';
            }
        }
    }
</script>
@endpush
@endsection