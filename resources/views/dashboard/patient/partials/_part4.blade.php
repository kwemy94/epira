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
            <label for="ad">Assureur</label>
            <input type="text" class="form-control" id="" name="insurer_name" value="{{ old('insurer_name', $patient->insurer[0]->insurer_name ?? '') }}" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Employer</label>
            <input type="text" class="form-control" id="" name="insurer_employer" value="{{ old('insurer_employer', $patient->insurer[0]->insurer_employer ?? '') }}" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Date de début de validité</label>
            <input type="date" class="form-control" id="" name="start_date" value="{{ old('start_date', $patient->insurer[0]->start_date ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Date de fin de validité</label>
            <input type="date" class="form-control" id="" name="end_date" value="{{ old('end_date', $patient->insurer[0]->end_date ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Numéro d'assuré</label>
            <input type="text" class="form-control" id="" name="insurance_number" value="{{ old('insurance_number', $patient->insurer[0]->insurance_number ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Numéro de carte</label>
            <input type="text" class="form-control" id="" name="card_number" value="{{ old('card_number', $patient->insurer[0]->card_number ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Pourcentage de prise en charge</label>
            <input type="text" class="form-control" id="" name="percentage" value="{{ old('percentage', $patient->insurer[0]->percentage ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Plafond</label>
            <input type="text" class="form-control" id="" name="max_insurance" value="{{ old('max_insurance', $patient->insurer[0]->max_insurance ?? '') }}">
        </div>
    </div>
</div>
