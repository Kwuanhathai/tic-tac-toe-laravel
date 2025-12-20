<?php

namespace App\Http\Controllers;

use App\Models\Score;

class ScoreController extends Controller
{
    public function index()
    {
        $scores = Score::all(); // Retrieve all scores.
        
        return view('scoreboard', compact('scores'));
    }
}
