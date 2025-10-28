<div class="row" id="prestations-content" hidden>
    <div class="col-12">
        <div class="card">
            <div class="card-header">


                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <button type="button" data-toggle="modal" data-target="#new-prestation"
                            class="btn bg-gradient-primary btn-sm">
                            <i class="fa fa-plus"></i> Prestations
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Type</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Professionnel de la santé</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($patient->contacts[0]->pivot()) --}}
                        @forelse ($patient->insurer as $prestation)
                            <tr>
                                <td>{{ $prestation->insurer_name }}</td>
                                <td>{{ $prestation->insurer_employer }}</td>
                                <td>{{ $prestation->start_date }}- {{ $prestation->end_date }}</td>
                                <td>{{ $prestation->insurance_number }}</td>
                                <td>{{ $prestation->card_number }}</td>
                                <td>{{ $prestation->max_insurance }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default" type="button"
                                            id="actionsDrop{{ $prestation->id }}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="actionsDropdown{{ $prestation->id }}">
                                            <!-- Show -->
                                            <a href="#" class="dropdown-item text-success btn-show-prestation"
                                                data-id="{{ $prestation->id }}" title="Détails">
                                                <i class="fas fa-eye mr-2"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="#" class="dropdown-item text-primary btn-edit-prestation"
                                                data-id="{{ $prestation->id }}"
                                                data-name="{{ $prestation->name }}"
                                                data-description="{{ $prestation->description }}"
                                                data-patient_id="{{ $prestation->patient_id }}"
                                                data-insurer_id="{{ $prestation->insurer_id }}"
                                                title="Editer">
                                                <i class="fas fa-edit mr-2"></i>
                                            </a>

                                            <div class="dropdown-divider"></div>

                                            <!-- Delete: bouton qui déclenche le formulaire -->
                                            <a class="dropdown-item text-danger btn-delete-prestation" href="#"
                                                title="Supprimer" data-id="{{ $prestation->id }}">
                                                <i class="fas fa-trash-alt mr-2"></i>
                                            </a>

                                            <!-- Formulaire DELETE masqué -->
                                            <form id="delete-form-prestation-{{ $prestation->id }}"
                                                action="{{ route('prestation.destroy', $prestation->id) }}" method="POST"
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

          @include('dashboard.patient.partials.create-prestation')

            {{-- Show modal --}}

            <div class="modal fade" id="showPrestationModal" tabindex="-1" role="dialog"
                aria-labelledby="showPrestationtModalLabel" aria-hidden="true" data-backdrop="static"
                data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="showPrestationtModalLabel">Détails prestation</h5>
                            <button type="button" class="close text-white" data-dismiss="modal"
                                aria-label="Fermer">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tbody id="prestationDetails">
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
