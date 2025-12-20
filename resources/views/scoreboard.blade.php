@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-800">🏆 Scoreboard</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg shadow-md">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Player</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Score</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Streak</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $score)
                    <tr class="border-b hover:bg-blue-50 transition-colors">
                        <td class="px-6 py-4">{{ $score->user->name }}</td>
                        <td class="px-6 py-4 text-center font-medium">{{ $score->score }}</td>
                        <td class="px-6 py-4 text-center font-medium">{{ $score->streak }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
