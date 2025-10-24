@extends('layouts.app')


@section('admin-content')
    <x-page-header title="Patient" :breadcrumbs="[
        [
            'label' => 'Patient',
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
                                <a href="{{ route('patient.create') }}" type="button" class="btn bg-gradient-primary btn-sm"
                                    title="Nouveau patient">
                                    <i class="fa fa-plus"></i> Add
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
                                        <th>Référence</th>
                                        <th>Patient</th>
                                        <th>Sexe</th>
                                        <th>Age</th>
                                        <th>Catégorie</th>
                                        <th>Télephone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($patients as $patient)
                                        <tr>
                                            <td>{{ $patient->reference }}</td>
                                            <td>{{ $patient->firstname }} {{ $patient->lastname }}</td>
                                            <td>{{ $patient->sexe }}</td>
                                            <td>{{ $patient->age }}</td>
                                            <td><span
                                                    class="tag tag-success">{{ isset($patient->category) ? $patient->category->name : '' }}</span>
                                            </td>
                                            <td>{{ $patient->phone}}</td>
                                            <td>
                                                <div class="btn-group" style="z-index: 9999;">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('patient.show', $patient->id) }}"
                                                            title="Détails">
                                                            <i class="fas fa-eye text-primary"></i> Détails
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('patient.edit', $patient->id) }}"
                                                            title="Ajouter une prestation">
                                                            <i class="fas fa-plus text-success"></i> Prestation
                                                        </a>
                                                        {{-- <form action="{{ route('patient.destroy', $patient->id) }}" method="POST"
                                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce patient ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" style="text-align: center">Aucun patient enregistré</td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
