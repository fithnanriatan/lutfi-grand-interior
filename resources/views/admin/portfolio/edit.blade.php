@extends('admin.layouts.app')

@section('title', 'Edit Portfolio')
@section('page-title', 'Edit Portfolio')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Edit Portfolio</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Project <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                            name="judul" value="{{ old('judul', $portfolio->judul) }}"
                            placeholder="Contoh: Desain Interior Rumah Minimalis" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Project <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                            placeholder="Jelaskan detail project ini..." required>{{ old('deskripsi', $portfolio->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar_cover" class="form-label">Gambar Cover</label>

                        <div class="mb-2">
                            <p class="mb-1"><strong>Cover saat ini:</strong></p>
                            <img src="{{ asset('storage/' . $portfolio->gambar_cover) }}" alt="{{ $portfolio->judul }}"
                                id="currentCover"
                                style="max-width: 300px; height: auto; border-radius: 5px; border: 1px solid #ddd;">
                        </div>

                        <input type="file" class="form-control @error('gambar_cover') is-invalid @enderror"
                            id="gambar_cover" name="gambar_cover" accept="image/jpeg,image/png,image/jpg"
                            onchange="previewCover(event)">
                        @error('gambar_cover')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin
                            mengubah.</small>

                        <div class="mt-3" id="coverPreview" style="display: none;">
                            <p class="mb-1"><strong>Preview cover baru:</strong></p>
                            <img id="previewCover" src="" alt="Preview"
                                style="max-width: 300px; height: auto; border-radius: 5px; border: 1px solid #ddd;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Galeri Foto Saat Ini</label>

                        @if ($portfolio->galeri && count($portfolio->galeri) > 0)
                            <div class="row g-2 mb-3">
                                @foreach ($portfolio->galeri as $index => $image)
                                    <div class="col-md-3" id="gallery-item-{{ $index }}">
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery {{ $index + 1 }}"
                                                style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                                            <button type="button"
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                                onclick="deleteGalleryImage({{ $portfolio->id }}, {{ $index }})"
                                                title="Hapus foto ini">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Tidak ada foto galeri</p>
                        @endif

                        <label for="galeri" class="form-label mt-3">Tambah Foto Galeri</label>
                        <input type="file" class="form-control @error('galeri.*') is-invalid @enderror" id="galeri"
                            name="galeri[]" accept="image/jpeg,image/png,image/jpg" multiple
                            onchange="previewGallery(event)">
                        @error('galeri.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            Anda bisa menambah hingga {{ 4 - count($portfolio->galeri ?? []) }} foto lagi.
                            Format: JPG, JPEG, PNG. Maksimal 2MB per foto
                        </small>

                        <div class="mt-3 row g-2" id="galleryPreview"></div>
                    </div>

                    <div class="mb-3">
                        <label for="urutan" class="form-label">Urutan Tampilan</label>
                        <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan"
                            name="urutan" value="{{ old('urutan', $portfolio->urutan) }}" min="0">
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Semakin kecil angka, semakin atas posisinya</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="tampilkan" name="tampilkan" value="1"
                                {{ old('tampilkan', $portfolio->tampilkan) ? 'checked' : '' }}>
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
                            <i class="bi bi-save"></i> Update
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
                const currentCover = document.getElementById('currentCover');

                reader.onload = function() {
                    preview.src = reader.result;
                    coverPreview.style.display = 'block';
                    if (currentCover) {
                        currentCover.style.opacity = '0.5';
                    }
                }

                if (event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                } else {
                    coverPreview.style.display = 'none';
                    if (currentCover) {
                        currentCover.style.opacity = '1';
                    }
                }
            }

            function previewGallery(event) {
                const galleryPreview = document.getElementById('galleryPreview');
                galleryPreview.innerHTML = '';

                const currentGalleryCount = {{ count($portfolio->galeri ?? []) }};
                const maxNewFiles = 4 - currentGalleryCount;
                const files = Array.from(event.target.files).slice(0, maxNewFiles);

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

                if (event.target.files.length > maxNewFiles) {
                    alert(`Maksimal ${maxNewFiles} foto lagi yang bisa ditambahkan.`);
                }
            }

            function deleteGalleryImage(portfolioId, index) {
                if (!confirm('Yakin ingin menghapus foto ini?')) {
                    return;
                }

                fetch(`/admin/portfolio/${portfolioId}/gallery/${index}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`gallery-item-${index}`).remove();
                            alert('Foto berhasil dihapus!');
                            location.reload();
                        } else {
                            alert('Gagal menghapus foto!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan!');
                    });
            }
        </script>
    @endpush
@endsection
