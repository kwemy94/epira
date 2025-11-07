@extends('layouts.app')

@section('admin-content')
    <x-page-header
        title="{{ isset($staff) ? 'Modication du profesionnel de la santé' : 'Création du profesionnel de la santé' }}"
        :breadcrumbs="[['label' => 'Personnel', 'url' => route('staff-host.index')], ['label' => 'Nouveau']]" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">

                        {{-- Onglets --}}
                        <div class="card-header p-0 border-bottom-0" id="admin-data-header">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="identity-tab" data-toggle="pill" href="#identity"
                                        role="tab" aria-controls="identity" aria-selected="true">
                                        Identité
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="coordinates-tab" data-toggle="pill" href="#coordinates"
                                        role="tab" aria-controls="coordinates" aria-selected="false">
                                        Coordonnées
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="photo-tab" data-toggle="pill" href="#photo" role="tab"
                                        aria-controls="photo" aria-selected="false">
                                        Photo
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- Contenu des onglets --}}
                        <div class="card-body">
                            @if (isset($staff))
                                <form action="{{ route('staff-host.update', $staff->id) }}" id="formPersonnal"
                                    method="POST" enctype="multipart/form-data">
                                @else
                                    <form action="{{ route('staff-host.store') }}" id="formPersonnal" method="POST"
                                        enctype="multipart/form-data">
                            @endif
                            @csrf

                            @if (isset($staff))
                                @method('PUT')
                            @endif

                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                {{-- Onglet Identité --}}
                                <div class="tab-pane fade show active" id="identity" role="tabpanel"
                                    aria-labelledby="identity-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Nom <em class="text-danger">*</em></label>
                                                <input type="text" class="form-control required" id="name"
                                                    name="lastname" value="{{ old('lastname', $staff->lastname ?? '') }}"
                                                    autofocus>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pname">Prénom</label>
                                                <input type="text" class="form-control" id="pname" name="firstname"
                                                    value="{{ old('firstname', $staff->firstname ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sexe">Sexe <em class="text-danger">*</em></label>
                                                <select id="sexe" class="form-control select2 required" name="sexe"
                                                    required>
                                                    <option disabled
                                                        {{ old('sexe', $staff->sexe ?? '') == '' ? 'selected' : '' }}>
                                                        Choisir le sexe</option>
                                                    <option value="Féminin"
                                                        {{ old('sexe', $staff->sexe ?? '') == 'Féminin' ? 'selected' : '' }}>
                                                        Féminin</option>
                                                    <option value="Masculin"
                                                        {{ old('sexe', $staff->sexe ?? '') == 'Masculin' ? 'selected' : '' }}>
                                                        Masculin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email <em class="text-danger">*</em></label>
                                                <input type="email" class="form-control required" id="email"
                                                    name="email" value="{{ old('email', $staff->email ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="staff_type_id">Profession <em class="text-danger">*</em></label>
                                                <select id="staff_type_id" class="form-control select2 required"
                                                    name="staff_type_id">
                                                    <option disabled
                                                        {{ old('staff_type_id', $staff->staff_type_id ?? '') == '' ? 'selected' : '' }}>
                                                        Choisir ...</option>
                                                    @foreach ($staffTypes as $pro)
                                                        <option value="{{ $pro->id }}"
                                                            {{ old('staff_type_id', $staff->staff_type_id ?? '') == $pro->id ? 'selected' : '' }}>
                                                            {{ $pro->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="specialization_id">Spécialisation <em
                                                        class="text-danger">*</em></label>
                                                <select id="specialization_id" class="form-control select2 required"
                                                    name="specialization_id">
                                                    <option disabled
                                                        {{ old('specialization_id', $staff->specialization_id ?? '') == '' ? 'selected' : '' }}>
                                                        Choisir ...</option>
                                                    @foreach ($specializations as $specialization)
                                                        <option value="{{ $specialization->id }}"
                                                            {{ old('specialization_id', $staff->specialization_id ?? '') == $specialization->id ? 'selected' : '' }}>
                                                            {{ $specialization->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="profesionnal_title_id">Titre <em
                                                        class="text-primary">*</em></label>
                                                <select id="profesionnal_title_id" class="form-control select2 required"
                                                    name="profesionnal_title_id" required>
                                                    <option disabled
                                                        {{ old('profesionnal_title_id', $staff->profesionnal_title_id ?? '') == '' ? 'selected' : '' }}>
                                                        Choisir ...</option>
                                                    @foreach ($profesionnalTitles as $title)
                                                        <option value="{{ $title->id }}"
                                                            {{ old('profesionnal_title_id', $staff->profesionnal_title_id ?? '') == $title->id ? 'selected' : '' }}>
                                                            {{ $title->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group position-relative">
                                                <label for="password">Mot de passe</label>
                                                <input type="password"
                                                    class="form-control {{ isset($staff) ? '' : 'required' }}"
                                                    id="password" name="password" value=""
                                                    @if (isset($staff)) disabled @endif>

                                                @if (isset($staff))
                                                    <button type="button" id="editPasswordBtn"
                                                        class="btn btn-outline-primary btn-sm mt-2">
                                                        <i class="fas fa-lock-open me-1"></i> Modifier le mot de passe
                                                    </button>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="confirm_password">Confirmation mot de passe</label>
                                                <input type="password"
                                                    class="form-control {{ isset($staff) ? '' : 'required' }}"
                                                    id="confirm_password" name="confirm_password" value=""
                                                    @if (isset($staff)) disabled @endif>
                                            </div>
                                            <!-- Zone de message -->
                                            <div id="message" class="mt-2"></div>
                                        </div>


                                        <div class="col-md-4" hidden id="field_generic">
                                            <div class="form-group">
                                                <label for="appointment_max">Rendez-vous en parallèle</label>
                                                <input type="number" class="form-control" id="appointment_max"
                                                    min="1" name="appointment_max"
                                                    value="{{ old('appointment_max', $staff->appointment_max ?? '') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="int"
                                                    {{ old('intern', $staff->intern ?? false) ? 'checked' : '' }}
                                                    name="intern">
                                                <label class="form-check-label" for="int">Interne</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" id="compte-generic" type="checkbox"
                                                    value="1"
                                                    {{ old('generic_account', $staff->generic_account ?? false) ? 'checked' : '' }}
                                                    name="generic_account">
                                                <label class="form-check-label" for="compte-generic">Compte
                                                    générique</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="apph"
                                                    {{ old('honorary_appointment', $staff->honorary_appointment ?? false) ? 'checked' : '' }}
                                                    name="honorary_appointment">
                                                <label class="form-check-label" for="apph">Autoriser honoraire</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="autAp"
                                                    {{ old('authorize_appointment', $staff->authorize_appointment ?? false) ? 'checked' : '' }}
                                                    name="authorize_appointment">
                                                <label class="form-check-label" for="autAp">Autoriser la prise de
                                                    rendez-vous</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Onglet Coordonnées --}}
                                <div class="tab-pane fade" id="coordinates" role="tabpanel"
                                    aria-labelledby="coordinates-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Téléphone mobile <em
                                                        class="text-danger">*</em></label>
                                                <input type="tel" class="form-control required" id="phone"
                                                    name="phone" value="{{ old('phone', $staff->phone ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fix_phone">Téléphone fixe</label>
                                                <input type="tel" class="form-control" id="fix_phone"
                                                    name="fix_phone"
                                                    value="{{ old('fix_phone', $staff->fix_phone ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Adresse </label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ old('address', $staff->address ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Onglet Photo --}}
                                @php

                                    $photoExistante =
                                        isset($staff) && $staff->avatar ? asset('storage/' . $staff->avatar) : null;
                                @endphp
                                <div class="tab-pane fade" id="photo" role="tabpanel" aria-labelledby="photo-tab">
                                    <div id="actions" class="row justify-content-center">
                                        <div class="col-md-6 text-center">
                                            <div class="card shadow-sm p-3">
                                                <div class="card p-3">
                                                    <div class="form-group text-center">
                                                        <label for="photo_personnel"
                                                            class="form-label font-weight-bold">Photo du personnel</label>

                                                        <div id="dropzone"
                                                            class="border border-dashed rounded-lg d-flex justify-content-center align-items-center mb-2"
                                                            style="height:200px; border: 2px dashed #999; background-color:#f8f9fa; cursor:pointer;">
                                                            <img id="preview" src="{{ $photoExistante }}"
                                                                alt="Aperçu"
                                                                style="max-height:100%; {{ $photoExistante ? '' : 'display:none;' }}">
                                                            <span id="placeholder" class="text-muted"
                                                                style="{{ $photoExistante ? 'display:none;' : '' }}">
                                                                Glissez une image ici ou utilisez le bouton ci-dessous
                                                            </span>
                                                        </div>

                                                        <input type="file" id="photo_input" name="photo"
                                                            accept="image/png,image/jpeg" style="display:none;">

                                                        <button type="button" id="upload_btn"
                                                            class="btn btn-success btn-block">
                                                            <i class="fas fa-upload"></i> Sélectionner une photo
                                                        </button>

                                                        <small class="form-text text-muted mt-2">
                                                            Formats acceptés : JPG, PNG — Taille max : 2 Mo
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row mt-4" style="justify-content: center">
                                <button class="btn btn-primary btn-sm" id="savePersonnalBtn">Enregistrer</button>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropzone = document.getElementById('dropzone');
            const input = document.getElementById('photo_input');
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('placeholder');
            const uploadBtn = document.getElementById('upload_btn');

            // Ouvrir le sélecteur de fichier
            uploadBtn.addEventListener('click', () => input.click());

            // Quand un fichier est sélectionné
            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    afficherImage(this.files[0]);
                }
            });

            // Gérer le drag & drop
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.style.borderColor = '#28a745';
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.style.borderColor = '#999';
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.style.borderColor = '#999';
                const file = e.dataTransfer.files[0];
                if (file) {
                    input.files = e.dataTransfer.files; // Pour la soumission via form
                    afficherImage(file);
                }
            });

            // Fonction d’affichage de l’image
            function afficherImage(file) {
                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    alert("Format invalide. Seuls JPG et PNG sont acceptés.");
                    input.value = "";
                    return;
                }

                if (file.size > 2 * 1024 * 1024) { // 2 Mo
                    alert("La taille maximale autorisée est de 2 Mo.");
                    input.value = "";
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                    placeholder.style.display = "none";
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script>
        $(document).ready(function() {



            $('#savePersonnalBtn').click((e) => {
                e.preventDefault(); // Empêche la soumission automatique

                if (!ControlRequiredFields2($('#formPersonnal .required'))) {
                    return;
                }

                const passwordInput = $("#password");
                const confirmInput = $("#confirm_password");
                const messageBox = $("#message");

                // Si les champs mot de passe sont désactivés (donc pas en mode modification), on soumet directement
                if (passwordInput.prop('disabled')) {
                    $('#formPersonnal').submit();
                    return;
                }

                // Vérification seulement si on a activé la modification
                const password = passwordInput.val().trim();
                const confirmPassword = confirmInput.val().trim();

                messageBox.html("").removeClass("text-danger text-success");

                if (password === "" || confirmPassword === "") {
                    messageBox
                        .addClass("text-danger")
                        .html("Veuillez remplir les deux champs de mot de passe.");
                    return;
                }

                if (password.length < 6) {
                    messageBox
                        .addClass("text-danger")
                        .html("Le mot de passe doit contenir au moins 6 caractères.");
                    return;
                }

                if (password !== confirmPassword) {
                    messageBox
                        .addClass("text-danger")
                        .html("Les mots de passe ne correspondent pas.");
                    return;
                }

                // Si tout est correct
                messageBox
                    .addClass("text-success")
                    .html("Les mots de passe sont valides ✅");

                $('#savePersonnalBtn').prop('disabled', true);
                $('#formPersonnal').submit();
            });


        });
    </script>



    <script>
        $(document).ready(function() {


            // Vérification au chargement du form
            $('#field_generic').attr('hidden', !$('#compte-generic').is(':checked'));


            $('#compte-generic').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#field_generic').removeAttr('hidden');
                } else {
                    $('#field_generic').attr('hidden', true);
                }
            });


            $('#editPasswordBtn').click(function() {
                const passwordInput = $('#password');
                const confirmInput = $('#confirm_password');
                const isDisabled = passwordInput.prop('disabled');
                console.log("jje")

                if (isDisabled) {
                    // Demande de confirmation avant d'activer
                    if (confirm("Voulez-vous vraiment modifier le mot de passe de cet utilisateur ?")) {
                        passwordInput.prop('disabled', false);
                        confirmInput.prop('disabled', false);
                        $(this)
                            .removeClass('btn-outline-primary')
                            .addClass('btn-outline-danger')
                            .html('<i class="fas fa-times me-1"></i> Annuler la modification');
                    }
                } else {
                    // Annuler la modification
                    passwordInput.prop('disabled', true).val('');
                    confirmInput.prop('disabled', true).val('');
                    $(this)
                        .removeClass('btn-outline-danger')
                        .addClass('btn-outline-primary')
                        .html('<i class="fas fa-lock-open me-1"></i> Modifier le mot de passe');
                }
            });

        });
    </script>
@endsection

@section('admin-css')
    <style>
        /* Conteneur Dropzone */
        .dropzone-preview-wrapper {
            width: 100%;
            min-height: 220px;
            border: 2px dashed #6c757d;
            border-radius: 10px;
            background: #f8f9fa;
            position: relative;
            transition: all 0.3s ease;
        }

        .dropzone-preview-wrapper:hover {
            border-color: #007bff;
            background: #eef6ff;
        }

        /* Zone d’aperçu */
        #previews img {
            max-width: 160px;
            max-height: 160px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        #previews img:hover {
            transform: scale(1.05);
        }

        .fileinput-button i {
            margin-right: 6px;
        }

        /* Texte par défaut de Dropzone */
        .dz-message {
            color: #6c757d !important;
            font-weight: 500;
            text-align: center;
            margin-top: 50px;
        }
    </style>
@endsection
