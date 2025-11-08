<div id="actes-section" class="card p-3 mt-3">
    <h5 class="mb-3">Liste des actes</h5>

    <div class="mb-3">
        <label for="medecin_default" class="form-label fw-bold">Sélectionnez un médecin par défaut</label>
        <select id="medecin_default" class="form-select" onchange="setDefaultMedecin(this)">
            <option value="">Veuillez sélectionner un élément</option>
            @foreach($medecins as $medecin)
                <option value="{{ $medecin->id }}">{{ $medecin->nom }}</option>
            @endforeach
        </select>
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Actes</th>
                <th>Tarifs disponibles / Prix</th>
                <th>Médecin praticien</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="actes-body">
            {{-- lignes d’actes ajoutées dynamiquement --}}
        </tbody>
    </table>

    <button type="button" class="btn btn-outline-primary btn-sm" onclick="ajouterActe()">
        + Ajouter un acte
    </button>

    <div class="mt-4 p-3 bg-light border rounded">
        <h6 class="mb-0">Facture Totale : <span id="total-montant" class="fw-bold">0</span> FCFA</h6>
    </div>
</div>
