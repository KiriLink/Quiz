<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function preguntas_normales($p)
    {
        if ($p == 1) {
            return redirect()->route('quiz', ['p' => 1]);
        } else {
            return redirect()->route('quiz', ['p' => 2]);
        }
    }
    public function quiz($p)
    {
        return view('quiz', ['p' => $p]);
    }
}
