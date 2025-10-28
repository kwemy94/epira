@extends('layouts.app')

@section('admin-css')
@endsection

@section('admin-content')
    <x-page-header title="Détail patient" :breadcrumbs="[
        [
            'label' => 'Patient',
            'url' => route('patient.index'),
        ],
        ['label' => 'Détail'],
    ]" />
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-lg-12">
                <nav class="navbar navbar-expand navbar-white navbar-light">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-sm-inline-block active" id="home-data">
                            <a href="#" class="nav-link">Données administratives</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block" id="interoMedi">
                            <a href="#" class="nav-link">Intérogation médicale</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Rendez-vous</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Historique documents</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block" id ="prestations">
                            <a href="#" class="nav-link">Prestations médicales</a>
                        </li>
                    </ul>

                </nav>
            </div>
        </div>
    </div>

    <section class="content mb-2">
        <div class="container-fluid p-3" style="background-color: white">
            <div class="row">
                <div class="col-sm-4">
                    <h5><strong style="color:rgb(69, 156, 236)">{{ $patient->lastname }} {{ $patient->firstname }}</strong>
                        -
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
                    <h6><strong>Statut matrimonial</strong>
                        :{{ isset($patient->matrimonial->name) ? $patient->matrimonial->name : '' }}</h6>
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
                        <div class="card-header p-0 border-bottom-0" id="admin-data-header">
                            @include('dashboard.patient.partials._navigation-title-1')
                        </div>

                        <div class="card-header p-0 border-bottom-0" hidden id="interro-medical-header">
                            @include('dashboard.patient.partials._navigation-title-2')
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
                                        @method('patch')
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

                            @include('dashboard.patient.partials._interrogation-medical')
                            @include('dashboard.patient.partials._prestations')

                        </div>
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

        $('#interoMedi').click(() => {
            $('#admin-data-header').attr('hidden', true);
            $('#interoMedi').addClass('active');

            $('#interro-medical-header').attr('hidden', false);
            $('#home-data').removeClass('active');
            $('#prestations').removeClass('active');
            $('#custom-tabs-four-tabContent').attr('hidden', true);
            $('#prestations-content').attr('hidden', true);
            $('#custom-tabs-four-tabContent2').attr('hidden', false);
        });

        $('#home-data').click(() => {
            $('#admin-data-header').attr('hidden', false);
            $('#interoMedi').removeClass('active');

            $('#interro-medical-header').attr('hidden', true);
            $('#home-data').addClass('active');
            $('#prestations').removeClass('active');
            $('#custom-tabs-four-tabContent').attr('hidden', false);
            $('#custom-tabs-four-tabContent2').attr('hidden', true);
            $('#prestations-content').attr('hidden', true);
        })
        $('#prestations').click(() => {
            $('#admin-data-header').attr('hidden', true);
            $('#interoMedi').removeClass('active');

            $('#interro-medical-header').attr('hidden', true);
            $('#home-data').removeClass('active');
            $('#prestations').addClass('active');

            $('#custom-tabs-four-tabContent').attr('hidden', true);
            $('#custom-tabs-four-tabContent2').attr('hidden', true);
            $('#prestations-content').attr('hidden', false);
        });

        $('#savePathologyBtn').click((e) => {
            e.preventDefault();
            if (!ControlRequiredFields($('#formPathology .required'))) {
                return -1;
            }

            console.log($('#choosePat').val());
            let selectVal = $('#choosePat').val() ? $('#choosePat').val().trim() : '';
            let newPat = $('#newPat').val() ? $('#newPat').val().trim() : '';

            if (selectVal === '' && newPat === '') {
                alert('Créer une pathologie ou choisir parmis les existantes');
                return -1;
            }

            $('#formPathology').submit();
        });
    </script>
    <script>
        $(document).ready(function() {
            console.log("start");

            // Mode création
            $('#saveContactBtn').click((e) => {
                e.preventDefault();
                if (!ControlRequiredFields($('#formContact .required'))) {
                    return -1;
                }

                $('#formContact').submit();
            });

            // Quand on clique sur "modifier"
            $('.btn-edit-contact').on('click', function(e) {
                e.preventDefault();
                console.log("dsf 1");
                // Récupérer les données
                let id = $(this).data('id');
                let name = $(this).data('name');
                let type = $(this).data('type');
                let phone = $(this).data('phone');
                let other_phone = $(this).data('other-phone');
                let job = $(this).data('job');
                let employer = $(this).data('employer');
                let address = $(this).data('address');

                // Modifier le titre du modal
                $('#contactModalTitle').text('Modifier le contact');
                console.log("dsf 2");

                // Remplir les champs
                $('input[name="contact_name"]').val(name);
                $('select[name="contact_type_id"]').val(type).trigger('change');
                $('input[name="contact_phone"]').val(phone);
                $('input[name="contact_other_phone"]').val(other_phone);
                $('input[name="contact_job"]').val(job);
                $('input[name="contact_employer"]').val(employer);
                $('input[name="contact_address"]').val(address);
                $('#contact_id').val(id);
                console.log("dsf 3");

                // Changer l’action du formulaire vers la route "update"
                $('#formContact').attr('action', '/contact/' + id);
                $('#formContact').append('<input type="hidden" name="_method" value="PUT">');

                // Ouvrir le modal
                console.log("dsf 4");
                $('#new-contact').modal('show');
            });

            // Quand on ferme le modal → réinitialiser le formulaire
            $('#new-contact').on('hidden.bs.modal', function() {
                $('#formContact')[0].reset();
                $('#contactModalTitle').text('Nouveau contact');
                $('#contact_id').val('');
                $('#formContact').attr('action', '{{ route('contact.store') }}');
                $('#formContact input[name="_method"]').remove();
            });

        })
    </script>

    {{-- script detail contact --}}
    <script>
        $(document).ready(function() {
            $('.btn-show-contact').on('click', function(e) {
                e.preventDefault();
                let contactId = $(this).data('id');

                // Afficher le modal immédiatement avec "Chargement..."
                $('#contactDetails').html(
                    '<tr><td colspan="2" class="text-center text-muted">Chargement...</td></tr>');
                $('#showContactModal').modal('show');

                // Requête AJAX pour récupérer les détails du contact
                $.ajax({
                    url: '/contact/' + contactId, // route('contact.show')
                    type: 'GET',
                    success: function(response) {
                        // Vérifie si tu renvoies du JSON
                        let contact = response.contact ?? response;
                        console.log(contact);

                        let html = `
                    <tr><th>Nom complet</th><td>${contact.contact_name ?? ''}</td></tr>
                    <tr><th>Type</th><td>${contact.type_contact?.type_name ?? ''}</td></tr>
                    <tr><th>Profession</th><td>${contact.contact_job ?? ''}</td></tr>
                    <tr><th>Employeur</th><td>${contact.contact_employer ?? ''}</td></tr>
                    <tr><th>Adresse</th><td>${contact.contact_address ?? ''}</td></tr>
                    <tr><th>Téléphone principal</th><td>${contact.contact_phone ?? ''}</td></tr>
                    <tr><th>Autre téléphone</th><td>${contact.contact_other_phone ?? ''}</td></tr>
                `;

                        $('#contactDetails').html(html);
                    },
                    error: function() {
                        $('#contactDetails').html(
                            '<tr><td colspan="2" class="text-center text-danger">Erreur lors du chargement des données</td></tr>'
                        );
                    }
                });
            });
        });
    </script>


    {{-- script detail insurer --}}
    <script>
        $(document).ready(function() {
            $('.btn-show-insurer').on('click', function(e) {
                e.preventDefault();
                let insurerId = $(this).data('id');

                // Afficher le modal immédiatement avec "Chargement..."
                $('#insurerDetails').html(
                    '<tr><td colspan="2" class="text-center text-muted">Chargement...</td></tr>');
                $('#showInsurerModal').modal('show');


                $.ajax({
                    url: '/insurer/' + insurerId,
                    success: function(response) {
                        // Vérifie si tu renvoies du JSON
                        let insurer = response.insurer ?? response;
                        console.log(insurer);

                        let html = `
                    <tr><th>Assureur</th><td>${insurer.insurer_name ?? ''}</td></tr>
                    <tr><th>Employeur</th><td>${insurer.insurer_employer ?? ''}</td></tr>
                    <tr><th>Validité</th><td>${insurer.start_date ?? ''} - ${insurer.end_date?? ''}</td></tr>
                    <tr><th>Numéro d'assuré</th><td>${insurer.insurance_number ?? ''}</td></tr>
                    <tr><th>Numéro de carte</th><td>${insurer.card_number ?? ''}</td></tr>
                    <tr><th>Pourcentage</th><td>${insurer.percentage ?? ''}</td></tr>
                    <tr><th>Plafond</th><td>${insurer.max_insurance ?? ''}</td></tr>
                `;

                        $('#insurerDetails').html(html);
                    },
                    error: function() {
                        $('#insurerDetails').html(
                            '<tr><td colspan="2" class="text-center text-danger">Erreur lors du chargement des données</td></tr>'
                        );
                    }
                });
            });

            $('.btn-show-prestation').on('click', function(e) {
                e.preventDefault();
                let insurerId = $(this).data('id');

                // Afficher le modal immédiatement avec "Chargement..."
                $('#prestationDetails').html(
                    '<tr><td colspan="2" class="text-center text-muted">Chargement...</td></tr>');
                $('#showPrestationModal').modal('show');


                $.ajax({
                    url: '/prestation/' + insurerId,
                    success: function(response) {
                        // Vérifie si tu renvoies du JSON
                        let insurer = response.insurer ?? response;
                        console.log(insurer);

                        let html = `
                    <tr><th>Nom</th><td>${insurer.name ?? ''}</td></tr>
                    <tr><th>Description</th><td>${insurer.description ?? ''}</td></tr>
                    <tr><th>patient</th><td>${insurer.patient_id ?? ''}</td></tr>
                    <tr><th>Assureur</th><td>${insurer.insurer_id ?? ''}</td></tr>
                       `;

                        $('#prestationDetails').html(html);
                    },
                    error: function() {
                        $('#prestationDetails').html(
                            '<tr><td colspan="2" class="text-center text-danger">Erreur lors du chargement des données</td></tr>'
                        );
                    }
                });
            });
        });
    </script>


    {{-- edit insurer --}}
    <script>
        $(document).ready(function() {
            console.log("start");

            // Mode création
            $('#saveInsurerBtn').click((e) => {
                e.preventDefault();
                if (!ControlRequiredFields($('#formInsurer .required'))) {
                    return -1;
                }

                $('#formInsurer').submit();
            })
            $('#savePrestationBtn').click((e) => {
                e.preventDefault();
                if (!ControlRequiredFields($('#formPrestation .required'))) {
                    return -1;
                }

                $('#formPrestation').submit();
            })

            // Quand on clique sur "modifier"
            $('.btn-edit-insurer').on('click', function(e) {
                e.preventDefault();
                console.log("ins 1");
                // Récupérer les données
                let id = $(this).data('id');
                let insurer_name = $(this).data('insurer_name');
                let insurer_employer = $(this).data('insurer_employer');
                let start_date = $(this).data('start_date');
                let end_date = $(this).data('end_date');
                let insurance_number = $(this).data('insurance_number');
                let card_number = $(this).data('card_number');
                let percentage = $(this).data('percentage');
                let max_insurance = $(this).data('max_insurance');

                // Modifier le titre du modal
                $('#insurerModalTitle').text("Modifier l'assureur");
                console.log("ins 2");
                console.log(start_date);

                // Remplir les champs
                $('input[name="insurer_name"]').val(insurer_name);
                $('input[name="insurer_employer"]').val(insurer_employer);
                $('input[name="start_date"]').val(start_date);
                $('input[name="end_date"]').val(end_date);
                $('input[name="insurance_number"]').val(insurance_number);
                $('input[name="card_number"]').val(card_number);
                $('input[name="percentage"]').val(percentage);
                $('input[name="max_insurance"]').val(max_insurance);
                $('#contact_id').val(id);
                console.log("ins 3");

                // Changer l’action du formulaire vers la route "update"
                $('#formInsurer').attr('action', '/insurer/' + id);
                $('#formInsurer').append('<input type="hidden" name="_method" value="PUT">');

                // Ouvrir le modal
                console.log("ins 4");
                $('#new-insurer').modal('show');
            });

            // Quand on clique sur "modifier" de la prestation
            $('.btn-edit-prestation').on('click', function(e) {
                e.preventDefault();
                // Récupérer les données
                let id = $(this).data('id');
                let name = $(this).data('name');
                let description = $(this).data('description');
                let patient_id = $(this).data('patient_id');
                let insurer_id = $(this).data('insurer_id');

                // Modifier le titre du modal
                $('#prestationModalTitle').text("Modifier la prestation");


                // Remplir les champs
                $('input[name="name"]').val(name);
                $('input[name="description"]').val(description);
                $('#patient_id').val(patient_id);
                $('#insurer_id').val(insurer_id);

                // Changer l’action du formulaire vers la route "update"
                $('#formPrestation').attr('action', '/prestation/' + id);
                $('#formPrestation').append('<input type="hidden" name="_method" value="PUT">');

                $('#new-prestation').modal('show');
            });

            // Quand on ferme le modal → réinitialiser le formulaire
            $('#new-insurer').on('hidden.bs.modal', function() {
                $('#formInsurer')[0].reset();
                $('#insurerModalTitle').text('Nouveau assureur');
                $('#insurer_id').val('');
                $('#formInsurer').attr('action', '{{ route('insurer.store') }}');
                $('#formInsurer input[name="_method"]').remove();
            });

            // Quand on ferme le modal → réinitialiser le formulaire
            $('#new-prestation').on('hidden.bs.modal', function() {
                $('#formPrestation')[0].reset();
                $('#prestationModalTitle').text('Nouvelle prestation');
                $('#insurer_id').val('');
                $('#formPrestation').attr('action', '{{ route('prestation.store') }}');
                $('#formPrestation input[name="_method"]').remove();
            });


        })
    </script>
@endsection
