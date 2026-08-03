<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | IT Core Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background: #fff;
        }

        /* SISI KIRI: Branding */
        .left-side {
            flex: 1.2;
            background: radial-gradient(circle at bottom left, #1d4ed8, #0f172a);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px;
            color: white;
        }

        .left-side h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .left-side p {
            font-size: 1.1rem;
            color: #e2e8f0;
            max-width: 450px;
            line-height: 1.7;
        }

        /* SISI KANAN: Form & Logo */
        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
        }

        /* Penambahan Logo */
        .logo-login {
            width: 100px;
            margin-bottom: 2rem;
        }

        .login-header {
            margin-bottom: 2.5rem;
        }

        .login-header h2 {
            font-size: 1.75rem;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #64748b;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: 0.3s;
        }

        input:focus {
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background: #1e293b;
            transform: translateY(-2px);
        }

        @media (max-width: 992px) {
            .left-side {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Sisi Kiri -->
    <div class="left-side">
        <h1>IT Core <br>Systems</h1>
        <p>Kelola troubleshooting, manajemen operan teknisi, dan tata kelola inventaris aset rumah sakit dalam satu
            dashboard terintegrasi.</p>
    </div>

    <!-- Sisi Kanan -->
    <div class="right-side">
        <div class="login-card">
            <!-- Penambahan Logo -->
            <img src="{{ asset('image/logoit.png') }}" alt="Logo IT" class="logo-login">

            <div class="login-header">
                <h2>Selamat Datang Kembali</h2>
                <p>Silakan masukkan kredensial Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="email" name="email" required autofocus>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn-login">Masuk ke Sistem</button>
            </form>
        </div>
    </div>
</body>

</html>
