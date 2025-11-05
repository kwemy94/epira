@extends('layouts.app')


@section('admin-content')
    <x-page-header title="Titre professionnel" :breadcrumbs="[
        [
            'label' => 'Titre',
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
                                <a href="#" type="button" data-toggle="modal" data-target="#new-cat"
                                    class="btn bg-gradient-primary btn-sm" title="Nouveau titre">
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
                                    @forelse ($proTitles as $spe)
                                        <tr>
                                            <td>{{ $spe->name }}</td>
                                            <td>{{ $spe->description }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center">Aucun titre enregistré
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" id="new-cat" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="contactModalTitle">Nouveau titre</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('pro-title-host.store') }}" method="POST" id="formCat">
                                        <div class="modal-body">
                                            <div class="row">
                                                @csrf
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="cat_name">Titre <em
                                                                class="text-danger">*</em></label>
                                                        <input type="text" class="form-control required" id="cat_name"
                                                            name="name" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="desc">Description
                                                        </label>
                                                        <input type="text" class="form-control" id="desc"
                                                            name="description" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Fermer</button>
                                            <button type="button" id="saveCatBtn"
                                                class="btn btn-success">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-js')
    <script>
        $('#saveCatBtn').click((e) => {
            e.preventDefault();
            if (!ControlRequiredFields($('#formCat .required'))) {
                return -1;
            }

            $('#formCat').submit();
        })
    </script>
@endsection
