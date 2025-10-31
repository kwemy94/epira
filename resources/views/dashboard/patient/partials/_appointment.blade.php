<div class="row" id="appointment-content" hidden>
    <div class="col-12">
        <div class="card">
            <div class="card-header">


                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <button type="button" data-toggle="modal" data-target="#new-appointment"
                            class="btn bg-gradient-primary btn-sm">
                            <i class="fa fa-plus"></i> Rendez-vous
                        </button>
                    </div>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Médecin</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($prestations as $prestation)
                            <tr>
                                <td>{{ $prestation->patient->firstname }}</td>
                                <td>{{ $prestation->name }}</td>
                                <td>chirugie</td>
                                <td><button class="btn btn-sm btn-default">En cours</button></td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default" type="button"
                                            id="actionsDrop-{{ $prestation->id }}" data-toggle="dropdown"
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
                                <td colspan="5" style="text-align: center">Aucun rendez-vous</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>

            @include('dashboard.patient.partials._create-appointment')



        </div>
    </div>
</div>
