@extends('website.partials.main')
@section('content')
    <!-- ################# Slider Starts Here#######################--->
    <div class="slider-detail">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item ">
                    <img class="d-block w-100" src={{ asset('build/assets/img/slider/slider_2.jpg') }} alt="Second slide">
                    <div class="carousel-cover"></div>
                    <div class="carousel-caption vdg-cur d-none d-md-block">
                        <h5 class="animated bounceInDown">Hospital Management System</h5>
                    </div>
                </div>
                <div class="carousel-item active">
                    <img class="d-block w-100" src={{ asset('build/assets/img/slider/slider_3.jpg') }} alt="Second slide">
                    <div class="carousel-cover"></div>
                    <div class="carousel-caption vdg-cur d-none d-md-block">
                        <h5 class="animated bounceInDown">Hospital Management System</h5>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!--  ************************* Gallery Starts Here ************************** -->
    <div id="gallery" class="gallery">
        <div class="container">
            <div class="inner-title">
                <h2>Our Gallery</h2>
                <p>View Our Gallery</p>
            </div>
            <div class="row">
                <div class="gallery-filter d-none d-sm-block">
                    <button class="btn btn-default filter-button" data-filter="all">All</button>
                    <button class="btn btn-default filter-button" data-filter="hdpe">Dental</button>
                    <button class="btn btn-default filter-button" data-filter="sprinkle">Cardiology</button>
                    <button class="btn btn-default filter-button" data-filter="spray"> Neurology</button>
                    <button class="btn btn-default filter-button" data-filter="irrigation">Laboratry</button>
                </div>
                <br />
                <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                    <img src={{ asset('build/assets/img/gallery/gallery_01.jpg') }} class="img-responsive">
                </div>
                <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                    <img src={{ asset('build/assets/img/gallery/gallery_02.jpg') }} class="img-responsive">
                </div>
                <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                    <img src={{ asset('build/assets/img/gallery/gallery_03.jpg') }} class="img-responsive">
                </div>
                <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                    <img src={{ asset('build/assets/img/gallery/gallery_04.jpg') }} class="img-responsive">
                </div>
                <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                    <img src={{ asset('build/assets/img/gallery/gallery_05.jpg') }} class="img-responsive">
                </div>
                <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                    <img src={{ asset('build/assets/img/gallery/gallery_06.jpg') }} class="img-responsive">
                </div>
            </div>
        </div>
    </div>
    <!-- ######## Gallery End ####### -->

    <!--  ************************* Contact Us Starts Here ************************** -->

    <section id="contact_us" class="contact-us-single py-5">
        <div class="container">
            @if (session('client_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('client_message') }}
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center">Contact Form</h4>
                    <form method="post" action="{{ route('website.messages.store') }}#contact_us">
                        @csrf
                        <div class="row g-2 mb-3 align-items-center">
                            <div class="col-sm-4 text-end">
                                <label for="name" class="col-form-label">Enter Name:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter Name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-2 mb-3 align-items-center">
                            <div class="col-sm-4 text-end">
                                <label for="email" class="col-form-label">Email Address:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Enter Email Address" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-2 mb-3 align-items-center">
                            <div class="col-sm-4 text-end">
                                <label for="phone" class="col-form-label">Mobile Number:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="phone" name="phone" class="form-control"
                                    placeholder="Enter Phone Number" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-2 mb-3 align-items-center">
                            <div class="col-sm-4 text-end">
                                <label for="title" class="col-form-label">Title:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="Enter text title" value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-2 mb-3 align-items-start">
                            <div class="col-sm-4 text-end">
                                <label for="message" class="col-form-label">Enter Message:</label>
                            </div>
                            <div class="col-sm-8">
                                <textarea id="message" name="text" rows="5" class="form-control" placeholder="Enter Your Message">{{ old('text') }}</textarea>
                                @error('text')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="offset-sm-4 col-sm-8 d-grid">
                                <button type="submit" class="btn btn-success btn-lg">Send Message</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
