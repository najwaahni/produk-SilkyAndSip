<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SILKY & SIP</title>

    <style>
        :root { --bg: #f7f1ea; --panel: #ffffff; --panel-soft: #f9f4ee; --line: #e5dccf; --text: #23150f; --muted: #6a574d; --accent: #c67d38; --accent-dark: #23150f; }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background: var(--bg); color: var(--text); }
        body { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .card { width: min(100%, 28rem); background: rgba(255,255,255,0.9); border: 1px solid var(--line); border-radius: 28px; box-shadow: 0 20px 60px rgba(94,69,44,0.18); padding: 2rem; }
        .logo { width: 4rem; height: 4rem; display: inline-flex; align-items: center; justify-content: center; border-radius: 999px; background: #f2e4d6; color: #6f3d18; font-size: 2rem; margin-bottom: 1rem; }
        .title { margin: 0; text-align: center; font-size: 2rem; line-height: 1.2; }
        .subtitle { margin: 0.5rem 0 0; text-align: center; color: var(--muted); font-size: 0.875rem; }
        .alert { margin: 1.25rem 0; border-radius: 1rem; padding: 0.75rem 1rem; font-size: 0.875rem; }
        .alert-error { background: #fff1f2; border: 1px solid #fecdd3; color: #9f1239; }
        .alert-warning { background: #fffbeb; border: 1px solid #fcd34d; color: #92400e; }
        form { display: flex; flex-direction: column; gap: 1.1rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: 700; font-size: 0.875rem; }
        input { width: 100%; border-radius: 1rem; border: 1px solid var(--line); background: var(--panel-soft); padding: 0.85rem 1rem; font-size: 0.875rem; color: var(--text); outline: none; }
        input:focus { border-color: var(--accent); box-shadow: 0 0 0 2px rgba(198,125,56,0.15); }
        .row { display: flex; justify-content: space-between; align-items: center; color: var(--muted); font-size: 0.875rem; }
        .row a { color: var(--accent); text-decoration: none; font-weight: 600; }
        .remember-row { display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .remember-label { display: inline-flex; align-items: center; gap: 0.5rem; margin: 0; white-space: nowrap; }
        .remember-checkbox { width: 1rem; height: 1rem; flex: 0 0 1rem; margin: 0; padding: 0; accent-color: var(--accent); }
        button { width: 100%; border: none; border-radius: 1rem; background: var(--accent-dark); color: #fff; padding: 0.875rem 1rem; font-weight: 700; cursor: pointer; }
        button:hover { background: #3a2116; }
        .center { text-align: center; }
    </style>
</head>
<body class="bg-[#F7F1EA] min-h-screen text-[#2D1D13] antialiased">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white/90 backdrop-blur-sm rounded-[28px] shadow-[0_20px_60px_rgba(94,69,44,0.18)] border border-[#E8DCCD] p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#F2E4D6] text-[#6F3D18] text-2xl font-bold mb-4">✦</div>
                <h1 class="text-3xl font-bold tracking-tight text-[#23150F]">Admin Portal</h1>
                <p class="mt-2 text-sm text-[#6A574D]">Masuk untuk mengelola pesanan SILKY & SIP</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-[#38261B]">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full rounded-2xl border border-[#E5DCCF] bg-[#F9F4EE] px-4 py-3 text-sm text-[#23150F] outline-none transition focus:border-[#C67D38] focus:ring-2 focus:ring-[#E7C59A]" placeholder="Masukkan email admin">
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-[#38261B]">Password</label>
                    <input id="password" name="password" type="password" required class="w-full rounded-2xl border border-[#E5DCCF] bg-[#F9F4EE] px-4 py-3 text-sm text-[#23150F] outline-none transition focus:border-[#C67D38] focus:ring-2 focus:ring-[#E7C59A]" placeholder="••••••••">
                </div>

                <div class="remember-row text-sm text-[#6A574D]">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" class="remember-checkbox rounded border-[#DDBA8A] text-[#C67D38] focus:ring-[#C67D38]">
                        Ingat saya
                    </label>
                    <a href="{{ route('home') }}" class="font-semibold text-[#C67D38] hover:text-[#8F531A]">Kembali ke toko</a>
                </div>

                <button type="submit" class="w-full rounded-2xl bg-[#23150F] px-5 py-3 text-sm font-bold text-white shadow-lg shadow-[#23150F]/10 transition hover:bg-[#3A2116]">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>
</body>
</html>
