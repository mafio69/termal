<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{ Auth::user()->name}} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
	@if((auth()->user()->role->type == 'admin') || (auth()->user()->role->type == 'moderator'))
            <li><a href="/users/create"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj użytkownika</a></li>
	@endif 
        <li><a href="{{ url('/notes/55/create')}}"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj klienta</a></li>
        <li><a href="{{ url('/customers/create')}}"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj notatkę</a></li>
        <li role="separator" class="divider"></li>
        <li>
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>