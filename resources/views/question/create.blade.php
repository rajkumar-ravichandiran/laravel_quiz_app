@extends('layouts.app')
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
                            <h3 class="mb-0">{{ __('Create Question') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('questions.store') }}" autocomplete="off">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Question information') }}</h6>
                                        
                            <div class="col-12">
                                @include('layouts.flash')
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Question') }}</label>
                                    <input type="text" name="question" id="input-name" class="form-control form-control-alternative{{ $errors->has('question') ? ' is-invalid' : '' }}" placeholder="{{ __('Question') }}" value="{{ old('question') }}" required autofocus>

                                    @if ($errors->has('question'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('question') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="category_id">{{ __('Category') }}</label>                         
                                    <select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" id="category_id"  required>
                                        <option value="" selected disabled>{{__('Select Category')}}</option>
                                        @foreach($categories as $key=>$category)
                                        <option value="{{$key}}">{{$category}}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('category_id'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                  </div>
                              </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="type">{{ __('Type') }}</label>                         
                                    <select name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" id="type"  required>
                                        <option value="" selected disabled>{{__('Select Type')}}</option>
                                        <option value="0">{{__('Multiple Choice')}}</option>
                                        <option value="1">{{__('True/False')}}</option>
                                    </select>
                                        @if ($errors->has('type'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                  </div>
                              </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('difficulty') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="difficulty">{{ __('Difficulty') }}</label>                         
                                    <select name="difficulty" class="form-control{{ $errors->has('difficulty') ? ' is-invalid' : '' }}" id="difficulty"  required>
                                        <option value="" selected disabled>{{__('Select Difficulty')}}</option>
                                        <option value="1">{{__('Easy')}}</option>
                                        <option value="2">{{__('Medium')}}</option>
                                        <option value="3">{{__('Hard')}}</option>
                                    </select>
                                        @if ($errors->has('difficulty'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('difficulty') }}</strong>
                                            </span>
                                        @endif
                                  </div>
                              </div>
                              <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('choices') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-choices">{{ __('Choices (add options in comma separator)') }}</label>
                                    <textarea name="choices" class="form-control{{ $errors->has('choices') ? ' is-invalid' : '' }}" id="input-choices" rows="3"></textarea>

                                    @if ($errors->has('choices'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('choices') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('answer') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="answer">{{ __('Answer') }}</label>                         
                                    <select name="answer" class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" id="answer"  required>
                                        <option value="" selected disabled>{{__('Select Answer')}}</option>
                                        <option value="0">{{__('1')}}</option>
                                        <option value="1">{{__('2')}}</option>
                                        <option value="2">{{__('3')}}</option>
                                        <option value="3">{{__('4')}}</option>
                                    </select>
                                        @if ($errors->has('answer'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('answer') }}</strong>
                                            </span>
                                        @endif
                                  </div>
                              </div>
                              <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('summary') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-summary">{{ __('Summary') }}</label>
                                    <textarea name="summary" class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}" id="input-summary" rows="3"></textarea>

                                    @if ($errors->has('summary'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('summary') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
<script type="text/javascript">
// jQuery
$(document).ready(function() {
    $('#type').change(function() {
        var selectedValue = $(this).val();
        // Enable all options in dropdown2
        $('#answer option').prop('disabled', false);
        
        // Disable specific options based on the selected value in dropdown1
        if (selectedValue === '1') {
            $('#answer option[value="2"]').prop('disabled', true);
            $('#answer option[value="3"]').prop('disabled', true);
            $('#input-choices').val('true,false').prop('readonly', true);
        } else{
            $('#answer option').prop('disabled', false);
            $('#input-choices').val('').prop('readonly', false);
        }
    });
});

</script>
@endpush