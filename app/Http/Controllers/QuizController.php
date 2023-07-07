<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\User;

class QuizController extends Controller
{
    public function startQuiz()
    {
        return view('quiz.quiz');
    }

    public function index()
    {
        // Retrieve all Quizzes
        
        if(auth()->user()->hasRole(['candidate'])){
            $quizzes = Quiz::where('user_id',auth()->user()->id);
            $users = User::where('id',auth()->user()->id)->pluck('name','id')->toArray();
        }else{
            $quizzes = Quiz::query();
            $users = User::pluck('name','id')->toArray();
        }

        if (isset($_GET['category_id'])&&strlen($_GET['category_id'])>0) {
        $quizzes = $quizzes->where('category_id', $_GET['category_id']);    
        }

        if (isset($_GET['user_id'])&&strlen($_GET['user_id'])>0) {
        $quizzes = $quizzes->where('user_id', $_GET['user_id']);    
        }

        $quizzes = $quizzes->sortable()->OrderBy('created_at','DESC')->paginate(50);
        $parameters = count($_GET) != 0;
        $categories = Category::pluck('name','id')->toArray();
        // Pass the Quizzes to the view
        return view('quiz.index', compact('quizzes','parameters','categories','users'));
    }

    public function show($id)
    {
        $quiz = Quiz::FindOrFail($id);
        if($quiz){
            return view('quiz.show', compact('quiz'));
        }else{
            return redirect()->back()->withError('Not Found');
        }
    }
}
