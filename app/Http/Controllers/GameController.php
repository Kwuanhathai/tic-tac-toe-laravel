<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $board = [
            ['', '', ''],
            ['', '', ''],
            ['', '', '']
        ];

        return view('game', compact('board'));
    }

    public function updateScore(Request $request)
    {
        $user = auth()->user();

        // If the user does not have a score record yet, create a new one.
        $score = $user->score ?? new Score(['user_id' => $user->id, 'score' => 0, 'streak' => 0]);

        $winner = $request->input('winner');

        if($winner == 'X'){ // The player wins.
            $score->score += 1;
            $score->streak += 1;

            if($score->streak == 3){
                $score->score += 1; // Bonus
                $score->streak = 0;
            }
        } elseif($winner == 'O'){ // lose
            $score->score -= 1;
            $score->streak = 0;
        }

        $score->save();

        return response()->json([
            'score' => $score->score,
            'streak' => $score->streak,
        ]);
    }

}
