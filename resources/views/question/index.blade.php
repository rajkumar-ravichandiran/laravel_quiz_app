@extends('layouts.app')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
<div class="container-fluid">
</div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="mb-0">Questions</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('questions.create')}}" class="btn btn-sm btn-primary">Add Question</a>
                            <button id="show-hide-filters" class="btn btn-icon btn-1 btn-sm btn-outline-secondary" type="button"><span class="btn-inner--icon"><i id="button-filters" class="ni ni-bold-down"></i></span></button>
                        </div>
                    </div>
                    <div class="tab-content show-filters" style="display:{{$parameters ? 'block' : 'none'}};">
                       <form method="GET">
                          <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="category_id">{{ __('Filter by Category') }}</label>
                                    <select class="form-control" name="category_id">
                                        <option disabled selected value> -- {{ __('Select an option') }} -- </option>
                                        @foreach ($categories as $key=>$category)
                                            <option <?php if(isset($_GET['category_id'])&&$_GET['category_id'].""==$key.""){echo "selected";} ?> value="{{ $key }}">{{$category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="type">{{ __('Filter by Type') }}</label>
                                    <select class="form-control" name="type">
                                        <option disabled selected value> -- {{ __('Select an option') }} -- </option>
                                            <option <?php if(isset($_GET['type'])&&$_GET['type'].""=="0"){echo "selected";} ?> value="0">{{__('Multiple Choice')}}</option>
                                            <option <?php if(isset($_GET['type'])&&$_GET['type'].""=="1"){echo "selected";} ?> value="1">{{__('True / False')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="status">{{ __('Filter by Status') }}</label>
                                    <select class="form-control" name="status">
                                        <option disabled selected value> -- {{ __('Select an option') }} -- </option>
                                            <option <?php if(isset($_GET['status'])&&$_GET['status'].""=="0"){echo "selected";} ?> value="0">{{__('InActive')}}</option>
                                            <option <?php if(isset($_GET['status'])&&$_GET['status'].""=="1"){echo "selected";} ?> value="1">{{__('Active')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="level">{{ __('Filter by Level') }}</label>
                                    <select class="form-control" name="level">
                                        <option disabled selected value> -- {{ __('Select an option') }} -- </option>
                                            <option <?php if(isset($_GET['level'])&&$_GET['level'].""=="1"){echo "selected";} ?> value="1">{{__('Easy')}}</option>
                                            <option <?php if(isset($_GET['level'])&&$_GET['level'].""=="2"){echo "selected";} ?> value="2">{{__('Medium')}}</option>
                                            <option <?php if(isset($_GET['level'])&&$_GET['level'].""=="3"){echo "selected";} ?> value="3">{{__('Hard')}}</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-6 offset-md-6">
                                <div class="row justify-content-end">
                                   @if ($parameters)
                                   <div class="col-md-4">
                                      <a href="{{ Request::url() }}" class="btn btn-md btn-block">{{ __('Clear Filters') }}</a>
                                   </div>
                                   @else
                                   <div class="col-md-8"></div>
                                   @endif
                                   <div class="col-md-4">
                                      <button type="submit" class="btn btn-primary btn-md btn-block">{{ __('Filter') }}</button>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </form>
                    </div>
                </div>
                
                <div class="col-12">
                    @include('layouts.flash')
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@sortablelink('question')</th>
                                <th scope="col">Category</th>
                                <th scope="col">Type</th>
                                <th scope="col">Level</th>
                                <th scope="col">Creater</th>
                                <th scope="col">Status</th>
                                <th scope="col">@sortablelink('created_at')</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $key=>$question)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td class="text-wrap">{{ html_entity_decode($question->question, ENT_QUOTES) }}</td>
                                    <td class="text-wrap">{{ $question->category->name }}</td>
                                    <td>{{ $question->question_type }}</td>
                                    <td>{{ $question->question_level }}</td>
                                    <td>{{ $question->creater->name }}</td>
                                    <td>{{ $question->active == 1? 'Active' : 'InActive' }}</td>
                                    <td>{{ $question->created_at }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{route('questions.edit',$question)}}">Edit</a>
                                            @if(auth() && auth()->user()->hasRole(['admin','staff']))
                                             @if($question->active == 0)
                                            <a class="dropdown-item" href="{{route('question.approval',[$question,1])}}">Accept</a>
                                            @endif
                                            <a class="dropdown-item" href="{{route('question.approval',[$question,0])}}">Reject</a>
                                            @endif
                                            <form action="{{ route('questions.destroy', $question) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">Delete</button>
                                            </form>
                                            
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
              {{ $questions->links() }}
            </div>
            </div>
        </div>
    </div>
@include('layouts.footers.auth')
</div>
@endsection
