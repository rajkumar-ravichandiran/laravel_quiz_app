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
                            <h3 class="mb-0">Quiz</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('start.quiz')}}" class="btn btn-sm btn-primary">Start Quiz</a>
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
                                    <label class="form-control-label" for="user_id">{{ __('Filter by User') }}</label>
                                    <select class="form-control" name="user_id">
                                        <option disabled selected value> -- {{ __('Select an option') }} -- </option>
                                        @foreach ($users as $key=>$user)
                                            <option <?php if(isset($_GET['user_id'])&&$_GET['user_id'].""==$key.""){echo "selected";} ?> value="{{ $key }}">{{$user}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-6">
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
                                <th scope="col">@sortablelink('user_id')</th>
                                <th scope="col">@sortablelink('category_id')</th>
                                <th scope="col">@sortablelink('total')</th>
                                <th scope="col">@sortablelink('score')</th>
                                <th scope="col">@sortablelink('created_at')</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizzes as $key=>$quiz)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $quiz->user->name }}</td>
                                    <td>{{ $quiz->category->name }}</td>
                                    <td>{{ $quiz->total }}</td>
                                    <td>{{ $quiz->score }}</td>
                                    <td>{{ $quiz->created_at }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <form action="{{ route('quiz.destroy', $quiz) }}" method="POST">
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
              {{ $quizzes->links() }}
            </div>
            </div>
        </div>
    </div>
@include('layouts.footers.auth')
</div>
@endsection
