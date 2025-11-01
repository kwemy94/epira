<div class="row" id="prestations-content" hidden>
    <div class="col-12">
        <div class="card">
            <div class="card-header">


                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <!-- <button type="button" data-toggle="modal" data-target="#new-prestation" href="{{ route('prestation.create') }}" -->
                        <a type="button"  href="{{ route('prestation.create2',$patient->id) }}"
                            class="btn bg-gradient-primary btn-sm">
                            <i class="fa fa-plus"></i> Prestations
                        </a>
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
                    
                    <tbody>@dd($prestations)
                        
                        @forelse ($prestations as $prestation)
                            <tr>
                                <td>{{ $prestation->reference }}</td>
                                <td>{{ $prestation->type->name }}</td>
                                 <td>{{ $prestation->type->code }}</td>
                                <td>{{ $prestation->created_at }}</td>
                                <td>{{ $prestation->doctor }}</td>
                                <td><button  class="btn btn-sm btn-default" >En cours</button></td>
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
                                                <i class="fas fa-eye mr-2"></i>Visualiser
                                            </a>

                                            
                                            <div class="dropdown-divider"></div>

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
