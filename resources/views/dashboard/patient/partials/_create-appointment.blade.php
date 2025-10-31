  <div class="modal fade" id="new-appointment">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form action="{{ route('appointments.store') }}" method="POST" id="appointmentForm">
                  @csrf
                  <div class="row">

                      {{-- <!-- Liste des docteurs -->
                      <div class="col-md-3 border-right">
                          <h5 class="mb-3">Docteurs</h5>
                          <div class="list-group" id="doctorList">
                              @foreach ($doctors as $doctor)
                                  <a href="#" class="list-group-item list-group-item-action doctor-item"
                                      data-id="{{ $doctor->id }}">
                                      <strong>{{ strtoupper($doctor->name) }}</strong><br>
                                      <small class="text-primary">{{ strtoupper($doctor->speciality->name ?? '') }}</small>
                                  </a>
                              @endforeach
                          </div>
                          <input type="hidden" name="doctor_id" id="doctor_id">
                      </div>

                      <!-- Sélection de la date -->
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="date">Sélectionner un jour <span class="text-danger">*</span></label>
                              <input type="date" id="date" name="date" class="form-control" required>
                          </div>

                          <div class="form-group mt-3">
                              <label for="patient_id">Patient</label>
                              <select class="form-control" name="patient_id" required>
                                  <option value="">-- Sélectionner un patient --</option>
                                  @foreach ($patients as $patient)
                                      <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="form-group mt-3">
                              <label for="time">Heure du rendez-vous</label>
                              <input type="time" id="time" name="time" class="form-control" required>
                          </div>

                          <button type="submit" class="btn btn-primary btn-block mt-4">Enregistrer</button>
                      </div>

                      <!-- Planning -->
                      <div class="col-md-5 border-left">
                          <h5 class="text-center">Planning hebdomadaire</h5>
                          <div id="calendar" class="table-responsive mt-3">
                              <table class="table table-bordered text-center">
                                  <thead>
                                      <tr>
                                          <th>Heure</th>
                                          <th>Lun</th>
                                          <th>Mar</th>
                                          <th>Mer</th>
                                          <th>Jeu</th>
                                          <th>Ven</th>
                                          <th>Sam</th>
                                          <th>Dim</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @for ($hour = 8; $hour <= 17; $hour++)
                                          <tr>
                                              <td><strong>{{ $hour }}h</strong></td>
                                              @for ($day = 1; $day <= 7; $day++)
                                                  <td class="calendar-slot" data-hour="{{ $hour }}"
                                                      data-day="{{ $day }}"></td>
                                              @endfor
                                          </tr>
                                      @endfor
                                  </tbody>
                              </table>
                          </div>
                      </div> --}}
                  </div>
              </form>
          </div>
      </div>
  </div>


