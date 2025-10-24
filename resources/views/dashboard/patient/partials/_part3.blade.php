<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="part31_id" name="contact1_info">
        <label class="custom-control-label" for="part31_id">Le patient a déclaré un contact n°1 ?</label></label>
    </div>
</div>
{{-- <div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="part32_id" name="contact2_info">
        <label class="custom-control-label" for="part32_id">Le patient a déclaré un contact n°2 ?</label></label>
    </div>
</div> --}}

<div class="row" id="part3">
    
    <div class="col-md-4">
        <div class="form-group">
            <label>Type de contact <em style="color:red"></em></label>
            <select class="form-control select2 " name="contact_type_id" style="width: 100%;">
                <option selected="selected" disabled></option>
                @foreach ($contactTypes as $contact)
                    <option value="{{ $contact->id }}">{{ $contact->type_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Nom complet</label>
            <input type="text" class="form-control" id="" name="contact_name" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Profession</label>
            <input type="text" class="form-control" id="" name="contact_job" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Employeur</label>
            <input type="text" class="form-control" id="" name="contact_employer" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Adresse</label>
            <input type="text" class="form-control" id="" name="contact_address" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Numéro mobile</label>
            <input type="text" class="form-control" id="" name="contact_phone" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Autre Numéro</label>
            <input type="text" class="form-control" id="" name="contact_other_phone" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Profession</label>
            <input type="text" class="form-control" id="" name="job" placeholder="">
        </div>
    </div>

</div>
