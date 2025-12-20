@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center h-[70vh] text-center">
    <h1 class="text-5xl font-bold mb-4 text-blue-800">Welcome to Tic-Tac-Toe!</h1>
    <p class="text-lg mb-6">Challenge the bot and see how high you can score!</p>

    <a href="{{ route('login.google') }}" 
       class="px-8 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
       Login with Google
    </a>
</div>
@endsection
