@extends('layouts.app')


@section('admin-content')
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Liste des companies') }} </h3>

                            <div class="card-tools">
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    {{ __('Licences') }}</a>
                                <a href="#" class="btn btn-outline-primary btn-sm">Plans</a>
                                <a href="#" class="btn btn-outline-success btn-sm" data-toggle="modal"
                                    data-target="#createEtablissementModal"> <i class="fa fa-plus"></i> Nouveau</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>{{ __('product.info.name') }} </th>
                                        <th>Email </th>
                                        <th>Téléphone </th>
                                        <th>Activite </th>
                                        <th>Website </th>
                                        <th>status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @php
                                        $cpte = 1;
                                    @endphp

                                    @forelse ($companies as $ets)
                                        <tr>
                                            <td>{{ $cpte++ }}</td>
                                            <td>{{ $ets->name }} </td>
                                            <td>
                                                {{ $ets->email }}
                                            </td>
                                            <td>
                                                {{ $ets->phone }}
                                            </td>
                                            <td>
                                                {{ $ets->activity }}
                                            </td>
                                            <td>
                                                {{ $ets->website }}
                                            </td>
                                            <td>
                                                @if ($ets->status == 2)
                                                    <span class="badge bg-danger badge_{{ $ets->id }}">En
                                                        attente</span>
                                                @endif
                                                @if ($ets->status == 1)
                                                    <span class="badge bg-success">Activé</span>
                                                @endif
                                                @if ($ets->status == 0)
                                                    <span class="badge bg-warning">En cours</span>
                                                @endif
                                            </td>
                                            <td>

                                                <form method="post"
                                                    action="{{ route('company.destroy', $ets->id) }}"
                                                    id="form-delete-ets{{ $ets->id }}">

                                                    @if ($ets->status == 2)
                                                        <i class="fa fa-eye-slash" style="color:green"
                                                            id="activer_{{ $ets->id }}" title="Désactiver Env"
                                                            onclick="activer({{ $ets->id }})"> </i>
                                                    @else
                                                        {{-- <i class="fa fa-eye" style="color:green" title="désactiver" onclick="activer({{ $ets->id }})"> </i> --}}
                                                    @endif

                                                    <a href="{{ route('company.edit', $ets->id) }}"
                                                        class="fas fa-pen-alt"
                                                        style="color: #217fff; margin-left: 5px; margin-right: 5px;"></a>

                                                    @csrf
                                                    @method('delete')
                                                    <span id="btn-delete-ets{{ $ets->id }}"
                                                        onclick="deleteets({{ $ets->id }})" class="fas fa-trash-alt"
                                                        style="color: red"></span>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="text-align: center"> Aucun produit disponible</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        @include('dashboard.company.create-modal')
    </section>
@endsection


@section('admin-js')

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["csv"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });

        $('#saveEtablissementBtn').click((e) => {
            e.preventDefault();
            if(!ControlRequiredFields($('#formEtablissement .required'))) {
                   return -1;
            }else {
                $('#formEtablissement').submit();
            }
        });

        function deleteets(i) {
            if (confirm('Voulez-vous supprimer cette entreprise ?')) {
                $('#form-delete-ets' + i).submit();
            }
        }


        const activer = (etsId) => {
            console.log('Activer');
            let url = "{{ route('company.activate', '') }}" + '/' + etsId;
            console.log(url);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                method: 'POST',
                url,
                success: function(data) {
                    console.log('ok');
                    if (data.success) {
                        $('#activer_' + etsId).removeClass('fa-eye-slash');
                        $('.badge_' + etsId).addClass('bg-warning');
                        $('.badge_' + etsId).text('En cours');
                        $('.badge_' + etsId).removeClass('bg-danger');
                        alert(data.message);
                    }
                }
            });



        }
    </script>
@endsection
