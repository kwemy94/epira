  <div class="modal fade" id="new-appointment">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              

              <form id="formAppointment" action="{{ route('fix.appointment') }}" method="POST">
                  <div class="modal-body">
                      @csrf
                      <input type="hidden" value="{{ $patient->id }}" name="patient_id">

                      <div class="form-group">
                          <label for="modal_doctor_id">Médecin</label>
                          <select id="modal_doctor_id" name="doctor_id" class="form-control required">
                              <option value="">-- Choisir --</option>
                              @foreach ($doctors as $doc)
                                  <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group mt-3">
                                  <label for="date">Sélectionner un jour <span class="text-danger">*</span></label>
                                  <input type="date" id="date" name="appointment_date" class="form-control required" >
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group mt-3">
                                  <label for="time1">Heure début</label>
                                  <input type="time" id="time1" name="appointment_start_time" class="form-control required" >
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group mt-3">
                                  <label for="time">Heure fin</label>
                                  <input type="time" id="time" name="appointment_end_time" class="form-control" >
                              </div>
                          </div>
                      </div>
                      <div id="modal_times" class="mb-2"></div>
                      <div class="form-group">
                          <label for="modal_notes">Notes</label>
                          <textarea id="modal_notes" name="comment" class="form-control"></textarea>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                      <button type="submit" class="btn btn-primary" id="saveAppointmentBtn">Créer (pending)</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
