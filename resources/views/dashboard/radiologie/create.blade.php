@extends('layouts.app')


@section('admin-content')
    <x-page-header title="Nouvelle radiologie" :breadcrumbs="[
        [
            'label' => 'Prestation',
            'url' => route('prestation.index'),
        ],
        ['label' => 'Nouvelle radiologie'],
    ]" />
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                @include('dashboard.prestation.partials.details')

                <div class="card-body ">
                    <form action="{{ route('radiologie.store')}}" method="post">
                        @csrf
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="enter_date">Date d'entrée</label>
                                    <input type="datetime-local" name="enter_date" id="enter_date" class="form-control @error('enter_date') is-invalid @enderror" value="{{ old('enter_date') }}">
                                    @error('enter_date')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <input type="hidden" name="prestation_id" value="{{$prestation_id}}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exit_date">Date de sortie</label>
                                    <input type="datetime-local" name="exit_date" id="exit_date" class="form-control @error('exit_date') is-invalid @enderror" value="{{ old('exit_date') }}">
                                    @error('exit_date')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="motif">Motif</label>
                                    <input type="text"  required  name="motif" id="motif" class="form-control @error('motif') is-invalid @enderror" value="{{ old('motif') }}">
                                    @error('motif')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="medecin_id">Médecin<em style="color:red">*</em></label>
                                    <select name="doctor_id" required  id="medecin_id" class="form-control @error('medecin_id') is-invalid @enderror">
                                        <option value="">-- Sélectionner --</option>
                                        <option value="Dr Nyam">Dr Nyam</option>
                                       
                                    </select>
                                    @error('medecin_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="medecin_id">Chambre<em style="color:red">*</em></label>
                                    <select name="chambre" required  id="medecin_id" class="form-control @error('medecin_id') is-invalid @enderror">
                                        <option value="">-- Sélectionner --</option>
                                        <option value="1">VIP</option>
                                        <option value="1">Moderne</option>
                                        <option value="1">Classique</option>
                                        
                                    </select>
                                    @error('medecin_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="service">Service<em style="color:red">*</em></label>
                                    <select name="service" required  id="service" class="form-control @error('service') is-invalid @enderror">
                                        <option value="">-- Sélectionner --</option>
                                        <option value="Centre Hospitalier Régional d’Ebolowa">Centre Hospitalier Régional d’Ebolowa</option>
                                        @foreach($services ?? [] as $service)
                                            <option value="{{ $service->id }}" {{ old('service') == $service->id ? 'selected' : '' }}>
                                                {{ $service->name ?? $service->libelle ?? $service->intitule ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="comment">Commentaire</label>
                                    <textarea name="comment" id="comment" rows="4" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                                    @error('comment')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-12" style="justify-content: center">
                                <!-- <a href="{{ route('prestation.index') }}" class="btn btn-secondary">Annuler</a> -->
                                <button type="submit" class="btn btn-primary" style="float: right;">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
           </div>
        </div>
    </section>
@endsection
