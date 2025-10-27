<div class="tab-content" id="custom-tabs-four-tabContent2" hidden>
    <div class="tab-pane fade show active" id="interogation1" role="tabpanel" aria-labelledby="interogation1-tab">
        <form action="{{ route('patient.update', $patient->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <p class="text-info">
                        Groupe sanguin et habitudes de vie
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">Groupe sanguin</label>
                                <select class="form-control select2" name="blood_type_id" style="width: 100%;">
                                    <option disabled
                                        {{ old('blood_type_id', $patient->blood_type_id ?? '') == '' ? 'selected' : '' }}>
                                        Choisir
                                    </option>
                                    @foreach ($bloodTypes as $blood)
                                        <option value="{{ $blood->id }}"
                                            {{ old('blood_type_id', $patient->blood_type_id ?? '') == $blood->id ? 'selected' : '' }}>
                                            {{ $blood->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gsr">GSR</label>
                                <input type="text" class="form-control" id="gsr" name="gsr"
                                    value="{{ old('gsr', $patient->gsr ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="w">Poids (Kg)</label>
                                <input type="number" class="form-control" id="w" name="weight"
                                    value="{{ old('weight', $patient->weight ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="taille">Taille (Cm)</label>
                                <input type="number" class="form-control" id="taille" name="height"
                                    value="{{ old('height', $patient->height ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imc">IMC</label>
                                <input type="text" class="form-control" id="imc" name="imc"
                                    value="{{ old('imc', $patient->imc ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-info">
                        Mode de vie
                    </p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        {{ old('smook', $patient->smook ?? false) ? 'checked' : '' }} name="smook">
                                    <label class="form-check-label">Fumeur</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        {{ old('sport_pratice', $patient->sport_pratice ?? false) ? 'checked' : '' }}
                                        name="sport_pratice">
                                    <label class="form-check-label">Pratique du sport</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-check-input" type="checkbox" value="1"
                                    {{ old('herbal_medicine', $patient->herbal_medicine ?? false) ? 'checked' : '' }}
                                    name="herbal_medicine">
                                <label class="form-check-label">Phytothérapie</label>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p class="text-info">
                            Autres informations
                        </p>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" checked="" name="other_information">
                                    {{ old('other_information', $patient->other_information ?? '') }}
                                </textarea>

                            </div>
                        </div>
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
