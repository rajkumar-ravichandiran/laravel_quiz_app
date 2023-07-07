<li class="nav-item">
<a class="nav-link {{ (\Request::routeIs('quiz.*')) ? 'active' : '' }}" href="#navbar-quiz" data-toggle="collapse" role="button" aria-expanded="{{ (\Request::routeIs('quiz.*')) ? 'true' : 'false' }}" aria-controls="navbar-quiz">
    <i class="ni ni-hat-3 text-pink"></i>
    <span class="nav-link-text">{{ __('Quizzes') }}</span>
</a>
<div class="collapse {{ (\Request::routeIs('quiz.*')) ? 'show' : '' }}" id="navbar-quiz">
    <ul class="nav nav-sm flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('quiz.index') }}">
                {{ __('List') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('start.quiz') }}">
                {{ __('Start Quiz') }}
            </a>
        </li>
    </ul>
</div>
</li>