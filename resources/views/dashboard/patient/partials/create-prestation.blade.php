  <div class="modal fade" id="new-prestation">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('prestation.store') }}" method="POST" id="formPrestation">
                            <div class="modal-header">
                                <h4 class="modal-title" id="prestationModalTitle">Nouvelle prestation</h4>
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
                                            <label for="ad">Nom <em style="color:red">*</em></label>
                                            <input type="text" class="form-control required" id=""
                                                name="name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Description</label>
                                            <input type="text" class="form-control" id=""
                                                name="description" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Patient <em
                                                    style="color:red">*</em></label>
                                            <input type="texte" readonly class="form-control required" id=""
                                                name="patient_id" value="{{ $patient->firstname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ad">Assureur <em
                                                    style="color:red">*</em></label>
                                           <select name="insurer_id" id="" class="form-control required">
                                            <option value="">ass</option>
                                           </select>
                                        </div>
                                    </div>
                                                                        
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                <button type="button" id="savePrestationBtn"
                                    class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>