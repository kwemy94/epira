@extends('layouts.app')

@section('admin-content')
    <section class="content pt-3">
        <div class="container-fluid">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">
                    <i class="fas fa-users mr-1"></i> Utilisateurs
                </h5>

                @can('créer un utilisateur')
                {{-- @if ($canCreateUser) --}}
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createUserModal">
                    <i class="fas fa-plus mr-1"></i> Nouvel utilisateur
                </button>
                {{-- @endif --}}
                @endcan
            </div>

            @forelse ($usersByCompany as $companyName => $companyUsers)
                {{-- Nom de l’entreprise --}}
                <div class="mb-2 mt-4">
                    <h6 class="text-primary font-weight-bold">
                        <i class="fas fa-building mr-1"></i>
                        {{ $companyName }}
                        <span class="badge badge-secondary ml-1">
                            {{ $companyUsers->count() }}
                        </span>
                    </h6>
                    <hr class="mt-1 mb-3">
                </div>

                {{-- Utilisateurs --}}
                <div class="row">
                    @foreach ($companyUsers as $user)
                        <x-user-card :user="$user" :adminCompany="$adminCompany" />
                    @endforeach
                </div>

            @empty
                <div class="alert alert-info text-center">
                    Aucun utilisateur enregistré
                </div>
            @endforelse


        </div>

        @include('dashboard.users.partials.edit-modal', ['roles' => $roles])
        @include('dashboard.users.partials.create-modal', ['roles' => $roles])
    </section>
@endsection


@section('admin-js')
    <script>
        < script >
            $('#editUserModal').on('show.bs.modal', function(e) {
                console.log('Modal opened');
                let button = $(e.relatedTarget);
                let userId = button.data('id');
                let modal = $(this);

                modal.find('form').attr('action', `/dashboard/users/${userId}`);

                $.get(`/dashboard/users/${userId}`, function(user) {
                    modal.find('[name=name]').val(user.name);
                    modal.find('[name=email]').val(user.email);
                    modal.find('[name=phone]').val(user.phone);
                    modal.find('[name=cni]').val(user.cni);
                });
            });


        $('#btnUserCreate').click((e) => {
            e.preventDefault();
            if (ControlRequiredFields($('#formUser .required'))) {
                $('#formUser').submit()
            }
        });
    </>
    </script>
@endsection
