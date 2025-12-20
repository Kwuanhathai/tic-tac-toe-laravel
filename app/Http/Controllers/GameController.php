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

    public function play(Request $request)
    {
        $board = $request->board;
        $move = $request->move;

        // Player move
        $board[$move[0]][$move[1]] = 'X';

        // Check the winner after the player makes a move.
        $winner = $this->checkWinner($board);

        // If the player has not won yet and the board is not full, let the bot make a move.
        if (!$winner && $this->hasEmptyCell($board)) {
            $emptyCells = [];
            for ($i=0;$i<3;$i++){
                for ($j=0;$j<3;$j++){
                    if($board[$i][$j]=='') $emptyCells[] = [$i,$j];
                }
            }
            if(count($emptyCells)){
                $botMove = $emptyCells[array_rand($emptyCells)];
                $board[$botMove[0]][$botMove[1]] = 'O';
            }

            // Check the winner after the bot makes a move.
            $winner = $this->checkWinner($board);
        }

        // Update the score.
        $score = Score::firstOrCreate(['user_id'=>Auth::id()]);
        if($winner=='X'){
            $score->score +=1;
            $score->streak +=1;
            if($score->streak==3){
                $score->score+=1;
                $score->streak=0;
            }
        } elseif($winner=='O'){
            $score->score-=1;
            $score->streak=0;
        }
        $score->save();

        return response()->json([
            'board'=>$board,
            'winner'=>$winner
        ]);
    }


    // A function to check whether there are any empty spaces.
    private function hasEmptyCell($board)
    {
        foreach($board as $row){
            foreach($row as $cell){
                if($cell == '') return true;
            }
        }
        return false;
    }

    private function checkWinner($b)
    {
        $lines = [
            [[0,0],[0,1],[0,2]],
            [[1,0],[1,1],[1,2]],
            [[2,0],[2,1],[2,2]],
            [[0,0],[1,0],[2,0]],
            [[0,1],[1,1],[2,1]],
            [[0,2],[1,2],[2,2]],
            [[0,0],[1,1],[2,2]],
            [[0,2],[1,1],[2,0]],
        ];

        foreach ($lines as $line) {
            $a = $line[0]; $b1 = $line[1]; $c = $line[2];
            if ($b[$a[0]][$a[1]] != '' &&
                $b[$a[0]][$a[1]] == $b[$b1[0]][$b1[1]] &&
                $b[$a[0]][$a[1]] == $b[$c[0]][$c[1]]) {
                return $b[$a[0]][$a[1]]; // X or O
            }
        }
        return null;
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
