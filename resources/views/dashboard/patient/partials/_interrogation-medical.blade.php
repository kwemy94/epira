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




    </div>
    <div class="tab-pane fade" id="interogation4" role="tabpanel" aria-labelledby="interogation4-tab">




    </div>
    <div class="tab-pane fade" id="interogation5" role="tabpanel" aria-labelledby="interogation5-tab">



    </div>
</div>
