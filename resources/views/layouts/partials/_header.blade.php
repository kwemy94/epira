<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>




    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('badge.png') }}" class="user-image img-circle elevation-2"
                    alt="User Image">
                <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'Utilisateur' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ asset('badge.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                    <p>
                        {{ Auth::user()->name ?? 'Utilisateur' }}
                        <small>Membre depuis ...
                            {{-- {{ Auth::user()->created_at->format('M Y') ?? '...' }} --}}
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
