@extends('layouts.app')


@section('admin-content')
    <x-page-header title="Nouvelle pharmacie" :breadcrumbs="[
        [
            'label' => 'Prestation',
            'url' => route('prestation.index'),
        ],
        ['label' => 'Nouvelle pharmacie'],
    ]" />
    @include('dashboard.prestation.partials.details')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">                
                 <div class="bg-primary text- p-2">
                            Création de la pharmacie
                        </div>
                <div class="card-body ">
                    <form action="{{ route('pharmacie.store')}}" method="post">
                        @csrf
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="enter_date">Date </label>
                                    <input type="datetime-local" name="enter_date" id="enter_date" class="form-control @error('enter_date') is-invalid @enderror" value="{{ old('enter_date') }}">
                                    @error('enter_date')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <input type="hidden" name="prestation_id" value="{{$prestation_id}}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="medecin_id">Médecin<em style="color:red">*</em></label>
                                    <select name="doctor_id" required  id="medecin_id" class="form-control @error('medecin_id') is-invalid @enderror">
                                        <option value="">-- Sélectionner --</option>
                                        <option value="Dr Nyam">Dr Nyam</option>
                                        
                                    </select>
                                    @error('medecin_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="service">Service<em style="color:red">*</em></label>
                                    <select name="service" required  id="service" class="form-control @error('service') is-invalid @enderror">
                                        <option value="">-- Sélectionner --</option>
                                        <option value="Centre Hospitalier Régional d’Ebolowa">Centre Hospitalier Régional d’Ebolowa</option>
                                        @foreach($services ?? [] as $service)
                                            <option value="{{ $service->id }}" {{ old('service') == $service->id ? 'selected' : '' }}>
                                                {{ $service->name ?? $service->libelle ?? $service->intitule ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="comment">Commentaire</label>
                                    <textarea name="comment" id="comment" rows="4" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                                    @error('comment')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            @include("dashboard.prestation.partials._actes")
                            <div class="col-12" style="justify-content: center">
                                <!-- <a href="{{ route('prestation.index') }}" class="btn btn-secondary">Annuler</a> -->
                                <button type="submit" class="btn btn-primary" style="float: right;">Enregistrer</button>
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
    let actesList = @json($actes);
    let medecinsList = @json($medecins);
    let actesSelectionnes = [];

    function ajouterActe() {
        const tbody = document.getElementById('actes-body');
        const index = actesSelectionnes.length;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="actes[${index}][id]" class="form-control" onchange="updateTarifs(this, ${index})">
                    <option value="">-- Choisir un acte --</option>
                    ${actesList.map(a => `<option value="${a.id}">${a.name}</option>`).join('')}
                </select>
            </td>
            <td>
                 <input type="number" name="actes[${index}][tarif]" class="form-control text-end" readonly placeholder="Tarif auto" />
            </td>
            </td>
            <td>
                <select name="actes[${index}][doctor_id]" class="form-control">
                    <option value="">-- Sélectionner un médecin --</option>
                    ${medecinsList.map(m => `<option value="${m.id}">${m.nom}</option>`).join('')}
                </select>
            </td>
            <td>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="supprimerActe(this)">×</button>
            </td>
        `;
        tbody.appendChild(row);
        actesSelectionnes.push({ id: null, tarif: null, doctor_id: null });
    }

    function supprimerActe(btn) {
        const row = btn.closest('tr');
        row.remove();
        calculerTotal();
    }

    function updateTarifs(select, index) {
       const acteId = select.value;
        const acte = actesList.find(a => a.id == acteId);
        const tarifInput = select.closest('tr').querySelector(`[name="actes[${index}][tarif]"]`);

        if (acte) {
            tarifInput.value = acte.tarif; // tarif direct depuis l’acte
        } else {
            tarifInput.value = '';
        }

        calculerTotal();
    }

    function setDefaultMedecin(select) {
        const medecinId = select.value;
        document.querySelectorAll('[name$="[doctor_id]"]').forEach(sel => {
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
@endsection