<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Lutfi Grand Interior</title>
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
        .success-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
            text-align: center;
            padding: 50px 30px;
        }
        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: scaleIn 0.5s ease-out;
        }
        .success-icon i {
            font-size: 3rem;
            color: white;
        }
        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">
            <i class="bi bi-check-lg"></i>
        </div>
        
        <h2 class="mb-3">{{ $success ?? false ? 'Review Berhasil Dikirim!' : 'Informasi' }}</h2>
        <p class="text-muted mb-4">{{ $message }}</p>
        
        @if($success ?? false)
            <div class="alert alert-success mb-4">
                <i class="bi bi-star-fill text-warning"></i>
                Terima kasih telah meluangkan waktu untuk memberikan review!
            </div>
        @endif
        
        <p class="mb-0">
            <strong>Lutfi Grand Interior</strong><br>
            <small class="text-muted">Kepuasan Anda adalah prioritas kami</small>
        </p>
    </div>

    <script src="{{ asset('mazer/static/js/initTheme.js') }}"></script>
</body>
</html>