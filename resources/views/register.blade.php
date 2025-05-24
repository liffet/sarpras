<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - SISFO SARPRAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-white min-h-screen flex items-center justify-center ">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 bg-gradient-to-br">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-blue-600">Daftar Akun</h1>
            <p class="text-gray-500 mt-1">Silakan isi form untuk mendaftar</p>
        </div>

        <form method="POST" action="{{ route('register.process') }}" class="space-y-4  ">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full p-2 bg-transparent outline-none border-b-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400 bg-greadient-to-br">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 ">Email</label>
                <input type="email" name="email" id="email" required
                    class="mt-1 block w-full p-2 bg-transparent outline-none border-b-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-greadient-to-br">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full p-2 bg-transparent outline-none border-b-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-greadient-to-br">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-1 block w-full p-2 bg-transparent outline-none border-b-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-greadient-to-br">
            </div>

            <input type="hidden" name="role" value="admin">


            <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Daftar
                </button>
            </div>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login di sini</a>
        </p>
    </div>
</body>
</html>
