<div class="row">

    <!-- Identité patient -->
    <div class="col-md-6">
        <div class="card card-identite">
            <div class="card-header" style="background:#cde4fb;">
                <strong>Identité Patient(e)</strong>
            </div>

            <div class="card-body">
                @php $p = $prestation?->patient; @endphp

                <p><strong>Référence Patient :</strong> {{ $p?->reference }}</p>
                <p><strong>Nom complet :</strong> {{ $p?->lastname }} {{ $p?->firstname }}</p>
                <p><strong>Sexe :</strong> {{ $p?->sexe }}</p>
                <p><strong>Date de naissance :</strong> {{ $p?->birth_date }}</p>
                <p><strong>Adresse :</strong> {{ $p?->address }}</p>
                <p><strong>Mobile :</strong> {{ $p?->phone }}</p>
                <p><strong>Email :</strong> {{ $p?->email }}</p>
                <p><strong>Autre numéro :</strong> {{ $p?->other_phone }}</p>
            </div>
        </div>
    </div>

    <!-- Informations prestation -->
    <div class="col-md-6">
        <div class="card card-pharmacie">
            <div class="card-header" style="background:#cde4fb;">
                <strong>Informations générales de {{ Str::ucfirst($prestation->type->code) }}</strong>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">

                        <p><strong>Référence :</strong>
                            {{ $current?->reference ?? '—' }}
                        </p>

                        <p><strong>Médecin :</strong>
                            {{ $current?->medecin ?? '—' }}
                        </p>

                    </div>
                    <div class="col-md-6">

                        <p><strong>Objet/Motif :</strong>
                            {{ $current?->motif ?? '—' }}
                        </p>

                        <p><strong>Créé par / Le :</strong>
                            {{ $current?->created_at ?? '—' }}
                        </p>

                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-6">
                        <label>Status</label>
                        <select class="form-control">
                            <option>Effectué(e)</option>
                            <option>Annulé(e)</option>
                            <option>Pas encore effectué(e)</option>
                            <option selected>En cours</option>
                            <option>A confirmer</option>
                            <option>Non accepté(e)</option>
                            <option>Indisponible</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label>Type</label>
                        <select class="form-control">
                            <option>Rendez-vous</option>
                            <option selected>Sans Rendez-vous</option>
                            <option>Urgence</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Début <em class="text-danger">*</em></label>
                        <input type="datetime-local" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Fin <em class="text-danger">*</em></label>
                        <input type="datetime-local" class="form-control">
                    </div>

                </div>

                <button class="btn btn-success btn-sm">Enregistrer</button>

            </div>
        </div>
    </div>
</div>
