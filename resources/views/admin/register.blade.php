<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6">Register Admin</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/admin/register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white p-2 rounded">Register</button>
        </form>

        <p class="mt-4 text-center">
            Sudah punya akun? <a href="{{ route('admin.login') }}" class="text-blue-600">Login</a>
        </p>
    </div>
</body>
</html>
