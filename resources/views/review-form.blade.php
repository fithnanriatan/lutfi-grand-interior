<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berikan Review - Lutfi Grand Interior</title>
    <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app-dark.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .review-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 100%;
        }
        .star-rating {
            display: flex;
            justify-content: center;
            gap: 10px;
            font-size: 2.5rem;
            margin: 20px 0;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            cursor: pointer;
            color: #ddd;
            transition: color 0.2s;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: #ffc107;
        }
        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px 15px 0 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="review-card">
        <div class="header-section">
            <h2 class="mb-2">Berikan Review Anda</h2>
            <p class="mb-0">Kami senang mendengar pengalaman Anda!</p>
        </div>
        
        <div class="p-4">
            <!-- Informasi Pemesanan -->
            <div class="alert alert-light mb-4">
                <h6 class="mb-2"><strong>Detail Pemesanan:</strong></h6>
                <p class="mb-1"><i class="bi bi-briefcase"></i> <strong>Layanan:</strong> {{ $pemesanan->layanan->nama }}</p>
                <p class="mb-1"><i class="bi bi-person"></i> <strong>Nama:</strong> {{ $pemesanan->nama_pelanggan }}</p>
                <p class="mb-0"><i class="bi bi-calendar"></i> <strong>Tanggal Selesai:</strong> {{ $pemesanan->tanggal_selesai ? $pemesanan->tanggal_selesai->format('d F Y') : '-' }}</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Form Review -->
            <form action="{{ route('review.submit', $pemesanan->review_token) }}" method="POST" id="reviewForm">
                @csrf
                
                <!-- Rating -->
                <div class="mb-4 text-center">
                    <label class="form-label fw-bold">Berikan Rating <span class="text-danger">*</span></label>
                    <div class="star-rating" id="starRating">
                        <input type="radio" name="rating" id="star5" value="5" {{ old('rating') == 5 ? 'checked' : '' }}>
                        <label for="star5"><i class="bi bi-star-fill"></i></label>
                        
                        <input type="radio" name="rating" id="star4" value="4" {{ old('rating') == 4 ? 'checked' : '' }}>
                        <label for="star4"><i class="bi bi-star-fill"></i></label>
                        
                        <input type="radio" name="rating" id="star3" value="3" {{ old('rating') == 3 ? 'checked' : '' }}>
                        <label for="star3"><i class="bi bi-star-fill"></i></label>
                        
                        <input type="radio" name="rating" id="star2" value="2" {{ old('rating') == 2 ? 'checked' : '' }}>
                        <label for="star2"><i class="bi bi-star-fill"></i></label>
                        
                        <input type="radio" name="rating" id="star1" value="1" {{ old('rating') == 1 ? 'checked' : '' }}>
                        <label for="star1"><i class="bi bi-star-fill"></i></label>
                    </div>
                    @error('rating')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Komentar -->
                <div class="mb-4">
                    <label for="komentar" class="form-label fw-bold">Komentar/Testimoni <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('komentar') is-invalid @enderror" 
                              id="komentar" 
                              name="komentar" 
                              rows="6"
                              placeholder="Ceritakan pengalaman Anda dengan layanan kami... (minimal 10 karakter)"
                              required>{{ old('komentar') }}</textarea>
                    <small class="text-muted">
                        <span id="charCount">0</span> / 1000 karakter
                    </small>
                    @error('komentar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-send"></i> Kirim Review
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('mazer/static/js/initTheme.js') }}"></script>
    <script>
        // Character counter
        const komentarInput = document.getElementById('komentar');
        const charCount = document.getElementById('charCount');
        
        komentarInput.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });
        
        // Set initial count
        charCount.textContent = komentarInput.value.length;

        // Star rating interaction
        const stars = document.querySelectorAll('.star-rating label');
        const starInputs = document.querySelectorAll('.star-rating input');
        
        stars.forEach((star, index) => {
            star.addEventListener('mouseenter', function() {
                updateStars(5 - index);
            });
            
            star.addEventListener('click', function() {
                const input = document.getElementById(this.getAttribute('for'));
                input.checked = true;
            });
        });
        
        document.getElementById('starRating').addEventListener('mouseleave', function() {
            const checked = document.querySelector('.star-rating input:checked');
            if (checked) {
                updateStars(checked.value);
            } else {
                resetStars();
            }
        });
        
        function updateStars(rating) {
            stars.forEach((star, index) => {
                if (5 - index <= rating) {
                    star.style.color = '#ffc107';
                } else {
                    star.style.color = '#ddd';
                }
            });
        }
        
        function resetStars() {
            stars.forEach(star => {
                star.style.color = '#ddd';
            });
        }
        
        // Initialize stars if there's a checked input
        const checkedInput = document.querySelector('.star-rating input:checked');
        if (checkedInput) {
            updateStars(checkedInput.value);
        }
    </script>
</body>
</html>