<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Retrieve all categories
        if(auth()->user()->hasRole(['author'])){
            $questions = Question::where('created_by',auth()->user()->id);
        }else{
            $questions = Question::query();
        }

        if (isset($_GET['category_id'])&&strlen($_GET['category_id'])>0) {
        $questions = $questions->where('category_id', $_GET['category_id']);    
        }

        if (isset($_GET['type'])&&strlen($_GET['type'])>0) {
        $questions = $questions->where('type', $_GET['type']);    
        }

        if (isset($_GET['status'])&&strlen($_GET['status'])>0) {
        $questions = $questions->where('active', $_GET['status']);    
        }

        if (isset($_GET['level'])&&strlen($_GET['level'])>0) {
        $questions = $questions->where('level', $_GET['level']);    
        }
        $questions = $questions->sortable()->OrderBy('created_at','DESC')->paginate(50);
        $parameters = count($_GET) != 0;
        $categories = Category::pluck('name','id')->toArray();
        // Pass the categories to the view
        return view('question.index', compact('questions','parameters','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->toArray();
        return view('question.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $choices = explode(',',$request->choices);
        $question = Question::create([
            'question'=>$request->question,
            'category_id'=>$request->category_id,
            'type'=>$request->type,
            'level'=>$request->difficulty,
            'choices'=>json_encode($choices),
            'answer'=>$request->answer,
            'summary'=>$request->summary,
            'created_by'=>auth()->user()->id
        ]);
        return redirect()->route('questions.edit',$question)->withStatus('Question Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $categories = Category::pluck('name','id')->toArray();
        return view('question.edit',compact('question','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question,Request $request)
    {
        if($request->has('question')){
        $question->question = $request->question;
        }
        if($request->has('category_id')){
        $question->category_id = $request->category_id;
        }
        if($request->has('type')){
        $question->type = $request->type;
        }
        if($request->has('level')){
        $question->level = $request->level;
        }
        if($request->has('choices')){
        $choices = explode(',',$request->choices);
        $question->choices = json_encode($choices);
        }
        if($request->has('answer')){
        $question->answer = $request->answer;
        }
        if($request->has('summary')){
        $question->summary = $request->summary;
        }

        $question->created_by = auth()->user()->id;
        $question->update();
        return redirect()->back()->withStatus('Question Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back()->withStatus('Question Deleted Successfully');
    }

    public function manualApproval(Question $question,$status)
    {
        if($status){
        $question->active = (int)$status;
        }
        $question->update();
        return redirect()->back()->withStatus('Question updated Successfully');
    }
}
