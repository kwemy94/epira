{{-- <div class="card-body"> --}}
<div class="row">
    <div class="col-md-6">
        <div class="card card-identite">
            <div class="card-header" style="background:#cde4fb;">
                <strong>Identité Patient(e)</strong>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <p><strong>Référence Patient :</strong> P202500001xx</p>
                        <p><strong>Nom complet :</strong> xx</p>
                        <p><strong>Sexe :</strong> xx</p>
                        <p><strong>Date de naissance :</strong> xx</p>
                        <p><strong>Adresse :</strong> xx</p>
                        <p><strong>Mobile :</strong> xx</p>
                        <p><strong>Mail :</strong> xx</p>
                        <p><strong>Autre numéro :</strong> xx</p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="card card-pharmacie">
            <div class="card-header" style="background:#cde4fb;">
                <strong>Informations générales de Pharmacie</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Référence :</strong> ...</p>
                        <p><strong>Médecin :</strong> ...</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Objet/Motif :</strong> ....</p>
                        <p><strong>Crée par / Crée le :</strong>...</p>
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
                        <label>Début *</label>
                        <input type="date" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Fin *</label>
                        <input type="date" class="form-control">
                    </div>

                </div>

                <button class="btn btn-success btn-sm">Enregistrer</button>

            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
