<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item  d-flex align-items-center">
            <a class="nav-link d-md-none" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>

            {{-- Titre (caché sur mobile) --}}
            <h5 class="ml-2 d-none d-md-block">Centre Hospitalier Régional d’Ebolowa</h5>
            <h6 class="ml-2 d-md-none">CHRE</h6>
        </li>
    </ul>




    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('logo_chre2.png') }}" class="user-image img-circle elevation-2"
                    alt="User Image">
                <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'Utilisateur' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ asset('logo_chre2.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                    <p>
                        {{ Auth::user()->name ?? 'Utilisateur' }}
                        <small>
                            {{ Auth::user()->email ?? '...' }}
                        </small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profil</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>

    </ul>
</nav>
