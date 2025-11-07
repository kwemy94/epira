@extends('layouts.app')


@section('admin-content')
    <x-page-header title="Spécialisation" :breadcrumbs="[
        [
            'label' => 'Spécialisation',
            // 'url' => route('patient.index'),
        ],
    ]" />


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" flex justify-content-between align-items-center">
                                <a href="#" type="button" data-toggle="modal" data-target="#new-cat"
                                    class="btn bg-gradient-primary btn-sm" title="Nouvelle spécialisation">
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
                                        <th>Intitulé</th>
                                        <th>Desciption</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($specializations as $spec)
                                        <tr>
                                            <td>{{ $spec->name }}</td>
                                            <td>{{ $spec->description }}</td>
                                            <td>
                                                <div class="btn-group" >
                                                    <button type="button" class="btn btn-default btn-sm"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                        <a href="#" data-toggle="modal" data-target="#new-cat"
                                                            class="dropdown-item text-primary btn-edit-specialisation"
                                                            data-id="{{ $spec->id }}"
                                                            data-name="{{ $spec->name }}"
                                                            data-description="{{ $spec->description }}">
                                                            <i class="fas fa-edit mr-2"></i> Modifier
                                                        </a>

                                                        <form action="{{ route('specialization-host.destroy', $spec->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Voulez-vous vraiment supprimer cette spécialisation ?');">
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
                                            <td colspan="2" style="text-align: center">Aucun spécialisation enregistré
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" id="new-cat" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="contactModalTitle">Nouvelle spécialisation</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('specialization-host.store') }}" method="POST" id="formCat">
                                        <div class="modal-body">
                                            <div class="row">
                                                @csrf
                                                <input type="hidden" name="specialization_id" id="specialization_id">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="cat_name">Nom de la spécialisation <em
                                                                class="text-danger">*</em></label>
                                                        <input type="text" class="form-control required" id="cat_name"
                                                            name="name" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="desc">Description
                                                        </label>
                                                        <input type="text" class="form-control" id="desc"
                                                            name="description" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Fermer</button>
                                            <button type="button" id="saveCatBtn"
                                                class="btn btn-success">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-js')
    <script>
        $('#saveCatBtn').click((e) => {
            e.preventDefault();
            if (!ControlRequiredFields($('#formCat .required'))) {
                return -1;
            }

            $('#formCat').submit();
        });

        $('.btn-edit-specialisation').on('click', function(e) {
            e.preventDefault();
            console.log("ins 1");
            // Récupérer les données
            let id = $(this).data('id');
            let name = $(this).data('name');
            let description = $(this).data('description');

            // Modifier le titre du modal
            $('#contactModalTitle').text("Modification de la spécialisation");
            console.log("ins 2");

            // Remplir les champs
            $('input[name="name"]').val(name);
            $('input[name="description"]').val(description);
            $('#specialization_id').val(id);
            console.log("ins 3");

            // Changer l’action du formulaire vers la route "update"
            $('#formCat').attr('action', '/specialization-host/' + id);
            $('#formCat').append('<input type="hidden" name="_method" value="PUT">');

            // Ouvrir le modal
            console.log("ins 4");
            $('#new-cat').modal('show');
        });

        $('#new-cat').on('hidden.bs.modal', function() {
            $('#formCat')[0].reset();
            $('#contactModalTitle').text('Nouvelle spécialisation');
            $('#specialization_id').val('');
            $('#formCat').attr('action', '{{ route('specialization-host.store') }}');
            $('#formCat input[name="_method"]').remove();
        });
    </script>
@endsection
