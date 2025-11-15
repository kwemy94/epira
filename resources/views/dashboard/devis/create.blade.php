@extends('layouts.app')


@section('admin-content')
    <x-page-header title="Nouveau devis" :breadcrumbs="[
        [
            'label' => 'Prestation',
            'url' => route('prestation.index'),
        ],
        ['label' => 'Nouveaudevis'],
    ]" />
       @include('dashboard.prestation.partials.details')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="bg-primary text- p-2">
                            Création du devis
                        </div>
                <div class="card-body ">
                   
                    <form action="{{ route('devis.store')}}" method="post" id="formDevis">
                        @csrf
                        
                            <div class="row">
                                <div class="form-group">
                                        <label for="ad">Prestation<em
                                    style="color:red">*</em></label> </label>
                                        <select name="prestation_type_id" id=""  class="form-control required" required>>
                                        <option value="">Veuillez sélectionner une prestation</option>
                                        @foreach($prestation_types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="">
                                <input type="hidden" name="prestation_id" value="{{$prestation_id}}">
                                <div class="" style="display: flex;justify-content:center">
                                    <table class="min-w-full border border-gray-200 rounded-md text-sm">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="border px-3 py-2 text-left">Libellé</th>
                                                <th class="border px-3 py-2 text-left">Prix unitaire</th>
                                                <th class="border px-3 py-2 text-left">Quantité</th>
                                                <th class="border px-3 py-2 text-left">Montant total</th>
                                                <th class="border px-3 py-2 text-left">Commentaire</th>
                                            </tr>
                                        </thead>
                                        <tbody id="devisTableBody">
                                            <tr class="text-center text-gray-500">
                                                <td colspan="5" class="py-3">Aucune ligne ajoutée</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                               
                                
                                <button type="button" class="btn btn-outline-primary btn-sm"  data-toggle="modal" data-target="#modalForm">
                                    + Ajouter un ligne
                                </button>
                                <div class="mt-4 p-3 bg-light border rounded">
                                    <h6 class="mb-0 text-center">Facture Totale : <span id="grandTotal" name="amount" class="fw-bold">0</span> FCFA</h6>
                                </div>
                            </div>
                            @include('dashboard.devis.partials.create_lignes')
                            <div class="col-12 mt-3" style="justify-content: center ">
                                <!-- <a href="{{ route('prestation.index') }}" class="btn btn-secondary">Annuler</a> -->
                                <button type="submit" class="btn btn-primary" style="float: right;" id="saveDevis">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
           </div>
        </div>
    </section>
@endsection
@section('admin-js')
<script>
    const closeModal = document.getElementById('closeModal');
    const modalForm = document.getElementById('modalForm');
    const lineForm = document.getElementById('lineForm');
    const tableBody = document.getElementById('devisTableBody');
    const totalElement = document.getElementById('grandTotal');

    let grandTotal = 0;

    $('#saveLineBtn').click((e) => {
        e.preventDefault();
        if (!ControlRequiredFields($('#lineForm .required'))) {
            return -1;
        }

        $('#saveLineBtn').prop('disabled', true);
               
        e.preventDefault();
         console.log("")
        const libelle = document.getElementById('libelle').value;
        const prix = parseFloat(document.getElementById('prix_unitaire').value) || 0;
        const quantite = parseFloat(document.getElementById('quantite').value) || 0;
        const commentaire = document.getElementById('commentaire').value;
        const montant = prix * quantite;

        if (!libelle) return alert("Veuillez renseigner le libellé");

        // Si c’est la première ligne, on retire le message “Aucune ligne”
        if (tableBody.children[0] && tableBody.children[0].cells.length === 1) {
            tableBody.innerHTML = "";
        }

        // Ajouter la ligne au tableau
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="border px-3 py-2">${libelle}<input type="hidden" name="libelle[]" value="${libelle}"></td>
            <td class="border px-3 py-2">${prix}<input type="hidden" name="prix_unitaire[]" value="${prix}"></td>
            <td class="border px-3 py-2">${quantite}<input type="hidden" name="quantite[]" value="${quantite}"></td>
            <td class="border px-3 py-2">${montant}<input type="hidden" name="montant_total[]" value="${montant}"></td>
            <td class="border px-3 py-2">${commentaire}<input type="hidden" name="commentaire[]" value="${commentaire}"></td>
        `;
        tableBody.appendChild(row);

        // Mettre à jour le total
        grandTotal += montant;
        totalElement.textContent = grandTotal.toFixed(2);

        // Réinitialiser le formulaire et fermer la modal
        // lineForm.reset();
        //  $('#lineForm')[0].reset();
         $('#libelle').val('');
         $('#quantite').val('');
         $('#prix_unitaire').val('');
         $('#commentaire').val('');
          $('#modalForm').modal('hide');
          $('#saveLineBtn').prop('disabled', false);
        // modalForm.classList.add('hidden');
    });
    $('#saveLineBtn').prop('disabled', false);
    $('#saveDevis').click((e) => {
        e.preventDefault();
        
        $('#saveDevis').prop('disabled', true);
        $('#formDevis').submit();
    });
</script>
@endsection

