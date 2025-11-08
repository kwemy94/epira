@extends('layouts.app')

@section('admin-content')
    <x-page-header title="Liste des professionnels de la santé" :breadcrumbs="[
        [
            'label' => 'Patient',
            'url' => route('patient.index'),
        ],
        ['label' => 'Nouveau'],
    ]" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" flex justify-content-between align-items-center">
                                <a href={{ route('staff-host.create') }} type="button" class="btn bg-gradient-primary btn-sm"
                                    title="">
                                    <i class="fa fa-plus"></i> Nouveau
                                </a>
                            </div>


                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Identité</th>
                                        <th>Spécialisation</th>
                                        {{-- <th>Type professionnel</th> --}}
                                        <th>Profile</th>
                                        <th>Téléphone</th>
                                        <th>email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($staffs as $staff)
                                        <tr>
                                            <td>{{ $staff->lastname }} {{ $staff->firstname }}</td>
                                            <td>{{ $staff->specialization?->name }}</td>
                                            {{-- <td>{{ $staff->staffType->name }}</td> --}}
                                            <td>{{ $staff->profesionnalTitle?->name }}</td>
                                            <td>{{ $staff->phone }}</td>
                                            <td>{{ $staff->email }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('staff-host.edit', $staff->id) }}"
                                                            title="">
                                                            <i class="fas fa-eye text-primary"></i> Visualiser
                                                        </a>

                                                        <a class="dropdown-item contacter" href="#" data-toggle="modal"
                                                            data-target="#sendMailModal"
                                                            data-id="{{ $staff->id }}"
                                                            data-email="{{ $staff->email }}"
                                                            >
                                                            <i class="fas fa-envelope text-info"></i> Contacter
                                                        </a>

                                                        <form action="{{ route('staff-host.destroy', $staff->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce personnel ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item ">
                                                                <i class="fas fa-trash-alt text-danger"></i> Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center">Aucun spécialisation enregistré
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="sendMailModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Contacter</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('contact.staff') }}" method="POST" class="needs-validation" id="formSendMail">
                        @csrf
                        <input type="hidden" name="staff_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mailTo">À <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control required" name="email" id="mailTo" readonly required>
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mailSubject">Objet <em class="text-danger">*</em></label>
                                        <input type="text" class="form-control required" name="subject" id="mailSubject"
                                            placeholder="Objet du message">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mailBody">Message <em class="text-danger">*</em></label>
                                        <!-- If AdminLTE includes Summernote, this will initialize it. Otherwise it falls back to a textarea -->
                                        <textarea id="mailBody" class="form-control required" name="message" rows="3" placeholder="Écrivez votre message..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" id="sendMailBtn">Envoyer</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('admin-js')
    <script>
        $('#sendMailBtn').click((e) => {
            e.preventDefault();
            if (!ControlRequiredFields($('#formSendMail .required'))) {
                return;
            }
            $('#sendMailBtn').prop('disabled', true);
            $('#formSendMail').submit();
        });

        $('.contacter').on('click', function(e) {
            e.preventDefault();
            console.log("ins 1");
            
            let id = $(this).data('id');
            let email = $(this).data('email');

            $('input[name="email"]').val(email);
            $('input[name="staff_id"]').val(id);
            
            console.log("ins 4");
            $('#sendMailModal').modal('show');
        });

    </script>
@endsection
