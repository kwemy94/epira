<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="part2_id" name="compl_info">
        <label class="custom-control-label" for="part2_id">Renseigner les informations complémentaires ?</label></label>
    </div>
</div>
<div class="row" id="part2">
    <div class="col-md-4">
        <div class="form-group">
            <label>Type de pièce d'identité </label>
            <select class="form-control select2" name="document_type_id" style="width: 100%;">
                <option selected="selected" disabled>Choisir</option>
                @foreach ($documents as $doc)
                    <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Numéro de pièce d'identité</label>
            <input type="text" class="form-control" id="ad" name="document_number" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Prénom et nom du père</label>
            <input type="text" class="form-control" id="ad" name="father_name" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Profession</label>
            <input type="text" class="form-control" id="ad" name="job" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Niveau d'étude <em style="color:red"></em></label>
            <select class="form-control select2" name="study_level_id" style="width: 100%;">
                <option selected="selected" disabled>Choisir</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Autre niveau d'étude</label>
            <input type="text" class="form-control" id="ad" name="other_level_study" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Age du conjoint(e)</label>
            <input type="text" class="form-control" id="ad" name="spouce_age" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Profession du conjoint(e)</label>
            <input type="text" class="form-control" id="ad" name="spouce_job" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Nationalité</label>
            <input type="text" class="form-control" id="ad" name="nationality" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Employeur</label>
            <input type="text" class="form-control" id="ad" name="employer" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Référence interne</label>
            <input type="text" class="form-control" id="ad" name="inter_reference" placeholder="">
        </div>
    </div>
</div>
