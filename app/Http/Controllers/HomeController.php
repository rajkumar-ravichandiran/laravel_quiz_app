<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Question;
use App\Models\Category;
use App\Models\Quiz;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $startoftheMonth = Carbon::today()->startOfMonth();
        $endoftheMonth = Carbon::today()->endOfMonth();
        $laststartoftheMonth = Carbon::today()->subMonth(1)->startOfMonth();
        $lastendoftheMonth = Carbon::today()->subMonth(1)->endOfMonth();
        $totalUser = User::all()->count();
        $currentMonthUser = User::where('created_at','>',$startoftheMonth)->where('created_at','<',$endoftheMonth)->count();
        $lastMonthUser = User::where('created_at','>',$laststartoftheMonth)->where('created_at','<',$lastendoftheMonth)->count();
        $totalQuestion = Question::all()->count();
        $currentMonthQuestion = Question::where('created_at','>',$startoftheMonth)->where('created_at','<',$endoftheMonth)->count();
        $lastMonthQuestion = Question::where('created_at','>',$laststartoftheMonth)->where('created_at','<',$lastendoftheMonth)->count();

        $totalQuiz = Quiz::all()->count();
        $currentMonthquiz = Quiz::where('created_at','>',$startoftheMonth)->where('created_at','<',$endoftheMonth)->count();
        $lastMonthquiz = Quiz::where('created_at','>',$laststartoftheMonth)->where('created_at','<',$lastendoftheMonth)->count();
        // Calculate the percentage change in user count
        $userpercentageChange = 0;
        if ($lastMonthUser > 0) {
            $userpercentageChange = (($currentMonthUser - $lastMonthUser) / $lastMonthUser) * 100;
            $userpercentageChange = round($userpercentageChange, 2); // Round to 2 decimal points
        }
        // Check if the count percentage is greater or lower
        $usercomparison = '';
        if ($userpercentageChange > 0) {
            $usercomparison = 'higher';
        } elseif ($userpercentageChange < 0) {
            $usercomparison = 'lower';
        }

        $questionpercentageChange = 0;
        if ($lastMonthQuestion > 0) {
            $questionpercentageChange = (($currentMonthQuestion - $lastMonthQuestion) / $lastMonthQuestion) * 100;
            $questionpercentageChange = round($questionpercentageChange, 2); // Round to 2 decimal points
        }
        // Check if the count percentage is greater or lower
        $questioncomparison = '';
        if ($questionpercentageChange > 0) {
            $questioncomparison = 'higher';
        } elseif ($questionpercentageChange < 0) {
            $questioncomparison = 'lower';
        }

        $quizpercentageChange = 0;
        if ($lastMonthquiz > 0) {
            $quizpercentageChange = (($currentMonthquiz - $lastMonthquiz) / $lastMonthquiz) * 100;
            $quizpercentageChange = round($quizpercentageChange, 2); // Round to 2 decimal points
        }
        // Check if the count percentage is greater or lower
        $quizcomparison = '';
        if ($quizpercentageChange > 0) {
            $quizcomparison = 'higher';
        } elseif ($quizpercentageChange < 0) {
            $quizcomparison = 'lower';
        }
        return view('dashboard',compact('totalUser','currentMonthUser','lastMonthUser','userpercentageChange','usercomparison','totalQuestion','currentMonthQuestion','lastMonthQuestion','questionpercentageChange','questioncomparison','totalQuiz','currentMonthquiz','lastMonthquiz','quizpercentageChange','quizcomparison'));
    }
}
