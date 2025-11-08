@extends('layouts.app')

@section('admin-css')
    <style>
        label{
            font-weight: 0 !important;
        }
    </style>
@endsection

@section('admin-content')
    <x-page-header title="Nouvelle prestation" :breadcrumbs="[
        [
            'label' => 'Prestations',
            'url' => route('prestation.index'),
        ],
        ['label' => 'Nouvelle prestation'],
    ]" />



    <section class="content" style="max-width: 600px;">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Informations de la prestation</h3>
                </div>

                <div class="card-body">
                   <form action="{{ route('prestation.store') }}" method="POST" id="formPrestation">
                            
                        <div class="modal-body">
                            @csrf
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ad">Patient </label>
                                        @if(isset($patient))
                                        <input type="texte" readonly class="form-control " id=""
                                            name="patient_id" value="{{ $patient->firstname }}">
                                        @else
                                        <select name="patient_id" id="" class="form-control">
                                            <option value="-1">Choisir un patient</option>
                                            @foreach ($patients as $patient )
                                                <option value="{{$patient->id}}">{{$patient->lastname.$patient->fistname}}</option>
                                                
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ad">Assureur </label>
                                        
                                        <div>
                                            <select name="insurer_id" id="" class="form-control ">
                                        <option value="" disabled>Sélectionner</option>
                                        @foreach($patient->insurer as $insurer)
                                            
                                            <option value="{{$insurer->id}}">{{$insurer->insurer_name}}</option>
                                        @endforeach
                                        </select>
                                        <button type="button" data-toggle="modal" data-target="#new-insurer"
                                            class="btn bg-gradient-primary btn-sm">+ Nouveau</button>
                                            <!-- @error('insurer_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror -->
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="ad">Prestation </label>
                                        <select name="prestation_type_id" id="" onchange="document.getElementById('formPrestation').submit()"  class="form-control required">>
                                        <option value="">Veuillez sélectionner une prestation</option>
                                        @foreach($prestation_types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                                                    
                            </div>
                            
                        </div>
                        <!-- <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            <button type="button" id="savePrestationBtn"
                                class="btn btn-primary">Soumettre</button>
                        </div> -->
                    </form>

                </div>
            </div>
        </div>
          @include('dashboard.patient.partials._new-insurer')
    </section>
@endsection

@section('admin-js')
  <script>
        $(document).ready(function() {
            console.log("start");

            // Mode création
            $('#saveInsurerBtn').click((e) => {
                e.preventDefault();
                if (!ControlRequiredFields($('#formInsurer .required'))) {
                    console.log("stop");
                    return -1;
                }
                console.log("submit");

                $('#saveInsurerBtn').prop('disabled', true);
                $('#formInsurer').submit();
            })
            $('#savePrestationBtn').click((e) => {
                e.preventDefault();
                if (!ControlRequiredFields($('#formPrestation .required'))) {
                    return -1;
                }

                $('#savePrestationBtn').prop('disabled', true);
                $('#formPrestation').submit();
            })
        });
    </script>

@endsection

@push('scripts')
<script>
    let actesList = @json($actes);
    let medecinsList = @json($medecins);
    let actesSelectionnes = [];

    function ajouterActe() {
        const tbody = document.getElementById('actes-body');
        const index = actesSelectionnes.length;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="actes[${index}][id]" class="form-select" onchange="updateTarifs(this, ${index})">
                    <option value="">-- Choisir un acte --</option>
                    ${actesList.map(a => `<option value="${a.id}">${a.libelle}</option>`).join('')}
                </select>
            </td>
            <td>
                <select name="actes[${index}][tarif]" class="form-select" onchange="calculerTotal()">
                    <option value="">-- Sélectionner le tarif --</option>
                </select>
            </td>
            <td>
                <select name="actes[${index}][medecin_id]" class="form-select">
                    <option value="">-- Sélectionner un médecin --</option>
                    ${medecinsList.map(m => `<option value="${m.id}">${m.nom}</option>`).join('')}
                </select>
            </td>
            <td>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="supprimerActe(this)">×</button>
            </td>
        `;
        tbody.appendChild(row);
        actesSelectionnes.push({ id: null, tarif: null, medecin_id: null });
    }

    function supprimerActe(btn) {
        const row = btn.closest('tr');
        row.remove();
        calculerTotal();
    }

    function updateTarifs(select, index) {
        const acteId = select.value;
        const tarifsSelect = select.closest('tr').querySelector(`[name="actes[${index}][tarif]"]`);

        const acte = actesList.find(a => a.id == acteId);
        tarifsSelect.innerHTML = `<option value="">-- Sélectionner le tarif --</option>`;
        if (acte && acte.tarifs) {
            acte.tarifs.forEach(t => {
                tarifsSelect.innerHTML += `<option value="${t.montant}">${t.libelle} : ${t.montant} FCFA</option>`;
            });
        }
    }

    function setDefaultMedecin(select) {
        const medecinId = select.value;
        document.querySelectorAll('[name$="[medecin_id]"]').forEach(sel => {
            if (!sel.value) sel.value = medecinId;
        });
    }

    function calculerTotal() {
        let total = 0;
        document.querySelectorAll('[name$="[tarif]"]').forEach(sel => {
            const val = parseFloat(sel.value) || 0;
            total += val;
        });
        document.getElementById('total-montant').innerText = total;
    }
</script>
@endpush


