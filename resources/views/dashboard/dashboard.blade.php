@extends('layouts.app')

@section('admin-content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tableau de bord</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active">Tableau de bord</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                    <!-- small box -->
                    <div class="small-box" style="background: white">
                        <div class="inner">
                            <h3>150</h3>

                            <h3>Assuré</h3>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-user-shield"></i>
                        </div>
                        <a href="#" class="small-box-footer" style="color: black">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                    <div class="small-box" style="background: white">
                        <div class="inner">
                            <h3>{{$patientsCount}}</h3>

                            <h3>Les patients</h3>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('patient.index') }}" class="small-box-footer" style="color: black">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                    <div class="small-box " style="background: white">
                        <div class="inner">
                            <h3>{{$appointments}}</h3>

                            <h3>Rendez-vous</h3>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-calendar-check"></i>
                        </div>
                        <a href="#" class="small-box-footer" style="color: black">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                    <div class="small-box " style="background: white">
                        <div class="inner">
                            <h3>{{$prestationsCount}}</h3>

                            <h3>Prestations</h3>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-stethoscope"></i>
                        </div>
                        <a href="{{ route('prestation.index') }}" class="small-box-footer" style="color: black">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
