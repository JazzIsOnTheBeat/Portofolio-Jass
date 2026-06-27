<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Jass</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&family=Outfit:wght@200;300;400;500;600;700&family=Syne:wght@400;500;600;700;800&family=JetBrains+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-brand-primary flex items-center justify-center min-h-screen text-text-primary font-body antialiased p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-14 h-14 rounded-xl bg-gradient-gold flex items-center justify-center mx-auto mb-4 shadow-lg shadow-gold-base/20">
                <span class="font-heading text-2xl font-bold text-brand-primary">J</span>
            </div>
            <h1 class="text-2xl font-heading text-gradient-gold font-bold">Welcome Back</h1>
            <p class="text-text-secondary text-sm mt-1 font-light">Sign in to your admin panel</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded mb-6 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-card-gold p-8">
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="admin-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="admin-input">
                </div>
                <div class="mb-5">
                    <label class="admin-label">Password</label>
                    <input type="password" name="password" required
                           class="admin-input">
                </div>
                <div class="mb-6 flex items-center gap-2.5">
                    <input type="checkbox" name="remember" id="remember" class="admin-checkbox">
                    <label for="remember" class="text-sm text-text-secondary/70 font-light">Remember me</label>
                </div>
                <button type="submit" class="btn-admin w-full justify-center text-sm">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</body>
</html>