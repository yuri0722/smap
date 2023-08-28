    <ul class="navbar-nav ml-auto">
        @include('partes.modulo')
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

                @if(Auth::user()->nomeFotoPerfil()!="")
                    <img class="user-image img-circle elevation-2" src="/img/users/{{Auth::user()->id}}/p/{{Auth::user()->nomeFotoPerfil()}}" >

                @else
                    <img class="user-image img-circle elevation-2" src="/img/avatarm.png" >
                @endif
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">

                    @if(Auth::user()->nomeFotoPerfil()!="")
                        <img class="img-circle elevation-2" src="/img/users/{{Auth::user()->id}}/l/{{Auth::user()->nomeFotoPerfil()}}" >

                    @else
                        <img class="img-circle elevation-2" src="/img/avatarm.png" >
                    @endif
                    <p>
                        {{ Auth::user()->name }}
                        <small>Usuário desde {{ Auth::user()->created_at->format('M. Y') }}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{route('smap.perfil')}}" class="btn btn-default btn-flat">Perfil</a>
                    <a href="#" class="btn btn-default btn-flat float-right"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Sign out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>

