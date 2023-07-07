<li class="nav-item">
<a class="nav-link {{ (\Request::routeIs('user.*')) ? 'active' : '' }}" href="#navbar-users" data-toggle="collapse" role="button" aria-expanded="{{ (\Request::routeIs('user.*')) ? 'true' : 'false' }}" aria-controls="navbar-users">
    <i class="ni ni-single-02 text-orange"></i>
    <span class="nav-link-text">{{ __('Users') }}</span>
</a>
<div class="collapse {{ (\Request::routeIs('user.*')) ? 'show' : '' }}" id="navbar-users">
    <ul class="nav nav-sm flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                {{ __('List') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.create') }}">
                {{ __('Create') }}
            </a>
        </li>
    </ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link {{ (\Request::routeIs('categories.*')) ? 'active' : '' }}" href="#navbar-categories" data-toggle="collapse" role="button" aria-expanded="{{ (\Request::routeIs('categories.*')) ? 'true' : 'false' }}" aria-controls="navbar-categories">
    <i class="ni ni-archive-2 text-pink"></i>
    <span class="nav-link-text">{{ __('Categories') }}</span>
</a>
<div class="collapse {{ (\Request::routeIs('categories.*')) ? 'show' : '' }}" id="navbar-categories">
    <ul class="nav nav-sm flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index') }}">
                {{ __('List') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.create') }}">
                {{ __('Create') }}
            </a>
        </li>
    </ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link {{ (\Request::routeIs('questions.*')) ? 'active' : '' }}" href="#navbar-questions" data-toggle="collapse" role="button" aria-expanded="{{ (\Request::routeIs('questions.*')) ? 'true' : 'false' }}" aria-controls="navbar-questions">
    <i class="ni ni-air-baloon text-success"></i>
    <span class="nav-link-text">{{ __('Questions') }}</span>
</a>
<div class="collapse {{ (\Request::routeIs('questions.*')) ? 'show' : '' }}" id="navbar-questions">
    <ul class="nav nav-sm flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('questions.index') }}">
                {{ __('List') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('questions.create') }}">
                {{ __('Create') }}
            </a>
        </li>
    </ul>
</div>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('quiz.index') }}">
        <i class="ni ni-hat-3 text-warning"></i> {{ __('Quiz') }}
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('settings.index') }}">
        <i class="ni ni-settings-gear-65 text-primary"></i> {{ __('Settings') }}
    </a>
</li>
