@extends('layouts.app')


@section('admin-content')
    <x-page-header title="Nouveau patient" :breadcrumbs="[
        [
            'label' => 'Patient',
            'url' => route('patient.index'),
        ],
        ['label' => 'Nouveau'],
    ]" />



    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Informations du patient</h3>


                </div>

                <div class="card-body">
                    <form action="{{ route('patient.store') }}" method="POST" id="formPatient">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Nom <em style="color:red">*</em> </label>
                                    <input type="text" class="form-control required" id="name" name="lastname"
                                        autofocus>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pname">Prénom</label>
                                    <input type="text" class="form-control" id="pname" name="firstname"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sexe <em style="color:red">*</em></label>
                                    <select class="form-control select2 required" name="sexe" style="width: 100%;">
                                        <option selected="selected" disabled>Choisir le sexe</option>
                                        <option value="Féminin">Féminin</option>
                                        <option value="Masculin">Masculin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ad">Adresse</label>
                                    <input type="text" class="form-control" id="ad" name="address" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dat">Date de naissance <em style="color:red">*</em></label>
                                    <input type="date" class="form-control required" id="dat" name="birth_date"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="datl">Lieu de naissance</label>
                                    <input type="text" class="form-control" id="datl" name="birth_place"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    <select class="form-control select2" name="category_id" style="width: 100%;">
                                        <option selected="selected" disabled>Choisir la catégorie</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status matrimoniale</label>
                                    <select class="form-control select2" name="matrimonial_id" style="width: 100%;">
                                        <option selected="selected" disabled>Choisir</option>
                                        @foreach ($matrimonials as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="datl">Prénom et nom de la mère</label>
                                    <input type="text" class="form-control" id="datl" name="mother_name"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="datl">Nom de jeune fille</label>
                                    <input type="text" class="form-control" id="datl" name="maiden_name"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indicatif (SMS)</label>
                                    <select class="form-control select2" name="country_id" style="width: 100%;">
                                        <option selected="selected" disabled>Choisir</option>
                                        @foreach ($countries as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="datl">Numero mobile</label>
                                    <input type="text" class="form-control" id="datl" name="phone"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="datl">Autre numéro</label>
                                    <input type="text" class="form-control" id="datl" name="other_phone"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="datl">Email</label>
                                    <input type="email" class="form-control" id="datl" name="email"
                                        placeholder="">
                                </div>
                            </div>

                        </div>
                        <div class="row" style="justify-content: center">
                            <button class="btn btn-primary btn-sm" id="saveBtn">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-js')
    
    <script>
        $('#saveBtn').click((e) => {
            e.preventDefault();
            if (!ControlRequiredFields($('#formPatient .required'))) {
                return -1;
            }

            $('#formPatient').submit();
        })
    </script>
@endsection
