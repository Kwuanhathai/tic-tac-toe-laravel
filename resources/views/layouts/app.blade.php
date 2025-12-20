<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic-Tac-Toe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="font-bold text-lg">Tic-Tac-Toe</div>
            <div class="space-x-3">
                @auth
                    <a href="/game" class="hover:underline">Game</a>
                    <a href="/scoreboard" class="hover:underline">Scoreboard</a>
                    <a href="/logout" class="hover:underline">Logout</a>
                @else
                    <a href="{{ route('login.google') }}" class="hover:underline">Login with Google</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8">
        @yield('content')
    </main>
</body>
</html>
