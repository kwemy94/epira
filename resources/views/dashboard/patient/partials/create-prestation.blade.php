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
                                @if(isset($patient))
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                <div class="row">
                                  
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ad">Patient </label>
                                            <input type="texte" readonly class="form-control " id=""
                                                name="patient_id" value="{{ $patient->firstname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ad">Assureur </label>
                                           <select name="insurer_id" id="" class="form-control ">
                                            <option value="" disabled>Sélectionner</option>
                                            @foreach($patient->insurer as $insurer)
                                                
                                                <option value="{{$insurer->id}}">{{$insurer->insurer_name}}</option>
                                            @endforeach
                                           </select>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ad">Prestation </label>
                                           <select name="name" id="" class="form-control required">
                                            <option value="" disabled>Veuillez sélectionner une prestation</option>
                                            <option value="chirurgie">Nouvelle consultation</option>
                                            <option value="analyse">Nouvelle hospitalisation</option>
                                            <option value="autre">Nouvelle visite</option>
                                             <option value="chirurgie">Nouvelle analyse </option>
                                            <option value="analyse">Nouvelle Imagerie</option>
                                            <option value="autre">Nouvel ambulatoire</option>
                                             <option value="chirurgie">Nouvelle Pharmacie</option>
                                            <option value="analyse">Devis</option>
                                           </select>
                                        </div>
                                    </div>
                                                                        
                                </div>
                                @endif
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

  