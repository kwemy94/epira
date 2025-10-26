<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">


                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <button type="button" data-toggle="modal" data-target="#new-insurer"
                            class="btn bg-gradient-primary btn-sm">
                            <i class="fa fa-plus"></i> Prise en charge
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Assureur</th>
                            <th>Employeur</th>
                            <th>Validité</th>
                            <th>Numéro d'assuré</th>
                            <th>Numéro de carte</th>
                            <th>Pourcentage</th>
                            <th>Plafond</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($patient->contacts[0]->pivot()) --}}
                        @forelse ($patient->insurer as $insurer)
                            <tr>
                                <td>{{ $insurer->insurer_name }}</td>
                                <td>{{ $insurer->insurer_employer }}</td>
                                <td>{{ $insurer->start_date }}- {{ $insurer->end_date }}</td>
                                <td>{{ $insurer->insurance_number }}</td>
                                <td>{{ $insurer->card_number }}</td>
                                <td>{{ $insurer->percentage }}</td>
                                <td>{{ $insurer->max_insurance }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default" type="button"
                                            id="actionsDrop{{ $insurer->id }}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="actionsDropdown{{ $insurer->id }}">
                                            <!-- Show -->
                                            <a href="#" class="dropdown-item text-success btn-show-insurer"
                                                data-id="{{ $insurer->id }}" title="Détails">
                                                <i class="fas fa-eye mr-2"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="#" class="dropdown-item text-primary btn-edit-insurer"
                                                data-id="{{ $insurer->id }}"
                                                data-insurer_name="{{ $insurer->insurer_name }}"
                                                data-insurer_employer="{{ $insurer->insurer_employer }}"
                                                data-start_date="{{ $insurer->start_date }}"
                                                data-end_date="{{ $insurer->end_date }}"
                                                data-insurance_number="{{ $insurer->insurance_number }}"
                                                data-card_number="{{ $insurer->card_number }}"
                                                data-percentage="{{ $insurer->percentage }}"
                                                data-max_insurance="{{ $insurer->max_insurance }}"
                                                title="Editer">
                                                <i class="fas fa-edit mr-2"></i>
                                            </a>

                                            <div class="dropdown-divider"></div>

                                            <!-- Delete: bouton qui déclenche le formulaire -->
                                            <a class="dropdown-item text-danger btn-delete-insurer" href="#"
                                                title="Supprimer" data-id="{{ $insurer->id }}">
                                                <i class="fas fa-trash-alt mr-2"></i>
                                            </a>

                                            <!-- Formulaire DELETE masqué -->
                                            <form id="delete-form-insurer-{{ $insurer->id }}"
                                                action="{{ route('insurer.destroy', $insurer->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center">Aucun assureur enregistré</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="new-insurer">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('insurer.store') }}" method="POST" id="formInsurer">
                            <div class="modal-header">
                                <h4 class="modal-title" id="insurerModalTitle">Nouveau assureur</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Assureur <em style="color:red">*</em></label>
                                            <input type="text" class="form-control required" id=""
                                                name="insurer_name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Employeur</label>
                                            <input type="text" class="form-control" id=""
                                                name="insurer_employer" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Date de début de validité <em
                                                    style="color:red">*</em></label>
                                            <input type="date" class="form-control required" id=""
                                                name="start_date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Date de fin de validité <em
                                                    style="color:red">*</em></label>
                                            <input type="date" class="form-control required" id=""
                                                name="end_date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Numéro d'assuré</label>
                                            <input type="text" class="form-control" id=""
                                                name="insurance_number" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Numéro de carte</label>
                                            <input type="text" class="form-control" id=""
                                                name="card_number" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Pourcentage de prise en charge <em
                                                    style="color:red">*</em></label>
                                            <input type="text" class="form-control required" id=""
                                                name="percentage" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Plafond</label>
                                            <input type="text" class="form-control" id=""
                                                name="max_insurance" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                <button type="button" id="saveInsurerBtn"
                                    class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Show modal --}}

            <div class="modal fade" id="showInsurerModal" tabindex="-1" role="dialog"
                aria-labelledby="showContactModalLabel" aria-hidden="true" data-backdrop="static"
                data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="showContactModalLabel">Détails assureur</h5>
                            <button type="button" class="close text-white" data-dismiss="modal"
                                aria-label="Fermer">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tbody id="insurerDetails">
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">Chargement...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
