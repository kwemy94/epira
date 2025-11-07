@extends('layouts.app')

@section('admin-content')
    <x-page-header title="Liste des professionnels de la santé" :breadcrumbs="[
        [
            'label' => 'Patient',
            'url' => route('patient.index'),
        ],
        ['label' => 'Nouveau'],
    ]" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" flex justify-content-between align-items-center">
                                <a href={{ route('staff-host.create') }} type="button"
                                    class="btn bg-gradient-primary btn-sm" title="">
                                    <i class="fa fa-plus"></i> Nouveau
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
                                        <th>Identité</th>
                                        <th>Spécialisation</th>
                                        {{-- <th>Type professionnel</th> --}}
                                        <th>Profile</th>
                                        <th>Téléphone</th>
                                        <th>email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($staffs as $staff)
                                        <tr>
                                            <td>{{ $staff->lastname }} {{ $staff->firstname }}</td>
                                            <td>{{ $staff->specialization?->name }}</td>
                                            {{-- <td>{{ $staff->staffType->name }}</td> --}}
                                            <td>{{ $staff->profesionnalTitle?->name }}</td>
                                            <td>{{ $staff->phone }}</td>
                                            <td>{{ $staff->email }}</td>
                                            <td>
                                                <div class="btn-group" style="z-index: 9999;">
                                                    <button type="button" class="btn btn-default btn-sm"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('staff-host.show', $staff->id) }}"
                                                            title="Détails">
                                                            <i class="fas fa-eye text-primary"></i> Visualiser
                                                        </a> --}}
                                                        <a class="dropdown-item"
                                                            href="{{ route('staff-host.edit', $staff->id) }}"
                                                            title="">
                                                            <i class="fas fa-eye text-primary"></i> Visualiser
                                                        </a>
                                                        
                                                        <a  class="dropdown-item" href="#">
                                                            <i class="fas fa-envelope text-info"></i> Contacter
                                                        </a>
                                                        
                                                        <form action="{{ route('staff-host.destroy', $staff->id) }}" method="POST"
                                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce personnel ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item ">
                                                                <i class="fas fa-trash-alt text-danger"></i> Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center">Aucun spécialisation enregistré
                                            </td>
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
