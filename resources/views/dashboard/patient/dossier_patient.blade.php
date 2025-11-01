@extends('layouts.app')

@section('title', 'Dossier Médical - Impression')

@section('content_header')
    <h1 class="text-center">Dossier Médical du Patient</h1>
@stop

@section('admin-content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                {{-- Bouton d'impression --}}
                <div class="text-end mb-3 no-print">
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                </div>

                {{-- ================= PAGE 1 : Données Administratives ================= --}}
                <div class="page-break">
                    <h3 class="mb-3 text-primary"><i class="fas fa-user"></i> Données Administratives</h3>

                    {{-- Section 1 : Informations principales --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Informations principales</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Nom complet</th>
                                <td>{{ $patient->nom ?? '...' }}</td>
                            </tr>
                            <tr>
                                <th>Date de naissance</th>
                                <td>{{ $patient->date_naissance ?? '...' }}</td>
                            </tr>
                            <tr>
                                <th>Sexe</th>
                                <td>{{ $patient->sexe ?? '...' }}</td>
                            </tr>
                            <tr>
                                <th>Adresse</th>
                                <td>{{ $patient->adresse ?? '...' }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- Section 2 : Contacts --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Contacts</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Téléphone</th>
                                <td>{{ $patient->telephone ?? '...' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $patient->email ?? '...' }}</td>
                            </tr>
                            <tr>
                                <th>Personne à contacter</th>
                                <td>{{ $patient->personne_contact ?? '...' }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- Section 3 : Prise en charge --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Prise en charge</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Type</th>
                                <td>{{ $patient->prise_en_charge->type ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Assurance</th>
                                <td>{{ $patient->prise_en_charge->assurance ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Numéro d’adhésion</th>
                                <td>{{ $patient->prise_en_charge->numero ?? '---' }}</td>
                            </tr>
                        </table>
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
                                <th>Groupe sanguin</th>
                                <td>{{ $patient->groupe_sanguin ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Tabac</th>
                                <td>{{ $patient->smook ? 'Oui' : 'Non' }}</td>
                            </tr>
                            <tr>
                                <th>Sport</th>
                                <td>{{ $patient->sport_pratice ? 'Oui' : 'Non' }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- Sous-section 2 : Pathologies actuelles --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Pathologies actuelles</h5>
                        <ul>
                            @forelse($patient->pathologies as $path)
                                <li>{{ $path->nom }}</li>
                            @empty
                                <li>Aucune pathologie enregistrée</li>
                            @endforelse
                        </ul>
                    </div>

                    {{-- Sous-section 3 : Antécédents --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Antécédents</h5>
                        <p>{{ $patient->antecedents ?? 'Aucun antécédent signalé' }}</p>
                    </div>

                    {{-- Sous-section 4 : Conditions de travail & Hygiène --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Conditions de travail & Hygiène</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Profession</th>
                                <td>{{ $patient->profession ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Hygiène de vie</th>
                                <td>{{ $patient->hygiene ?? '---' }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- Sous-section 5 : Allergies --}}
                    <div class="mb-4">
                        <h5 class="text-secondary">Allergies</h5>
                        <ul>
                            @forelse($patient->allergies as $all)
                                <li>{{ $all->nom }}</li>
                            @empty
                                <li>Aucune allergie connue</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                {{-- ================= PAGE 3 : Rendez-vous ================= --}}
                <div class="page-break">
                    <h3 class="mb-3 text-primary"><i class="fas fa-calendar-alt"></i> Rendez-vous</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Médecin</th>
                                <th>Motif</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patient->rendezvous as $rdv)
                                <tr>
                                    <td>{{ $rdv->date_rdv }}</td>
                                    <td>{{ $rdv->medecin->nom }}</td>
                                    <td>{{ $rdv->motif }}</td>
                                    <td>{{ ucfirst($rdv->statut) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucun rendez-vous trouvé</td>
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
                            @forelse($patient->documents as $doc)
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
                            @endforelse
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
                            @forelse($patient->prestations as $prestation)
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
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop

@section('admin-css')
    <style>
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
