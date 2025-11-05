@extends('layouts.app')

@section('admin-content')
    <x-page-header title="Création du personnel de santé" :breadcrumbs="[['label' => 'Personnel', 'url' => route('staff-host.index')], ['label' => 'Nouveau']]" />

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
                            <form action="{{ route('staff-host.store') }}" id="formPersonnal" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="tab-content" id="custom-tabs-four-tabContent">

                                    {{-- Onglet Identité --}}
                                    <div class="tab-pane fade show active" id="identity" role="tabpanel"
                                        aria-labelledby="identity-tab">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Nom <em class="text-danger">*</em></label>
                                                    <input type="text" class="form-control required" id="name"
                                                        name="lastname"
                                                        value="{{ old('lastname', $staff->lastname ?? '') }}" autofocus>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="pname">Prénom</label>
                                                    <input type="text" class="form-control" id="pname"
                                                        name="firstname"
                                                        value="{{ old('firstname', $staff->firstname ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sexe">Sexe <em class="text-danger">*</em></label>
                                                    <select id="sexe" class="form-control select2 required"
                                                        name="sexe" required>
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
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ old('email', $staff->email ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="staff_type_id">Profession <em
                                                            class="text-danger">*</em></label>
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
                                                    <label for="professionnal_title_id">Titre <em
                                                            class="text-primary">*</em></label>
                                                    <select id="professionnal_title_id"
                                                        class="form-control select2 required"
                                                        name="professionnal_title_id" required>
                                                        <option disabled
                                                            {{ old('professionnal_title_id', $staff->professionnal_title_id ?? '') == '' ? 'selected' : '' }}>
                                                            Choisir ...</option>
                                                        @foreach ($profesionnalTitles as $title)
                                                            <option value="{{ $title->id }}"
                                                                {{ old('professionnal_title_id', $staff->professionnal_title_id ?? '') == $title->id ? 'selected' : '' }}>
                                                                {{ $title->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
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
                                                        {{ old('intern', $staff->intern ?? false) ? 'checked' : '' }}
                                                        name="intern">
                                                    <label class="form-check-label">Interne</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        {{ old('generic_account', $staff->generic_account ?? false) ? 'checked' : '' }}
                                                        name="generic_account">
                                                    <label class="form-check-label">Compte générique</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        {{ old('honorary_appointment', $staff->honorary_appointment ?? false) ? 'checked' : '' }}
                                                        name="honorary_appointment">
                                                    <label class="form-check-label">Autoriser honoraire</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        {{ old('authorize_appointment', $staff->authorize_appointment ?? false) ? 'checked' : '' }}
                                                        name="authorize_appointment">
                                                    <label class="form-check-label">Autoriser la prise de
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
                                                    <input type="text" class="form-control" id="address"
                                                        name="address"
                                                        value="{{ old('address', $staff->address ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Onglet Photo --}}
                                    <div class="tab-pane fade" id="photo" role="tabpanel"
                                        aria-labelledby="photo-tab">
                                        <div id="actions" class="row justify-content-center">
                                            <div class="col-md-6 text-center">
                                                <div class="card shadow-sm p-3">
                                                    <h6 class="mb-3 text-muted">Photo du personnel</h6>

                                                    <div class="dropzone-preview-wrapper mb-3">
                                                        <div id="previews"
                                                            class="dropzone-previews d-flex justify-content-center align-items-center">
                                                        </div>
                                                    </div>

                                                    <div class="btn btn-success fileinput-button px-4 py-2">
                                                        <i class="fas fa-upload me-2"></i> Sélectionner une photo
                                                    </div>

                                                    <small class="d-block text-muted mt-3">
                                                        Formats acceptés : JPG, PNG — Taille max : 2 Mo
                                                    </small>
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
            Dropzone.autoDiscover = false;

            // Configuration Dropzone liée au formulaire principal
            var myDropzone = new Dropzone("#formPersonnal", {
                autoProcessQueue: false, // Empêche l'envoi automatique
                uploadMultiple: false, // Une seule image
                parallelUploads: 1,
                maxFiles: 1,
                addRemoveLinks: true,
                acceptedFiles: 'image/*',
                paramName: "photo", // Nom du champ côté serveur
                previewsContainer: "#previews",
                clickable: ".fileinput-button",
                dictDefaultMessage: "Déposez votre photo ici ou cliquez pour sélectionner",
            });

            // Lorsqu’un fichier est ajouté, on affiche le preview
            myDropzone.on("addedfile", function(file) {
                console.log("Image ajoutée :", file.name);
            });

            // Empêcher Dropzone d’envoyer par défaut quand on clique sur “Enregistrer”
            document.getElementById("savePersonnalBtn").addEventListener("click", function(e) {
                e.preventDefault();

                // Vérifie s’il y a un fichier dans Dropzone
                if (myDropzone.getQueuedFiles().length > 0) {
                    myDropzone.processQueue(); // Envoie avec le fichier
                } else {
                    // Aucun fichier → on envoie le formulaire normalement
                    document.getElementById("formPersonnal").submit();
                }
            });

            // Quand Dropzone a fini d’envoyer, on soumet le reste du formulaire
            myDropzone.on("sending", function(file, xhr, formData) {
                // Ajoute tous les champs du formulaire dans la requête
                let form = document.getElementById("formPersonnal");
                Array.from(form.elements).forEach(input => {
                    if (input.name && input.type !== 'file') {
                        formData.append(input.name, input.value);
                    }
                });
            });

            myDropzone.on("success", function(file, response) {
                console.log("Fichier uploadé avec succès !");
                window.location.href = "{{ route('staff-host.index') }}"; // Redirige après succès
            });

            myDropzone.on("error", function(file, response) {
                console.error("Erreur upload :", response);
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
