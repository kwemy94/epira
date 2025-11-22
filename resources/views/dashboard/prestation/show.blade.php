@extends('layouts.app')

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

            <ul class="nav nav-tabs bg-white px-3 pt-2" id="menuTabs">
                <li class="nav-item">
                    <a class="nav-link active" data-target="#medicaments">Médicaments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-target="#documents">Documents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-target="#honoraires">Honoraire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-target="#facturation">Facturation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-target="#teletransmission">Télétransmission</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-target="#paiement">Paiement</a>
                </li>
            </ul>

        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

<div class="p-3">

    <!-- SECTION MÉDICAMENTS -->
    <section id="medicaments" class="menu-section">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Liste des Médicaments</h5>
            </div>
            <div class="card-body">
                Contenu de la section Médicaments ici…
            </div>
        </div>
    </section>

    <!-- SECTION DOCUMENTS -->
    <section id="documents" class="menu-section d-none">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Documents</h5>
            </div>
            <div class="card-body">
                Contenu de la section Documents ici…
            </div>
        </div>
    </section>

    <!-- SECTION HONORAIRES -->
    <section id="honoraires" class="menu-section d-none">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Honoraires</h5>
            </div>
            <div class="card-body">
                Contenu de la section Honoraire ici…
            </div>
        </div>
    </section>

    <!-- SECTION Facturation -->
    <section id="facturation" class="menu-section d-none">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Facturation</h5>
            </div>
            <div class="card-body">
                Contenu de la section Facturation…
            </div>
        </div>
    </section>
    <!-- SECTION T -->
    <section id="teletransmission" class="menu-section d-none">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Télétransmission</h5>
            </div>
            <div class="card-body">
                Contenu de la section Télétransmission…
            </div>
        </div>
    </section>
    <!-- SECTION OPÉRATIONS -->
    <section id="paiement" class="menu-section d-none">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Opérations</h5>
            </div>
            <div class="card-body">
                Contenu de la section Opérations…
            </div>
        </div>
    </section>

</div>
            {{-- ========================= LIGNE 1 : IDENTITÉ + INFOS PHARMACIE ========================= --}}
            {{-- <div class="row card-section">

                
                <div class="col-md-6">
                    <div class="card card-identite">
                        <div class="card-header bg-light">
                            <strong>Identité Patient(e)</strong>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <p><strong>Référence Patient :</strong> P202500001</p>
                                    <p><strong>Nom complet :</strong> Gt Shull</p>
                                    <p><strong>Sexe :</strong> Masculin</p>
                                    <p><strong>Date de naissance :</strong> 30/06/2012</p>
                                    <p><strong>Adresse :</strong> Dchang place de fête</p>
                                    <p><strong>Mobile :</strong> 00327676767</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="card card-pharmacie">
                        <div class="card-header bg-light">
                            <strong>Informations générales de Pharmacie</strong>
                        </div>
                        <div class="card-body">

                            <p><strong>Référence :</strong> PHARMA202500001</p>
                            <p><strong>Médecin :</strong> NINA MAFO / DERMATOLOGUE</p>
                            <p><strong>Statut :</strong> En cours</p>

                            <div class="row">

                                <div class="form-group col-12">
                                    <label>Type</label>
                                    <select class="form-control">
                                        <option>Sans Rendez-vous</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Début *</label>
                                    <input type="date" class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Fin *</label>
                                    <input type="date" class="form-control">
                                </div>

                            </div>

                            <button class="btn btn-success">Enregistrer</button>

                        </div>
                    </div>
                </div>

            </div> --}}

            {{-- ========================= LIGNE 2 : BLOC PRISE EN CHARGE / TARIF ========================= --}}
            {{-- <div class="row card-section">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <strong>Prise en charge / Tarif</strong>
                        </div>

                        <div class="tarif-box">
                            <span>-</span>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- ========================= LIGNE 3 : DETAIL PRIX & QUOTE-PART ========================= --}}
            {{-- <div class="row card-section">

                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <strong>Détail Prix</strong>
                        </div>
                        <table class="table mb-0">
                            <tr>
                                <th>Actes Médicaux</th>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th>Pharmacie (liée à des actes)</th>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th>Pharmacie simple</th>
                                <td>15100</td>
                            </tr>
                            <tr class="bg-light">
                                <th>Total</th>
                                <td>15100</td>
                            </tr>
                        </table>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <strong>Quote-Part</strong>
                        </div>
                        <table class="table mb-0">
                            <tr>
                                <th>Patient</th>
                                <td>15100</td>
                            </tr>
                            <tr>
                                <th>Garant</th>
                                <td>0</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div> --}}

            {{-- ========================= LIGNE 4 : FACTURE ========================= --}}
            {{-- <div class="row card-section">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <strong>Facture</strong>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
            </div> --}}

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
