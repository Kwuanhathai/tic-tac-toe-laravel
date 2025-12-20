@extends('layouts.app')

@section('content')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col items-center">
        <h1 class="text-3xl font-bold mb-6 text-center">Tic-Tac-Toe</h1>

        <!-- Board -->
        <div id="board" class="grid grid-cols-3 gap-3">
            @for($i=0;$i<3;$i++)
                @for($j=0;$j<3;$j++)
                    <button class="h-20 w-20 text-3xl border-2 font-bold bg-white hover:bg-gray-100 transition rounded-lg"
                            onclick="makeMove({{ $i }}, {{ $j }})"
                            id="cell-{{ $i }}-{{ $j }}">
                        {{ $board[$i][$j] }}
                    </button>
                @endfor
            @endfor
        </div>

        <!-- Message -->
        <div class="mt-6 text-xl font-semibold text-center" id="message"></div>

        <!-- Score -->
        <div id="score" class="mt-4 text-lg font-bold text-center">
            Score: <span id="score-value">{{ auth()->user()->score->score ?? 0 }}</span>
        </div>
    </div>
</div>

<!-- Include JS -->
<script src="{{ asset('js/game.js') }}"></script>
@endsection
