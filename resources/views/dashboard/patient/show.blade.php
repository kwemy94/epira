@extends('layouts.app')


@section('admin-content')
    <x-page-header title="Détail patient" :breadcrumbs="[
        [
            'label' => 'Patient',
            'url' => route('patient.index'),
        ],
        ['label' => 'Détail'],
    ]" />

    <section class="content mb-2">
        <div class="container-fluid p-3" style="background-color: white">
            <div class="row">
                <div class="col-sm-4">
                    <h5><strong style="color:rgb(69, 156, 236)">{{ $patient->lastname }} {{ $patient->firstname }}</strong> -
                        {{ $patient->age }} an(s)</h5>
                    <h6><strong>Sexe :</strong>{{ $patient->sexe }}</h6>
                    <h6><strong>Référence : </strong>{{ $patient->reference }}</h6>
                    <h6><strong>Référence interne :</strong>{{ $patient->intern_reference }}</h6>
                    <h6><strong>Adresse : </strong>{{ $patient->adress }}</h6>
                </div>
                <div class="col-sm-4">
                    <h6><strong>Date de naissance</strong> :{{ $patient->birth_date }}</h6>
                    <h6><strong>Numéro mobile</strong> :{{ $patient->phone }}</h6>
                    <h6><strong>Autre numéro</strong> :{{ $patient->other_phone }}</h6>
                    <h6><strong>Email</strong> :{{ $patient->email }}</h6>
                    <h6><strong>profession : </strong>{{ $patient->job }}</h6>
                </div>
                <div class="col-sm-4">
                    <h6><strong>Nom de jeune fille</strong> :{{ $patient->maiden_name }}</h6>
                    <h6><strong>Statut matrimonial</strong> :{{ $patient->matrimonial->name }}</h6>
                    <h6><strong>Nom de la mère</strong> :{{ $patient->mother_name }}</h6>
                    <h6><strong>Nom du père</strong> :{{ $patient->father_name }}</h6>
                    <h6><strong>Nationalité</strong> :{{ $patient->nationality }}</h6>
                </div>
            </div>
        </div>
    </section>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                        aria-selected="true">Information prinipale</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                        href="#custom-tabs-four-messages" role="tab"
                                        aria-controls="custom-tabs-four-messages"
                                        aria-selected="false">Contact/Filiation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                        href="#custom-tabs-four-settings" role="tab"
                                        aria-controls="custom-tabs-four-settings" aria-selected="false">Prise en charge</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            @php
                                $edit = true;
                            @endphp
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-home-tab">
                                    <form action="{{ route('patient.update', $patient->id) }}" method="POST">
                                        @csrf
                                        <p class="text-primary" style="font-weight: bold">
                                            Identité du patient - Informations Principales
                                        </p>
                                        @include('dashboard.patient.partials._part1', ['edit' => $edit])
                                        <p class="text-primary" style="font-weight: bold">
                                            Identité du patient - Informations Complémentaires
                                        </p>
                                        @include('dashboard.patient.partials._part2', ['edit' => $edit])

                                        <div class="row" style="justify-content: center">
                                            <button class="btn btn-primary btn-sm" id="saveBtn1">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-profile-tab">
                                    <form action="{{ route('patient.update', $patient->id) }}" method="POST">
                                        @csrf
                                        @include('dashboard.patient.partials._part2', ['edit' => $edit])
                                        <div class="row" style="justify-content: center">
                                            <button class="btn btn-primary btn-sm" id="saveBtn2">Enregistrer</button>
                                        </div>
                                    </form>
                                </div> --}}
                                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-messages-tab">

                                    @include('dashboard.patient.partials._listing_contact', [
                                        'edit' => $edit,
                                    ])


                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-settings-tab">


                                    @include('dashboard.patient.partials._listing_insurer', [
                                        'edit' => $edit,
                                    ])

                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-js')
    <script>
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            if (confirm('Voulez-vous vraiment supprimer ce contact ?')) {
                $('#delete-form-' + id).submit();
            }
        });

        $(document).on('click', '.btn-delete-insurer', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            if (confirm('Voulez-vous vraiment supprimer cet assureur ?')) {
                $('#delete-form-insurer-' + id).submit();
            }
        });

        $('#saveContactBtn').click((e) => {
            e.preventDefault();
            if (!ControlRequiredFields($('#formContact .required'))) {
                return -1;
            }

            $('#formContact').submit();
        });

        $('#saveInsurerBtn').click((e) => {
            e.preventDefault();
            if (!ControlRequiredFields($('#formInsurer .required'))) {
                return -1;
            }

            $('#formInsurer').submit();
        })
    </script>
@endsection
