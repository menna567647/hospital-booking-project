@extends('admin.partials.main')
@section('content')
    <!-- Content -->
    <div class="content">
        <div class="container-fluid">
            <h3 class="mb-4 fw-bold text-dark" style="background-color: #f8f9fa; padding: 10px 15px; border-radius: 5px;">
                {{ __('language.DASHBOARD') }}
            </h3>
            <div class="row">
                @can('read doctors')
                    <!-- Doctors Card -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow-sm border rounded">
                            <span class="info-box-icon bg-info text-white">
                                <i class="fa-solid fa-user-doctor fa-lg"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text fw-bold">{{ __('language.DOCTORS') }}</span>
                                <span class="info-box-number fs-4">{{ $doctors_count }}</span>
                                <a href="{{ route('admin.doctors.index') }}" class="small-box-footer text-info fw-semibold">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('read departments')
                    <!-- Departments Card -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow-sm border rounded">
                            <span class="info-box-icon bg-success text-white">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text fw-bold">{{ __('language.DEPARTMENT') }}</span>
                                <span class="info-box-number fs-4">{{ $departments_count }}</span>
                                <a href="{{ route('admin.departments.index') }}"
                                    class="small-box-footer text-success fw-semibold">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('read roles')
                    <!-- Roles Card -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow-sm border rounded">
                            <span class="info-box-icon bg-orange text-white">
                                <i class="fa-solid fa-user-shield"></i> </span>
                            <div class="info-box-content">
                                <span class="info-box-text fw-bold">{{ __('language.ROLES') }}</span>
                                <span class="info-box-number fs-4">{{ $roles_count }}</span>
                                <a href="{{ route('admin.roles.index') }}" class="small-box-footer text-orange fw-semibold">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('read messages')
                    <!-- Messages Card -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow-sm border rounded">
                            <span class="info-box-icon bg-danger text-white">
                                <i class="fa-solid fa-envelope fa-lg"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text fw-bold">{{ __('language.MESSAGES') }}</span>
                                <span class="info-box-number fs-4">{{ $messages_count }}</span>
                                <a href="{{ route('admin.messages.index') }}" class="small-box-footer text-danger fw-semibold">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="row">
                <!-- Second Row -->
                @can('read clients')
                    <div class="col-lg-3 col-6">
                        <!-- clients card -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $clients_count }}</h3>
                                <p>Clients</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <a href="{{ route('admin.clients.index') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endcan

                @can('read users')
                    <div class="col-lg-3 col-6">
                        <!-- Users Card -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $users_count }}</h3>
                                <p>{{ __('language.USERS') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-users fa-2x"></i>
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endcan

                @can('read doctors schedules')
                    <div class="col-lg-3 col-6">
                        <!-- doctors schedules card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>&nbsp;</h3>
                                <p>{{ __('language.DOCTORSCHEDULE') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <a href="{{ route('admin.schedules.index') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection
