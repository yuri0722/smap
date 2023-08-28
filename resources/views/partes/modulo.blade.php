<li class="dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
       aria-expanded="false">
        <span class="name"> Módulos </span>
    </a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu1">

        <a class="dropdown-item" href="{{route('smap')}}">
            <i class="fa fa-user"></i> Geral
        </a>
        <div class="dropdown-divider"></div>
        @if(Auth::user()->is_admin || Auth::user()->md_animal)
            <a class="dropdown-item" href="{{route('bemestar')}}">
                <i class="fa fa-paw"></i> Bem estar animal
            </a>
            <div class="dropdown-divider"></div>
        @endif
        @if(Auth::user()->is_admin)
            <a class="dropdown-item" href="{{route('admin')}}">
                <i class="fa fa-lock"></i> Admin
            </a>
            <div class="dropdown-divider"></div>
        @endif
        @if(Auth::user()->id==2)
            <a class="dropdown-item" href="{{route('agro')}}">
                <i class="fa fas fa-carrot"></i> Agricultura
            </a>
            <div class="dropdown-divider"></div>
        @endif
    </div>
</li>
