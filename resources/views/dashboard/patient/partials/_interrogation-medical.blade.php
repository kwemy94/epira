<div class="tab-content" id="custom-tabs-four-tabContent2" hidden>
    <div class="tab-pane fade show active" id="interogation1" role="tabpanel" aria-labelledby="interogation1-tab">
        <form action="" method="POST">
            @csrf
            @method('patch')
            <p class="text-info">
                Groupe sanguin et habitudes de vie
            </p>
            <div class="rox">
                <div class="col-md-4">
                <div class="form-group">
                    <label for="category_id">Groupe sanguin</label>
                    <select class="form-control select2" name="document_type" style="width: 100%;">
                        <option disabled
                            {{ old('document_type', $patient->blood_type_id ?? '') == '' ? 'selected' : '' }}>
                            Choisir
                        </option>
                        @foreach ($bloodTypes as $blood)
                            <option value="{{ $blood->id }}"
                                {{ old('document_type', $patient->blood_type_id ?? '') == $blood->id ? 'selected' : '' }}>
                                {{ $blood->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="gsr">GSR</label>
                    <input type="text" class="form-control" id="gsr" name="gsr"
                        value="{{ old('gsr', $patient->gsr ?? '') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="w">Poids (Kg)</label>
                    <input type="number" class="form-control" id="w" name="weight"
                        value="{{ old('weight', $patient->weight ?? '') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="taille">Taille (Cm)</label>
                    <input type="number" class="form-control" id="taille" name="height"
                        value="{{ old('height', $patient->height ?? '') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="imc">IMC</label>
                    <input type="text" class="form-control" id="imc" name="imc"
                        value="{{ old('imc', $patient->imc ?? '') }}">
                </div>
            </div>
            </div>

            <div class="row" style="justify-content: center">
                <button class="btn btn-primary btn-sm" id="saveBtn1">Enregistrer</button>
            </div>
        </form>
    </div>
    <div class="tab-pane fade" id="interogation2" role="tabpanel" aria-labelledby="interogation2-tab">


    </div>
    <div class="tab-pane fade" id="interogation3" role="tabpanel" aria-labelledby="interogation3-tab">




    </div>
    <div class="tab-pane fade" id="interogation4" role="tabpanel" aria-labelledby="interogation4-tab">




    </div>
    <div class="tab-pane fade" id="interogation5" role="tabpanel" aria-labelledby="interogation5-tab">



    </div>
</div>
