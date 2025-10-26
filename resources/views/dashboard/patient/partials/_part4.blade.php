@if (!isset($edit))
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="part4_id" name="insurer_info">
            <label class="custom-control-label" for="part4_id">Le patient dispose d'une prise en charge ?</label></label>
        </div>
    </div>
@endif
<div class="row" id="part4">
    <div class="col-md-4">
        <div class="form-group">
            <label for="n1">Assureur</label>
            <input type="text" class="form-control" id="n1" name="insurer_name" value="{{ old('insurer_name', $patient->insurer[0]->insurer_name ?? '') }}" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="n2">Employer</label>
            <input type="text" class="form-control" id="n2" name="insurer_employer" value="{{ old('insurer_employer', $patient->insurer[0]->insurer_employer ?? '') }}" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="n3">Date de début de validité</label>
            <input type="date" class="form-control" id="n3" name="start_date" value="{{ old('start_date', $patient->insurer[0]->start_date ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="n4">Date de fin de validité</label>
            <input type="date" class="form-control" id="n4" name="end_date" value="{{ old('end_date', $patient->insurer[0]->end_date ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="n5">Numéro d'assuré</label>
            <input type="text" class="form-control" id="n5" name="insurance_number" value="{{ old('insurance_number', $patient->insurer[0]->insurance_number ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="n6">Numéro de carte</label>
            <input type="text" class="form-control" id="n6" name="card_number" value="{{ old('card_number', $patient->insurer[0]->card_number ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="n7">Pourcentage de prise en charge</label>
            <input type="text" class="form-control" id="n7" name="percentage" value="{{ old('percentage', $patient->insurer[0]->percentage ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="n8">Plafond</label>
            <input type="text" class="form-control" id="n8" name="max_insurance" value="{{ old('max_insurance', $patient->insurer[0]->max_insurance ?? '') }}">
        </div>
    </div>
</div>
