<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function getCategories(Request $request)
    {
        $data = Category::pluck('name','id')->toArray();
        return response()->json([
            'status' => true,
            'data'=>$data
        ]);
    }

    public function getQuestions(Request $request)
    {
        $questions = Question::select('question','category_id','type','level','choices','answer','question')->where('active',1)->inRandomOrder();
        
        if($request->has('no_of_questions')){
        $questions = $questions->limit($request->no_of_questions);
        }
        
        if($request->has('category')){
        $questions = $questions->where('category_id',$request->category);
        }

        if($request->has('type')){
        $questions = $questions->where('type',$request->type);
        }

        if($request->has('difficulty')){
        $questions = $questions->where('level',$request->difficulty);
        }
        $questions = $questions->get();
        return response()->json([
            'status' => true,
            'data'=>$questions
        ]);
    }

    public function completeQuiz(Request $request)
    {
        $quiz = Quiz::create([
            'category_id'=>$request->category_id,
            'user_id'=>$request->candidate_id,
            'total'=>$request->total,
            'score'=>$request->score
        ]);
        return response()->json([
            'status' => true
        ]);
    }
    
}
