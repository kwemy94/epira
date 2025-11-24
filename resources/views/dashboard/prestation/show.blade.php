@extends('layouts.app')

@section('admin-css')
    <style>
        .bg-info-light {
            background: #cde4fb;
        }

        .value-box {
            background: #d9dbe2;
            padding: 8px;
            border-radius: 5px;
        }
    </style>
@endsection

@section('admin-content')
    <x-page-header title="Détails prestation" :breadcrumbs="[
        [
            'label' => 'Prestation',
            'url' => route('prestation.index'),
        ],
        ['label' => 'Détails'],
    ]" />

    <div class="card mb-3">
        <div class="card-body p-3">
            @include('dashboard.prestation.partials._header_navigation', [
                'active' => $active ?? 'consultation',
            ])
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="p-3">
                @include('dashboard.prestation.partials._general_information', [
                    'type' => 'facturation',
                ])

                <!-- SECTION MÉDICAMENTS -->
                <section id="medicaments" class="menu-section d-none">

                </section>

                <!-- SECTION DOCUMENTS -->
                <section id="documents" class="menu-section d-none">

                </section>

                <!-- SECTION HONORAIRES -->
                <section id="honoraires" class="menu-section d-none">

                </section>

                <!-- SECTION Facturation -->
                <section id="facturation" class="menu-section">
                    @include('dashboard.prestation.partials._facturation')

                </section>

                <!-- SECTION T -->
                <section id="teletransmission" class="menu-section d-none">

                </section>
                <!-- SECTION OPÉRATIONS -->
                <section id="paiement" class="menu-section d-none">

                </section>
    </section>

    </div>


    </div>
    </section>
@endsection


@section('admin-css')
    <style>
        /* STYLE POUR REPRODUIRE EXACTEMENT LA MISE EN PAGE */
        .card-section {
            margin-bottom: 25px;
        }

        /* hauteur fixe pour aligner les deux cartes du haut */
        .card-identite,
        .card-pharmacie {
            min-height: 260px;
        }

        /* bloc Tarif centré comme sur ta capture */
        .tarif-box {
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
        }
    </style>
@endsection

@section('admin-js')
    <script>
        document.querySelectorAll('#menuTabs .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                // Retirer la classe active du menu
                document.querySelector('#menuTabs .active').classList.remove('active');
                this.classList.add('active');

                // Cacher toutes les sections
                document.querySelectorAll('.menu-section').forEach(sec => sec.classList.add('d-none'));

                // Afficher la section ciblée
                const target = this.getAttribute('data-target');
                document.querySelector(target).classList.remove('d-none');
            });
        });
    </script>
@endsection
