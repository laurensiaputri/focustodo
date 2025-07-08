<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .profile-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }
        p.subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input, textarea {
            padding: 12px 16px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
        }
        input[disabled] {
            background-color: #f4f4f4;
            cursor: not-allowed;
        }
        button {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }
        .alert {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .link-group {
            margin-top: 20px;
            text-align: center;
        }
        .link-group a {
            text-decoration: none;
            color: #667eea;
            font-weight: 600;
            margin: 0 8px;
        }
        .photo-preview {
            display: block;
            margin: 0 auto 20px;
            border-radius: 50%;
            border: 3px solid #667eea;
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="profile-card">
        <h2>Profil Saya</h2>
        <p class="subtitle">Lihat dan perbarui informasi akun Anda</p>

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi Error --}}
        @if($errors->any())
            <div class="alert error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Foto Profil --}}
        <img src="{{ Auth::user()->profile_photo_url ?? asset('default-user.png') }}" alt="Foto Profil" class="photo-preview">

        <form method="POST" action="{{ route('profile.updatePhoto') }}" enctype="multipart/form-data" style="margin-bottom: 25px;">
            @csrf
            <input type="file" name="photo">
            <button type="submit">📸 Ganti Foto</button>
        </form>

        {{-- Form Data --}}
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Nama Lengkap" required>
            <input type="email" value="{{ Auth::user()->email }}" disabled placeholder="Email">
            <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Nomor Telepon">
            <textarea name="address" placeholder="Alamat">{{ old('address', Auth::user()->address) }}</textarea>
            <button type="submit">💾 Simpan Perubahan</button>
        </form>

        <div class="link-group">
            <a href="{{ route('settings') }}">🔑 Ganti Password</a>
            <a href="{{ route('dashboard') }}">⬅️ Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
