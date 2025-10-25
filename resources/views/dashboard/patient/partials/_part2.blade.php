@if (!isset($edit))
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="part2_id" name="compl_info">
            <label class="custom-control-label" for="part2_id">Renseigner les informations complémentaires
                ?</label></label>
        </div>
    </div>
@endif
<div class="row" id="part2">
    <div class="col-md-4">
        {{-- <div class="form-group">
            <label>Type de pièce d'identité </label>
            <select class="form-control select2" name="document_type_id" style="width: 100%;">
                <option selected="selected" disabled>Choisir</option>
                @foreach ($documents as $doc)
                    <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label for="category_id">Type de pièce d'identité</label>
            <select class="form-control select2" name="document_type" style="width: 100%;">
                <option disabled {{ old('document_type', $patient->document_type ?? '') == '' ? 'selected' : '' }}>
                    Choisir
                </option>
                @foreach ($documents as $document)
                    <option value="{{ $document->id }}"
                        {{ old('document_type', $patient->document_type ?? '') == $document->id ? 'selected' : '' }}>
                        {{ $document->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Numéro de pièce d'identité</label>
            <input type="text" class="form-control" id="ad" name="document_number"
                value="{{ old('document_number', $patient->document_number ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Prénom et nom du père</label>
            <input type="text" class="form-control" id="ad" name="father_name"
                value="{{ old('father_name', $patient->father_name ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Profession</label>
            <input type="text" class="form-control" id="ad" name="job"
                value="{{ old('job', $patient->job ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        {{-- <div class="form-group">
            <label>Niveau d'étude <em style="color:red"></em></label>
            <select class="form-control select2" name="study_level_id" style="width: 100%;">
                <option selected="selected" disabled>Choisir</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label for="level">Niveau d'étude <em style="color:red">*</em></label>
            <select id="level" class="form-control select2" name="study_level_id" style="width: 100%;">
                <option disabled {{ old('study_level_id', $patient->study_level_id ?? '') == '' ? 'selected' : '' }}>
                    Choisir
                </option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}"
                        {{ old('level_id', $patient->level_id ?? '') == $level->id ? 'selected' : '' }}>
                        {{ $level->name }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Autre niveau d'étude</label>
            <input type="text" class="form-control" id="ad" name="other_level_study"
                value="{{ old('other_level_study', $patient->other_level_study ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Age du conjoint(e)</label>
            <input type="text" class="form-control" id="ad" name="spouce_age"
                value="{{ old('spouce_age', $patient->spouce_age ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Profession du conjoint(e)</label>
            <input type="text" class="form-control" id="ad" name="spouce_job"
                value="{{ old('spouce_job', $patient->spouce_job ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Nationalité</label>
            <input type="text" class="form-control" id="ad" name="nationality"
                value="{{ old('nationality', $patient->nationality ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Employeur</label>
            <input type="text" class="form-control" id="ad" name="employer"
                value="{{ old('employer', $patient->employer ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Référence interne</label>
            <input type="text" class="form-control" id="ad" name="inter_reference"
                value="{{ old('inter_reference', $patient->inter_reference ?? '') }}">
        </div>
    </div>
</div>
