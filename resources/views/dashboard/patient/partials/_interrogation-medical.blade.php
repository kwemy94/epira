<div class="tab-content" id="custom-tabs-four-tabContent2" hidden>
    <div class="tab-pane fade show active" id="interogation1" role="tabpanel" aria-labelledby="interogation1-tab">
        <form action="{{ route('patient.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <p class="text-info">
                        Groupe sanguin et habitudes de vie
                    </p>
                    <div class="row">
                        <input type="hidden" name="groupe_sang" value="1">
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
        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <button type="button" data-toggle="modal" data-target="#new-pathology"
                    class="btn bg-gradient-primary btn-sm">
                    <i class="fa fa-plus"></i> Pathologie
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Pathologie</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($patient->contacts[0]->pivot()) --}}
                        @forelse ($patient->pathology as $pathology)
                            @if ($pathology->pathology_type == 1)
                                <tr>
                                    <td>{{ $pathology->name }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-default" type="button"
                                                id="actionsDrop{{ $pathology->id }}" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="actionsDropdownh{{ $pathology->id }}">


                                                <div class="dropdown-divider"></div>

                                                <!-- Delete: bouton qui déclenche le formulaire -->
                                                <a class="dropdown-item text-danger btn-delete-insurer" href="#"
                                                    title="Supprimer" data-id="{{ $pathology->id }}">
                                                    <i class="fas fa-trash-alt mr-2"></i>
                                                </a>

                                                <!-- Formulaire DELETE masqué -->
                                                <form id="delete-form-insurer-{{ $pathology->id }}"
                                                    action="{{ route('pathology.destroy', $pathology->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center">Aucune pathologie principale</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Pathologie</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($patient->pathology as $pathology)
                            @if ($pathology->pathology_type == 2)
                                <tr>
                                    <td>{{ $pathology->name }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-default" type="button"
                                                id="actionsDrop{{ $pathology->id }}" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="actionsDropdownh{{ $pathology->id }}">


                                                <div class="dropdown-divider"></div>

                                                <!-- Delete: bouton qui déclenche le formulaire -->
                                                <a class="dropdown-item text-danger btn-delete-insurer" href="#"
                                                    title="Supprimer" data-id="{{ $pathology->id }}">
                                                    <i class="fas fa-trash-alt mr-2"></i>
                                                </a>

                                                <!-- Formulaire DELETE masqué -->
                                                <form id="delete-form-insurer-{{ $pathology->id }}"
                                                    action="{{ route('pathology.destroy', $pathology->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center">Aucune pathologie associée</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="new-pathology" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="contactModalTitle">Nouvelle pathologie</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('pathology.store') }}" method="POST" id="formPathology">
                        <div class="modal-body">
                            <div class="row">
                                @csrf
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="choosePat">Pathologie existante </label>
                                        <select class="form-control select2" id="choosePat" name="pathology_id"
                                            style="width: 100%;" autocomplete="">
                                            <option disabled selected value=""> Choisir </option>
                                            @foreach ($mainPathologies as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                            @foreach ($associatePathologies as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newPat">Nouvelle pathologie (si non existante) </label>
                                        <input type="text" class="form-control" id="newPat" name="name"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="category_id">Type de pathologie <em
                                                style="color:red">*</em></label>
                                        <select class="form-control select2 required" name="pathology_type"
                                            style="width: 100%;" autocomplete="">
                                            <option disabled selected> Choisir </option>
                                            <option value="1">Pathologie principale</option>
                                            <option value="2">Pathologie associée</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="button" id="savePathologyBtn" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="interogation3" role="tabpanel" aria-labelledby="interogation3-tab">
        <div class="row">
            @foreach (['ANTECEDENTS FAMILIAUX', 'ANTECEDENT MEDICAUX', ' GYNECOLOGIQUE ET OBSTETRICAUX', 'CHIRUGICAUX', 'DIVERS'] as $item)
                <div class="col-md-6">
                    <div class="card card-outline card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $item }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            Aucune données à afficher
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="tab-pane fade" id="interogation4" role="tabpanel" aria-labelledby="interogation4-tab">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">CONDITION DE TRAVAIL</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('patient.update', $patient->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="hygiene_vie" value="1">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job">Profession ou fonction</label>
                                        <input type="text" class="form-control" id="job" name="job"
                                            value="{{ old('job', $patient->job ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="daily_working_hours">Temps de travail journalier</label>
                                        <input type="number" min="0" class="form-control"
                                            id="daily_working_hours" name="daily_working_hours"
                                            value="{{ old('daily_working_hours', $patient->daily_working_hours ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="weekly_working_hours">Temps de travail hebdomadaire</label>
                                        <input type="number" min="0" class="form-control"
                                            id="weekly_working_hours" name="weekly_working_hours"
                                            value="{{ old('weekly_working_hours', $patient->weekly_working_hours ?? '') }}">
                                    </div>
                                </div>
                            </div>
                            <p>Profil psychologique au travail</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                {{ old('fulfilment', $patient->fulfilment ?? false) ? 'checked' : '' }}
                                                name="fulfilment">
                                            <label class="form-check-label">Epanuissement</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                {{ old('motivation', $patient->motivation ?? false) ? 'checked' : '' }}
                                                name="motivation">
                                            <label class="form-check-label">Motivation</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                {{ old('boredom', $patient->boredom ?? false) ? 'checked' : '' }}
                                                name="boredom">
                                            <label class="form-check-label">Ennui</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                {{ old('stress', $patient->stress ?? false) ? 'checked' : '' }}
                                                name="stress">
                                            <label class="form-check-label">Stress</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="mb-0 mr-3">Surcharge Physique :</label>

                                        <div class="custom-control custom-radio mr-3">
                                            <input class="custom-control-input" type="radio"
                                                id="physical_overload1" name="physical_overload" value="1"
                                                {{ old('physical_overload', $patient->physical_overload ?? '') == 1 ? 'checked' : '' }}>
                                            <label for="physical_overload1" class="custom-control-label">Oui</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio"
                                                id="physical_overload2" name="physical_overload" value="0"
                                                {{ old('physical_overload', $patient->physical_overload ?? '') == 0 ? 'checked' : '' }}>
                                            <label for="physical_overload2" class="custom-control-label">Non</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="mb-0 mr-3">Epuisement</label>

                                        <div class="custom-control custom-radio mr-3">
                                            <input class="custom-control-input" type="radio" id="exhaustion1"
                                                name="exhaustion" value="1"
                                                {{ old('exhaustion', $patient->exhaustion ?? '') == 1 ? 'checked' : '' }}>
                                            <label for="exhaustion1" class="custom-control-label">Oui</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="exhaustion2"
                                                name="exhaustion" value="0"
                                                {{ old('exhaustion', $patient->exhaustion ?? '') == 0 ? 'checked' : '' }}>
                                            <label for="exhaustion2" class="custom-control-label">Non</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="mb-0 mr-3">Surcharge mentale </label>

                                        <div class="custom-control custom-radio mr-3">
                                            <input class="custom-control-input" type="radio" id="mental_overload"
                                                name="mental_overload" value="1"
                                                {{ old('mental_overload', $patient->mental_overload ?? '') == 1 ? 'checked' : '' }}>
                                            <label for="mental_overload" class="custom-control-label">Oui</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="mental_overload2"
                                                name="mental_overload" value="0"
                                                {{ old('mental_overload', $patient->mental_overload ?? '') == 0 ? 'checked' : '' }}>
                                            <label for="mental_overload2" class="custom-control-label">Non</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="mb-0 mr-3">Harcèlement</label>

                                        <div class="custom-control custom-radio mr-3">
                                            <input class="custom-control-input" type="radio" id="harassment"
                                                name="harassment" value="1"
                                                {{ old('harassment', $patient->harassment ?? '') == 1 ? 'checked' : '' }}>
                                            <label for="harassment" class="custom-control-label">Oui</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="harassment1"
                                                name="harassment" value="0"
                                                {{ old('harassment', $patient->harassment ?? '') == 0 ? 'checked' : '' }}>
                                            <label for="harassment1" class="custom-control-label">Non</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="justify-content: center">
                                <button class="btn btn-success btn-sm" id="saveConditionBtn">Sauvegarder les
                                    modifications</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">HYGIENE DE VIE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('patient.update', $patient->id) }}" method="POST">
                            @csrf

                            {{-- ===== ACTIVITÉ PHYSIQUE ===== --}}
                            @method('PUT')
                            <h5 class="mb-3">Activité physique</h5>
                            <div class="form-group">
                                <label>Marche régulière (15 à 30 min/jour ou tous les jours)</label><br>
                                <div class="custom-control custom-radio d-inline mr-3">
                                    <input type="radio" id="walk_yes" name="walk" value="1"
                                        class="custom-control-input"
                                        {{ old('walk', $patient->walk ?? '') == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="walk_yes">Oui</label>
                                </div>
                                <div class="custom-control custom-radio d-inline">
                                    <input type="radio" id="walk_no" name="walk" value="0"
                                        class="custom-control-input"
                                        {{ old('walk', $patient->walk ?? '') == 0 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="walk_no">Non</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Sédentarité</label><br>
                                <div class="custom-control custom-radio d-inline mr-3">
                                    <input type="radio" id="sedentary_yes" name="sedentary" value="1"
                                        class="custom-control-input"
                                        {{ old('sedentary', $patient->sedentary ?? '') == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="sedentary_yes">Oui</label>
                                </div>
                                <div class="custom-control custom-radio d-inline">
                                    <input type="radio" id="sedentary_no" name="sedentary" value="0"
                                        class="custom-control-input"
                                        {{ old('sedentary', $patient->sedentary ?? '') == 0 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="sedentary_no">Non</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Type de sport</label>
                                    <input type="text" name="sport_type" class="form-control"
                                        value="{{ old('sport_type', $patient->sport_type ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label>Périodicité</label>
                                    <input type="text" name="sport_frequency" class="form-control"
                                        value="{{ old('sport_frequency', $patient->sport_frequency ?? '') }}">
                                </div>
                            </div>

                            <hr>

                            {{-- ===== ALIMENTATION ===== --}}
                            <h5 class="mb-3">Alimentation</h5>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>Petit déjeuner</label>
                                    <input type="time" name="breakfast_time" class="form-control"
                                        value="{{ old('breakfast_time', $patient->breakfast_time ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Déjeuner</label>
                                    <input type="time" name="lunch_time" class="form-control"
                                        value="{{ old('lunch_time', $patient->lunch_time ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Dîner</label>
                                    <input type="time" name="dinner_time" class="form-control"
                                        value="{{ old('dinner_time', $patient->dinner_time ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Grignotage</label>
                                    <input type="time" name="snack_time" class="form-control"
                                        value="{{ old('snack_time', $patient->snack_time ?? '') }}">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label>Consommation d’aliments gras</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="fat_food" class="form-control">
                                            <option value="">Sélectionner un aliment</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="new_fat_food"
                                            placeholder="Ajouter un nouvel aliment">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-success btn-block">+</button>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <textarea name="fat_food_comment" class="form-control" rows="2" placeholder="Commentaires...">{{ old('fat_food_comment', $patient->fat_food_comment ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Consommation de sel</label>
                                    <input type="text" name="salt_consumption" class="form-control"
                                        value="{{ old('salt_consumption', $patient->salt_consumption ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label>Consommation d’eau par jour</label>
                                    <input type="text" name="water_consumption" class="form-control"
                                        value="{{ old('water_consumption', $patient->water_consumption ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label>Consommation excitants (café, alcool...)</label>
                                    <input type="text" name="stimulant_consumption" class="form-control"
                                        value="{{ old('stimulant_consumption', $patient->stimulant_consumption ?? '') }}">
                                </div>
                            </div>

                            <hr>

                            {{-- ===== SOMMEIL ===== --}}
                            <h5 class="mb-3">Sommeil</h5>
                            <div class="form-group col-md-4">
                                <label>Temps de sommeil (heures)</label>
                                <input type="number" step="0.1" name="sleep_time" min="0"
                                    class="form-control" value="{{ old('sleep_time', $patient->sleep_time ?? '') }}">
                            </div>

                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary px-5">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="interogation5" role="tabpanel" aria-labelledby="interogation5-tab">
        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <button type="button" data-toggle="modal" data-target="#new-allergy"
                    class="btn bg-gradient-primary btn-sm">
                    <i class="fa fa-plus"></i> Allergie patient
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Allergies</th>
                            <th>Date de détection</th>
                            <th>Date de fin de détection</th>
                            <th>Commentaire</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($patient->allergies as $allergy)
                            <tr>
                                <td>{{ $allergy->name }}</td>
                                <td>{{ $allergy->pivot->detection_date }}</td>
                                <td>{{ $allergy->pivot->detection_end_date }}</td>
                                <td>{{ $allergy->pivot->comment }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default" type="button"
                                            id="actionsDrop{{ $allergy->id }}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="actionsDropdownh{{ $allergy->id }}">
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item text-primary btn-edit-allergy" href="#"
                                                title="Editer"
                                                data-id="{{ $allergy->id }}"
                                                data-name ="{{ $allergy->name }}"
                                                data-detection_date ="{{ $allergy->pivot->detection_date }}"
                                                data-detection_end_date ="{{ $allergy->pivot->detection_end_date }}"
                                                data-comment ="{{ $allergy->pivot->comment }}"
                                                >
                                                <i class="fas fa-pen mr-2"></i>
                                            </a>
                                            <a class="dropdown-item text-danger btn-delete-allergy" href="#"
                                                title="Supprimer" data-id="{{ $allergy->id }}">
                                                <i class="fas fa-trash-alt mr-2"></i>
                                            </a>

                                            <form id="delete-form-allergy-{{ $allergy->id }}"
                                                action="{{ route('allergy-pat.destroy', $allergy->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                                </form>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center">Aucune allergie détectée</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>

                {{-- modal create allergy --}}
                <div class="modal fade" id="new-allergy" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="allergyModalTitle">Définir une allergie patient</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('allergy-pat.store') }}" method="POST" id="formAllergy">
                                <div class="modal-body">
                                    <div class="row">
                                        @csrf
                                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="choosePat">Allergy existante </label>
                                                <select class="form-control select2" name="allergy_id"
                                                    style="width: 100%;" autocomplete="">
                                                    <option disabled selected value=""> Choisir </option>
                                                    @foreach ($allergies as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="newAll">Nouvelle allergy (si non existante) </label>
                                                <input type="text" class="form-control" id="newAll"
                                                    name="name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="detec">Date de détection <em class="text-danger">*</em></label>
                                                <input type="date" class="form-control required" id="detec"
                                                    name="detection_date" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="eDetect">Date de fin de détection </label>
                                                <input type="date" class="form-control" id="eDetect"
                                                    name="detection_end_date" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control"  name="comment">
                                                    {{ old('comment', $allergy->comment ?? '') }}
                                                </textarea>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Fermer</button>
                                    <button type="button" id="saveAllergyBtn"
                                        class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
