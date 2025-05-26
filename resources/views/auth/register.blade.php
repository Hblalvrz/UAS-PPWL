<!DOCTYPE html>
<html>

<head>
    <title>Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h2>Registrasi</h2>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="text" name="phone" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="address" required></textarea>
        </div>
        <div class="form-group">
            <label>Daftar Sebagai</label>
            <select name="user_type" required>
                <option value="customer">Customer</option>
                <option value="laundry_providers">Penyedia Laundry</option>
            </select>
        </div>
        <button type="submit">Daftar</button>
    </form>
    <p><a href="{{ route('login') }}">Sudah punya akun? Login di sini</a></p>
</body>

</html>
