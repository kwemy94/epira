@extends('layouts.app')

@section('admin-css')
    <style>
        label{
            font-weight: 0 !important;
        }
    </style>
@endsection

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
                        <p class="" style="font-weight: bold">
                            <span class="badge badge-primary right">1</span> Identité du patient - Informations Principales
                        </p>
                        @include('dashboard.patient.partials._part1')

                        <p class="" style="font-weight: bold">
                            <span class="badge badge-primary right">2</span> Identité du patient - Informations
                            Complémentaires
                        </p>
                        @include('dashboard.patient.partials._part2')

                        <p class="" style="font-weight: bold">
                            <span class="badge badge-primary right">3</span>Contacts du patient/Filiation Complémentaires
                        </p>
                        @include('dashboard.patient.partials._part3')

                        <p class="" style="font-weight: bold">
                            <span class="badge badge-primary right">4</span> Prise en charge
                        </p>
                        @include('dashboard.patient.partials._part4')

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
    <script src="{{ asset('template_old/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $('#saveBtn').click((e) => {
            e.preventDefault();
            if (!ControlRequiredFields($('#formPatient .required'))) {
                return -1;
            }

            $('#formPatient').submit();
        })

        $(document).ready(() => {
            $('#part2').attr('hidden', true);
            $('#part3').attr('hidden', true);
            $('#part4').attr('hidden', true);
        });

        $('#part2_id').click(() => {
            if ($('#part2_id').is(':checked')) {
                $('#part2').attr('hidden', false);
            }else{
                $('#part2').attr('hidden', true);
            }
        });

        $('#part31_id').click(() => {
            if ($('#part31_id').is(':checked')) {
                $('#part3').attr('hidden', false);
            }else{
                $('#part3').attr('hidden', true);
            }
        });

        $('#part4_id').click(() => {
            if ($('#part4_id').is(':checked')) {
                $('#part4').attr('hidden', false);
            }else{
                $('#part4').attr('hidden', true);
            }
        })
    </script>
@endsection
