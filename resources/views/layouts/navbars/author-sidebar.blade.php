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
