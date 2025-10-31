
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
