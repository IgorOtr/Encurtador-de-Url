<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Encurtador de URL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Encurtador de URL</h1>

        @if(session('shortened'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                URL encurtada: 
                <a href="{{ session('shortened') }}" class="underline text-blue-600" target="_blank">
                    {{ session('shortened') }}
                </a>
            </div>
        @endif

        @if($errors->any())
            <ul class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('shorten') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">URL Longa</label>
                <input type="url" name="url" placeholder="https://exemplo.com" required 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Expira em (opcional)</label>
                <input type="datetime-local" name="expires_at"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Encurtar URL
                </button>
            </div>
        </form>
    </div>
</body>
</html>
