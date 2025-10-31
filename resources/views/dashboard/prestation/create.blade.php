@extends('layouts.app')

@section('admin-css')
    <style>
        label{
            font-weight: 0 !important;
        }
    </style>
@endsection

@section('admin-content')
    <x-page-header title="Nouvelle prestation" :breadcrumbs="[
        [
            'label' => 'Prestation',
            'url' => route('prestation.index'),
        ],
        ['label' => 'Nouveau'],
    ]" />



    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Informations de la prestation</h3>


                </div>

                <div class="card-body">
                   <form action="{{ route('prestation.store') }}" method="POST" id="formPrestation">
                            
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
                                          
                                           <div>
                                             <select name="insurer_id" id="" class="form-control ">
                                            <option value="" disabled>Sélectionner</option>
                                            @foreach($patient->insurer as $insurer)
                                                
                                                <option value="{{$insurer->id}}">{{$insurer->insurer_name}}</option>
                                            @endforeach
                                           </select>
                                           <button type="button" data-toggle="modal" data-target="#new-insurer"
                            class="btn bg-gradient-primary btn-sm">+Nouveau</button>
                                             <!-- @error('insurer_id')
                                                  <span class="text-danger">{{ $message }}</span>
                                                @enderror -->
                                           </div>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ad">Prestation </label>
                                           <select name="prestation_type_id" id=""  class="form-control required">>
                                            <option value="">Veuillez sélectionner une prestation</option>
                                            @foreach($prestation_types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
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
          @include('dashboard.patient.partials._new-insurer')
    </section>
@endsection

@section('admin-js')
  <script>
        $(document).ready(function() {
            console.log("start");

            // Mode création
            $('#saveInsurerBtn').click((e) => {
                e.preventDefault();
                if (!ControlRequiredFields($('#formInsurer .required'))) {
                    console.log("stop");
                    return -1;
                }
                console.log("submit");

                $('#formInsurer').submit();
            })
            $('#savePrestationBtn').click((e) => {
                e.preventDefault();
                if (!ControlRequiredFields($('#formPrestation .required'))) {
                    return -1;
                }

                $('#formPrestation').submit();
            })
        });
    </script>

@endsection


