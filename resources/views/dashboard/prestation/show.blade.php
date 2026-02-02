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
    <x-page-header title="" :breadcrumbs="[
        [
            'label' => 'Prestation',
            'url' => route('prestation.index'),
        ],
        ['label' => 'Détails prestation : ' . ($current?->reference ?? '—')],
    ]" />

    <div class="card mb-3">
        <div class="card-body p-3">
            @include('dashboard.prestation.partials._header_navigation', [
                'active' => $prestation->type->code ?? 'consultation',
                'devis' => $prestation->type->code,
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

                    <div class="card shadow-sm rounded-3 mx-auto" style="max-width: 700px;">
                        <div class="card-header py-2 bg-info-light">
                            <strong class="m-0">Prise en charge / Tarif</strong>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                @php
                                    use Carbon\Carbon;
                                    $validInsurance = Carbon::parse($prestation?->insurer->end_date) > now();

                                @endphp
                                <div class="col-6 col-md-6 mb-6 mb-md-0">
                                    <p class="mb-2">Prise en charge en cours de validité</p>
                                </div>
                                <div class="col-6 col-md-6 mb-6 mb-md-0">
                                    <p class="mb-2 fw-bold">{{ $prestation?->insurer->insurer_name ?? '-' }}</p>
                                </div>
                                <div class="col-6 col-md-6 mb-6 mb-md-0">
                                    <p class="mb-2">Période de validité</p>
                                </div>
                                <div class="col-6 col-md-6 mb-6 mb-md-0">
                                    <div class="value-box mb-2">{{ $prestation?->insurer->start_date ?? '-' }} -
                                        {{ $prestation?->insurer->end_date ?? '-' }}</div>
                                </div>

                                <div class="col-6 col-md-6 mb-6 mb-md-0">
                                    <p class="mb-2">Pourcentage pris en charge</p>
                                </div>
                                <div class="col-6 col-md-6 mb-6 mb-md-0">
                                    <div class="value-box mb-2"> {{ $prestation?->insurer->percentage ?? '-' }} </div>
                                </div>
                                <div class="col-6 col-md-6 mb-6 mb-md-0">
                                    <p class="mb-2">Plafond</p>
                                </div>
                                <div class="col-6 col-md-6 mb-6 mb-md-0">
                                    <div class="value-box mb-2"> {{ $prestation?->insurer->max_insurance ?? '-' }} </div>
                                </div>
                                <div class="col-6 col-md-6 mb-6 mb-md-0">
                                    <p class="mb-2">Tarifs disponibles</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    

                </section>

                <!-- SECTION DOCUMENTS -->
                <section id="documents" class="menu-section d-none">

                </section>

                <!-- SECTION HONORAIRES -->
                <section id="honoraires" class="menu-section d-none">

                </section>

                <!-- SECTION Facturation -->
                <section id="facturation" class="menu-section {{ $prestation->type->code !== 'devis' ? '' : 'd-none' }}">
                    @include('dashboard.prestation.partials._facturation')

                </section>

                <!-- SECTION T -->
                <section id="teletransmission" class="menu-section d-none">

                </section>
                <!-- SECTION OPÉRATIONS -->
                <section id="paiement" class="menu-section d-none">

                </section>
                <section id="reponses" class="menu-section {{ $prestation->type->code === 'devis' ? '' : 'd-none' }}">
                    <h5>resp session</h5>
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
