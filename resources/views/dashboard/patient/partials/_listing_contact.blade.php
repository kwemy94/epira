<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <button type="button" data-toggle="modal" data-target="#new-contact"
                            class="btn bg-gradient-primary btn-sm">
                            <i class="fa fa-plus"></i> Ajouter un contact
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Nom complet</th>
                            <th>Type</th>
                            <th>Téléphone 1</th>
                            <th>Téléphone 2</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($patient->contacts[0]->pivot()) --}}
                        @forelse ($patient->contacts as $contact)
                            <tr>
                                <td>{{ $contact->contact_name }}</td>
                                <td>{{ $contact->typeContact }}</td>
                                <td>{{ $contact->contact_phone }}</td>
                                <td>{{ $contact->contact_other_phone }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default" type="button"
                                            id="actionsDropdown{{ $contact->id }}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="actionsDropdown{{ $contact->id }}">
                                            <!-- Show -->
                                            <a class="dropdown-item text-success"
                                                href="{{ route('contact.show', $contact->id) }}" title="Détails">
                                                <i class="fas fa-eye mr-2"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a class="dropdown-item text-primary"
                                                href="{{ route('contact.edit', $contact->id) }}" title="Editer">
                                                <i class="fas fa-edit mr-2"></i>
                                            </a>

                                            <div class="dropdown-divider"></div>

                                            <!-- Delete: bouton qui déclenche le formulaire -->
                                            <a class="dropdown-item text-danger btn-delete" href="#"
                                                data-id="{{ $contact->id }}" title="Supprimer">
                                                <i class="fas fa-trash-alt mr-2"></i>
                                            </a>

                                            <!-- Formulaire DELETE masqué -->
                                            <form id="delete-form-{{ $contact->id }}"
                                                action="{{ route('contact.destroy', $contact->id) }}" method="POST"
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
                                <td colspan="5" style="text-align: center">Aucun contact enregistré</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="new-contact">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('contact.store') }}" method="POST" id="formContact">
                            <div class="modal-header">
                                <h4 class="modal-title">Nouveau contact</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_id">Type de contact <em
                                                    style="color:red">*</em></label>
                                            <select class="form-control select2 required" name="contact_type_id"
                                                style="width: 100%;">
                                                <option disabled selected> Choisir </option>
                                                @foreach ($contactTypes as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Nom complet <em style="color:red">*</em></label>
                                            <input type="text" class="form-control required" id=""
                                                name="contact_name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Profession</label>
                                            <input type="text" class="form-control" id="" name="contact_job"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Employeur</label>
                                            <input type="text" class="form-control" id=""
                                                name="contact_employer" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Adresse</label>
                                            <input type="text" class="form-control" id=""
                                                name="contact_address" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Numéro mobile <em style="color:red">*</em></label>
                                            <input type="text" class="form-control required" id=""
                                                name="contact_phone" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Autre Numéro</label>
                                            <input type="text" class="form-control" id=""
                                                name="contact_other_phone" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Profession</label>
                                            <input type="text" class="form-control" id="" name="job"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                <button type="button" id="saveContactBtn"
                                    class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
