@extends('layouts.app')

@section('title', 'Dossier Médical - Impression')

@section('content_header')
@stop

@section('admin-content')
    {{-- <h1 class="text-center">Dossier Médical du Patient</h1> --}}
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                {{-- Bouton d'impression --}}
                <div class="text-end mb-3 no-print">
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                </div>
                <div class="text-center mb-4">
                    <img src="{{ asset('logo_entreprise.PNG') }}" alt="Logo" class="logo-header mb-2">
                    <div>
                        <h2 class="m-0">Dossier Médical du Patient</h2>
                        <small class="text-muted">Clinique / Hôpital - Informations confidentielles</small>
                    </div>
                </div>


                {{-- ================= PAGE 1 : Données Administratives ================= --}}
                <div class="page-break">
                    <h3 class="mb-3 text-primary"><i class="fas fa-user"></i> Données Administratives</h3>

                    {{-- Section 1 : Informations principales --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Informations principales</h5>

                        <section class="content mb-2 ml-2">
                            <div class="container-fluid p-3" style="background-color: white">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6><strong style="color:rgb(69, 156, 236)">{{ $patient->lastname }}
                                                {{ $patient->firstname }}</strong>
                                        </h6>
                                        <h6><strong>Age : </strong>{{ $patient->age }} an(s)</h6>
                                        <h6><strong>Sexe : </strong>{{ $patient->sexe }}</h6>
                                        <h6><strong>Référence : </strong>{{ $patient->reference }}</h6>
                                        <h6><strong>Référence interne :</strong>{{ $patient->intern_reference }}</h6>
                                        <h6><strong>Adresse : </strong>{{ $patient->adress }}</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6><strong>Date de naissance</strong> : {{ $patient->birth_date }}</h6>
                                        <h6><strong>Numéro mobile</strong> : {{ $patient->phone }}</h6>
                                        <h6><strong>Autre numéro</strong> : {{ $patient->other_phone }}</h6>
                                        <h6><strong>Email</strong> : {{ $patient->email }}</h6>
                                        <h6><strong>profession : </strong>{{ $patient->job }}</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6><strong>Nom de jeune fille</strong> : {{ $patient->maiden_name }}</h6>
                                        <h6><strong>Statut matrimonial</strong>
                                            : {{ isset($patient->matrimonial->name) ? $patient->matrimonial->name : '' }}
                                        </h6>
                                        <h6><strong>Nom de la mère</strong> : {{ $patient->mother_name }}</h6>
                                        <h6><strong>Nom du père</strong> : {{ $patient->father_name }}</h6>
                                        <h6><strong>Nationalité</strong> : {{ $patient->nationality }}</h6>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    {{-- Section 2 : Contacts --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Contacts/Filiation</h5>
                        @forelse ($patient->contacts as $item)
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nom complet</th>
                                    <td>{{ $item->contact_name ?? '...' }}</td>
                                </tr>
                                <tr>
                                    <th>Sexe</th>
                                    <td>{{ $item->sexe ?? '...' }}</td>
                                </tr>
                                <tr>
                                    <th>Téléphone</th>
                                    <td>{{ $item->contact_phone ?? '...' }} / {{ $item->contact_other_phone ?? '...' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Profession</th>
                                    <td>{{ $item->contact_job ?? '...' }}</td>
                                </tr>
                            </table>
                        @empty
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2">Aucun contact enregistré </td>
                                </tr>
                            </table>
                        @endforelse
                    </div>

                    {{-- Section 3 : Prise en charge --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Prise en charge</h5>
                        @forelse ($patient->insurer as $item)
                            <table class="table table-bordered">
                                <tr>
                                    <th>Assureur</th>
                                    <td>{{ $item->insurer_name ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>Employeur</th>
                                    <td>{{ $item->insurer_employer ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>Validité</th>
                                    <td>{{ $item->start_date }} - {{ $item->start_end_date }}</td>
                                </tr>
                                <tr>
                                    <th>Numéro d'assuré</th>
                                    <td>{{ $item->insurance_number ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>Numéro de carte</th>
                                    <td>{{ $item->card_number ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>Pourcentage</th>
                                    <td>{{ $item->percentage ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>Plafon</th>
                                    <td>{{ $item->max_insurance ?? '---' }}</td>
                                </tr>
                            </table>
                        @empty
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2">Aucune prise en charge</td>
                                </tr>
                            </table>
                        @endforelse
                    </div>
                </div>

                {{-- ================= PAGE 2 : Interrogation Médicale ================= --}}
                <div class="page-break">
                    <h3 class="mb-3 text-primary"><i class="fas fa-stethoscope"></i> Interrogation Médicale</h3>

                    {{-- Sous-section 1 : Groupe sanguin & habitudes de vie --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Groupe sanguin & Habitudes de vie</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Poids</th>
                                <td>{{ $patient->weight ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Taille</th>
                                <td>{{ $patient->height ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>IMC</th>
                                <td>{{ $patient->imc ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Groupe sanguin</th>
                                <td>{{ $patient->blood_group ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>GSR</th>
                                <td>{{ $patient->gsr ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Fumeur</th>
                                <td>{{ $patient->smook ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Pratique du sport</th>
                                <td>{{ $patient->sport_pratice ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Phytothérapie</th>
                                <td>{{ $patient->herbal_medicine ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Autres information</th>
                                <td>{{ $patient->other_information ?? '---' }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- Sous-section 2 : Pathologies actuelles --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Pathologies actuelles</h5>
                        <ul>
                            @forelse($patient->pathology as $path)
                                <li>{{ $path->name }}</li>
                            @empty
                                <li>Aucune pathologie enregistrée</li>
                            @endforelse
                        </ul>
                    </div>

                    {{-- Sous-section 3 : Antécédents --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Antécédents</h5>
                        <p><strong>Familiale : </strong>{{ $patient->family_history ?? 'RAS' }}</p>
                        <p><strong>Médicale : </strong>{{ $patient->medical_history ?? 'RAS' }}</p>
                        <p><strong>Chirugicale : </strong>{{ $patient->surgical_history ?? 'RAS' }}</p>
                        <p><strong>Génétique : </strong>{{ $patient->genetic_history ?? 'RAS' }}</p>
                        <p><strong>Autre Antécédent : </strong>{{ $patient->other_history ?? 'RAS' }}</p>
                    </div>

                    {{-- Sous-section 4 : Conditions de travail & Hygiène --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Conditions de travail & Hygiène</h5>
                        <table class="table table-bordered">
                            <p><strong>Temps de travail journalier :
                                </strong>{{ $patient->daily_working_hours == 1 ?? '---' }}</p>
                            <p><strong>Temps de travail hebdomadaire :
                                </strong>{{ $patient->weekly_working_hours == 1 ?? '---' }}</p>
                            <p><strong>Surcharge Physique : </strong>{{ $patient->physical_overload == 1 ? 'Oui' : 'Non' }}
                            </p>
                            <p><strong>Epuisement : </strong>{{ $patient->exhaustion == 1 ? 'Oui' : 'Non' }}</p>
                            <p><strong>Surcharge Mentale : </strong>{{ $patient->mental_overload == 1 ? 'Oui' : 'Non' }}
                            </p>
                            <p><strong>Harcelement : </strong>{{ $patient->harassment == 1 ? 'Oui' : 'Non' }}</p>
                            <p><strong>Epanuissement : </strong>{{ $patient->fulfilment == 1 ? 'Oui' : 'Non' }}</p>
                            <p><strong>Motivation : </strong>{{ $patient->motivation == 1 ? 'Oui' : 'Non' }}</p>
                            <p><strong>Ennui : </strong>{{ $patient->boredom == 1 ? 'Oui' : 'Non' }}</p>
                            <p><strong>Stress : </strong>{{ $patient->stress == 1 ? 'Oui' : 'Non' }}</p>
                        </table>
                    </div>
                    <div class="mb-4">
                        <h5 class="text-secondary">Hygiène</h5>
                        <table class="table table-bordered">
                            <p><strong>Marche régulière (15 à 30 min/jour ou tous les jours) :
                                </strong>{{ $patient->regular_walk == 1 ? 'Oui' : 'Non' }}</p>
                            <p><strong>Sédentarité : </strong>{{ $patient->sedentary == 1 ? 'Oui' : 'Non' }}</p>
                            <p><strong>Type de sport : </strong>{{ $patient->sport_type ?? '---' }}</p>
                            <p><strong>Périodicité : </strong>{{ $patient->sport_periode ?? '---' }}</p>

                        </table>
                    </div>

                    {{-- Sous-section 5 : Allergies --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Allergies</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Allergie</th>
                                    <th>Date de détection</th>
                                    <th>Date de fin de détection</th>
                                    <th>Commentaire</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($patient->allergies as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->pivot->detection_date }}</td>
                                        <td>{{ $item->pivot->detection_end_date }}</td>
                                        <td>{{ $item->pivot->comment }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Aucun allergie signalée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ================= PAGE 3 : Rendez-vous ================= --}}
                <div class="page-break">
                    <h3 class="mb-3 text-primary"><i class="fas fa-calendar-alt"></i> Rendez-vous</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Médecin</th>
                                <th>Date</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Commentaire</th>
                                <th>statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patient->doctor as $doctor)
                                <tr>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->pivot->appointment_date }}</td>
                                    <td>{{ $doctor->pivot->appointment_start_time }}</td>
                                    <td>{{ $doctor->pivot->appointment_end_time }}</td>
                                    <td>{{ $doctor->pivot->comment }}</td>
                                    <td>{{ '---' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucun rendez-vous trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ================= PAGE 4 : Historique Documents ================= --}}
                <div class="page-break">
                    <h3 class="mb-3 text-primary"><i class="fas fa-folder-open"></i> Historique Documents</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type de document</th>
                                <th>Description</th>
                                <th>Médecin</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @forelse($patient as $doc)
                                <tr>
                                    <td>{{ $doc->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $doc->type }}</td>
                                    <td>{{ $doc->description }}</td>
                                    <td>{{ $doc->medecin->nom ?? '---' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucun document disponible</td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>

                {{-- ================= PAGE 5 : Prestations Médicales ================= --}}
                <div class="page-break">
                    <h3 class="mb-3 text-primary"><i class="fas fa-notes-medical"></i> Prestations Médicales</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type de prestation</th>
                                <th>Résultat / Observation</th>
                                <th>Coût</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @forelse($patient as $prestation)
                                <tr>
                                    <td>{{ $prestation->date_prestation }}</td>
                                    <td>{{ $prestation->type }}</td>
                                    <td>{{ $prestation->resultat }}</td>
                                    <td>{{ number_format($prestation->cout, 0, ',', ' ') }} FCFA</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucune prestation enregistrée</td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop

@section('admin-css')
    <style>
        .logo-header {
            width: 400px;
            margin-bottom: 30px;
            height: auto;
        }

        .page-logo {
            text-align: left;
            margin-bottom: 15px;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            .no-print {
                display: none;
            }

            .page-break {
                page-break-after: always;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #999;
                padding: 5px;
            }
        }
    </style>
@stop
