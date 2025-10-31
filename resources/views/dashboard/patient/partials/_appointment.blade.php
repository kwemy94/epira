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
                            <th>Date</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($patient->doctor as $doctor)
                            <tr>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->pivot->appointment_date }}</td>
                                <td>{{ $doctor->pivot->appointment_start_time }}</td>
                                <td>{{ $doctor->pivot->appointment_end_time }}</td>
                                <td><button class="btn btn-sm btn-default">En cours</button></td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default" type="button"
                                            id="actionsDrop-{{ $doctor->id }}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="actionsDropdown{{ $doctor->id }}">
                                            <!-- Show -->
                                            {{-- <a href="#" class="dropdown-item text-success btn-show-prestation"
                                                data-id="{{ $doctor->id }}" title="Détails">
                                                <i class="fas fa-eye mr-2"></i>Visualiser
                                            </a> --}}


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
