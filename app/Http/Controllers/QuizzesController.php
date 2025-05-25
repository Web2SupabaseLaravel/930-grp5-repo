<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quizzes;

class QuizzesController extends Controller
{
    // عرض جميع الكويزات
    public function index()
    {
        $quizzes = Quizzes::all();
return view('quizzes.index', compact('quizzes'));
    }

public function create()
{
    $data['quizzes'] = new Quizzes(); 
$data['route'] = 'dataQuizzes.store';
    $data['method'] = 'post';
    $data['titleForm'] = 'Form Input Quizzes'; 
    $data['submitButton'] = 'Submit';

return view('quizzes.form_Quizzes', $data);
}

    // حفظ بيانات الكويز في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quiz_date' => 'required|date', 
            'quiz_topic' => 'required|string|max:255', 
        ]);

        $inputQuizzes = new Quizzes(); 
        $inputQuizzes->name = $request->name;
        $inputQuizzes->quiz_topic = $request->quiz_topic; 
        $inputQuizzes->save();

return redirect()->route('dataQuizzes.create')->with('success', 'Quiz created successfully!');
    }
}
