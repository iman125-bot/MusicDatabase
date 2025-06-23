<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Music Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-purple-600 to-blue-400">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>
            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif
            <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-md hover:bg-purple-700">Login</button>
        </form>
    </div>
</body>
</html>