<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('logo_chre2.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('patient.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Patient</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Catégorie</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('prestation.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>Prestation</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Personnel
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('specialization-host.index') }}" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Spécialisation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('staff-type-host.index') }}" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Type de personnel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pro-title-host.index') }}" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Titre professionnel</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('staff-host.index') }}" class="nav-link">
                                <i class="fas fa-user-md nav-icon"></i>
                                <p>Personnels de santé</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
