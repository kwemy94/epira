<div id="actes-section" class="card  col-12 p-3 mt-3">
    <div class="mb-3 bg-primary text-left p-2" >Liste des actes</div>

    <div class="mb-3" style="display: grid;justify-content:flex-start;">
        <label for="medecin_default" class="form-label fw-bold">Sélectionnez un médecin par défaut</label>
        <select id="medecin_default" class="form-control" onchange="setDefaultMedecin(this)">
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

    <button type="button" class="btn btn-outline-primary btn-sm"  onclick="ajouterActe()">
        + Ajouter un acte
    </button>

    <div class="mt-4 p-3 bg-light border rounded">
        <h6 class="mb-0 text-center">Facture Totale : <span id="total-montant" name="amount" class="fw-bold">0</span> FCFA</h6>
    </div>
</div>
