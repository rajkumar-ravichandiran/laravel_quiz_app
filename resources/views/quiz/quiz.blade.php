@extends('layouts.app')
@section('css')
<link type="text/css" href="{{ asset('assets') }}/css/custom.css" rel="stylesheet">
@endsection
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
<div class="container-fluid">
</div>
</div>
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12">
      <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <h3 class="mb-0">{{ __('Start Game') }}</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-control-label" for="input-name">{{ __('Number of Questions') }}</label>
                <input type="number" step="1" min="1" max="20" name="question_no" id="question_no" class="form-control form-control-alternative" placeholder="{{ __('Question') }}" value="5">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="category_id">{{ __('Category') }}</label>                         
                <select name="category_id" class="form-control" id="category_id">
                  <option value="" selected disabled>{{__('Select Category')}}</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-control-label" for="type">{{ __('Type') }}</label>                         
                <select name="type" class="form-control" id="type">
                  <option value="0">{{__('Multiple Choice')}}</option>
                  <option value="1">{{__('True/False')}}</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="form-control-label" for="difficulty">{{ __('Difficulty') }}</label>                         
                <select name="difficulty" class="form-control" id="difficulty">
                  <option value="1">{{__('Easy')}}</option>
                  <option value="2">{{__('Medium')}}</option>
                  <option value="3">{{__('Hard')}}</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="text-center">
                <input type="hidden" name="candidate_id" id="candidate_id" value="{{auth()->user()->id}}">
                <button  type="button" id="start-quiz" class="btn btn-success mt-0">{{ __('Start Quiz') }}</button>
              </div>
            </div>
          </div>
          <div class="quiz-section mt-5" style="display: none;">
            <h1 id="question" class="text-center h2 mb-3"></h1>
            <div id="choices" class=""></div>
            <div class="text-center d-flex align-items-center justify-content-center flex-column">
              <div id="lottieAnimation" class="" style="display:none;"></div>
              <button class="btn btn-success mt-0" type="button" id="checkBtn">Submit</button>
              <p id="feedback" class="mx-auto mt-2 text-center font-weight-500 mb-0 badge badge-pill"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('layouts.footers.auth')
</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.5.9/lottie.min.js"></script>
<script type="text/javascript">
  var GET_QUESTIONS_API = "{{route('v1.quiz.getQuestions')}}";
  var GET_CATEGORIES_API = "{{route('v1.quiz.getCategories')}}";
  var COMPLETE_QUIZ_API = "{{route('v1.quiz.completeQuiz')}}";
</script>
@endpush