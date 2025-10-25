@if (!isset($edit))
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="part31_id" name="contact1_info">
            <label class="custom-control-label" for="part31_id">Le patient a déclaré un contact n°1 ?</label></label>
        </div>
    </div>
@endif
{{-- <div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="part32_id" name="contact2_info">
        <label class="custom-control-label" for="part32_id">Le patient a déclaré un contact n°2 ?</label></label>
    </div>
</div> --}}

<div class="row" id="part3">

    <div class="col-md-4">
        <div class="form-group">
            <label for="category_id">Type de contact</label>
            <select class="form-control select2" name="contact_type_id" style="width: 100%;">
                <option disabled {{ old('contact_type_id', $patient->contacts[0]->id ?? '') == '' ? 'selected' : '' }}>
                    Choisir
                </option>
                @foreach ($contactTypes as $item)
                    <option value="{{ $item->id }}"
                        {{ old('category_id', $patient->contacts[0]->id ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->type_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Nom complet</label>
            <input type="text" class="form-control" id="" name="contact_name" value="{{ old('contact_name', $patient->contacts[0]->contact_name ?? '') }}" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Profession</label>
            <input type="text" class="form-control" id="" name="contact_job" value="{{ old('contact_job', $patient->contacts[0]->contact_job ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Employeur</label>
            <input type="text" class="form-control" id="" name="contact_employer" value="{{ old('contact_employer', $patient->contacts[0]->contact_employer ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Adresse</label>
            <input type="text" class="form-control" id="" name="contact_address" value="{{ old('contact_address', $patient->contacts[0]->contact_address ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Numéro mobile</label>
            <input type="text" class="form-control" id="" name="contact_phone" value="{{ old('contact_phone', $patient->contacts[0]->contact_phone ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Autre Numéro</label>
            <input type="text" class="form-control" id="" name="contact_other_phone" value="{{ old('contact_other_phone', $patient->contacts[0]->contact_other_phone ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Profession</label>
            <input type="text" class="form-control" id="" name="job" value="{{ old('job', $patient->contacts[0]->job ?? '') }}">
        </div>
    </div>

</div>
