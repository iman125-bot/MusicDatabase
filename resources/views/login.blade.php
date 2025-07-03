<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Music Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      .glass-card {
        background: rgba(24, 24, 24, 0.92);
        box-shadow: 0 8px 40px 0 rgba(30,185,84,0.13);
        backdrop-filter: blur(12px);
        border-radius: 1.5rem;
        animation: fadeInUp 1.2s;
      }
      @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
      }
      .music-logo-animate {
        animation: pulseLogo 1.3s infinite alternate;
        filter: drop-shadow(0 0 16px #1db954);
      }
      @keyframes pulseLogo {
        from { transform: scale(1); }
        to { transform: scale(1.13); }
      }
      body {
        background: #181818 !important;
      }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen font-[Rajdhani]">
    <div class="glass-card p-10 w-full max-w-md flex flex-col items-center">
        <div class="mb-6">
            <i class="fa fa-music fa-4x text-[#1db954] music-logo-animate"></i>
        </div>
        <h2 class="text-3xl font-bold text-center text-white mb-2 tracking-wide" style="letter-spacing:1.5px;">Welcome</h2>
        <p class="text-center text-gray-400 mb-7 text-base">Sign in to your music collection</p>
        <form method="POST" action="{{ url('/login') }}" class="w-full">
            @csrf
            <div class="mb-5">
                <label class="block text-gray-300 mb-1 text-sm font-semibold">Email</label>
                <input type="email" name="email" required class="w-full mt-1 px-4 py-2 bg-[#232323] text-white border border-[#444] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1db954] transition placeholder-gray-500" placeholder="you@email.com">
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 mb-1 text-sm font-semibold">Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password-input" required class="w-full mt-1 px-4 py-2 bg-[#232323] text-white border border-[#444] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1db954] transition placeholder-gray-500 pr-12" placeholder="Your password">
                    <button type="button" id="toggle-password" tabindex="-1" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;outline:none;cursor:pointer;color:#aaa;" aria-label="Show password">
                        <i class="fa fa-eye" id="eye-icon"></i>
                    </button>
                </div>
                <div class="flex justify-end mt-2">
                    <a href="#" class="text-sm text-white hover:text-[#1db954] hover:underline" tabindex="0">Lupa password?</a>
                </div>
            </div>
            @if ($errors->any())
                <div class="mb-4 text-red-400 text-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif
            <button type="submit" class="w-full bg-[#1db954] text-white py-3 rounded-lg text-lg font-bold shadow-lg hover:bg-[#17a74a] transition-all duration-200 tracking-wide">Login</button>
        </form>
    </div>
</body>
<script>
const togglePassword = document.getElementById('toggle-password');
const passwordInput = document.getElementById('password-input');
const eyeIcon = document.getElementById('eye-icon');
if (togglePassword && passwordInput && eyeIcon) {
    togglePassword.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
}
</script>
</html>