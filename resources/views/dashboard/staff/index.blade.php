@extends('layouts.app')

@section('admin-content')
    <x-page-header title="Listing du personel de santé" :breadcrumbs="[
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
                                        <th>intitulé</th>
                                        <th>desciption</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse ($specializations as $spe)
                                        <tr>
                                            <td>{{ $spe->name }}</td>
                                            <td>{{ $spe->description }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center">Aucun spécialisation enregistré
                                            </td>
                                        </tr>
                                    @endforelse --}}

                                </tbody>
                            </table>
                        </div>

                    
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
