@extends('layouts.app')

@section('content')
{{-- <div class="container">

    <!-- Hero Section -->
    <div class="jumbotron text-center">
        <h1 class="display-4">Umra & Haj Packages</h1>
        <p class="lead">Plan your sacred journey with ease and confidence.</p>
    </div>

    <!-- Placeholder Section -->
    <section class="mt-5">
        <h2 class="text-center">Available Packages</h2>
        <p class="text-center">Explore our exclusive Umra & Haj packages tailored to your needs.</p>
    </section>

    <!-- Search Section -->
    <section class="mt-5">
        <h2 class="text-center">Search for Your Umra & Haj Plans</h2>
        @auth
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="prompt" class="form-control" placeholder="Enter your requirements (e.g., 'Umra package from Jeddah with 5-star accommodation')..." required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Search</button>
            </form>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a> to use the search functionality.</p>
        @endauth
    </section>
</div> --}}


<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">


    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Umrah & Hajj Packages</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Umrah & Hajj</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->


    <!-- Package Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title  text-center  px-3">Packages</h6>
                <h1 class="mb-5">Available Packages</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp service-item" data-wow-delay="0.1s">
                    <div class="package-item ">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/umra1.jpg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt  me-2"></i>Makkah</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt  me-2"></i>40 days</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user  me-2"></i>23 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$149.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                            </div>
                            <p>Hajj is one of the five pillars of Islam, a mandatory religious duty for Muslims that must be carried out at least once in their lifetime by those who are physically and financially capable</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="#" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                <a href="#" class="btn btn-sm btn-primary px-3 " style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp service-item" data-wow-delay="0.3s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/hajj2.jpg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt  me-2"></i>Makkah</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt  me-2"></i>40 days</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user  me-2"></i>23 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$139.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                            </div>
                            <p>Hajj is one of the five pillars of Islam, a mandatory religious duty for Muslims that must be carried out at least once in their lifetime by those who are physically and financially capable</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="#" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                <a href="#" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp service-item" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/umra1.jpg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt  me-2"></i>Madina</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt  me-2"></i>40 days</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user  me-2"></i>23 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$189.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                                <small class="fa fa-star "></small>
                            </div>
                            <p>Umrah is a pilgrimage to Mecca that can be undertaken at any time of the year, unlike Hajj which has specific dates. Although it is not obligatory, it is highly recommended in Islam</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="#" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                <a href="#" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Package End -->


    <!-- Booking Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="booking p-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-6 text-white">
                        <h6 class="text-white text-uppercase">Booking</h6>
                        <h1 class="text-white mb-4">Online Booking</h1>
                        <p class="mb-4">Online Booking systems revolutionize the way reservations are made, offering a convenient and efficient solution for booking services such as travel, accommodations, events, and more. These systems allow users to make reservations from the comfort of their home or on-the-go, providing real-time availability and secure payment options. Whether you're planning a vacation, scheduling an appointment, or reserving a table at a restaurant, Online Booking systems simplify the process and enhance the overall customer experience.

                            .</p>
                        <a class="btn btn-outline-light py-3 px-5 mt-2" href="">Read More</a>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-white mb-4">Book A Tour</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control bg-transparent datetimepicker-input" id="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                        <label for="datetime">Date & Time</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-transparent" id="select1">
                                            <option value="1">Destination 1</option>
                                            <option value="2">Destination 2</option>
                                            <option value="3">Destination 3</option>
                                        </select>
                                        <label for="select1">Destination</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-transparent" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                        <label for="message">Special Request</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-outline-light w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking Start -->

    <!-- Process Start -->
 <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center  px-3">Process</h6>
            <h1 class="mb-5">3 Easy Steps</h1>
        </div>
        <div class="row gy-5 gx-4 justify-content-center">
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4 service-item">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                        <i class="fa fa-globe fa-3x text-white"></i>
                    </div>
                    <h5 class="mt-4">Choose A Destination</h5>
                    <hr class="w-25 mx-auto bg-primary mb-1">
                    <hr class="w-50 mx-auto bg-primary mt-0">
                    <p class="mb-0">Choosing a travel destination can be an exciting yet challenging task, given the numerous incredible places to explore around the world.

                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4 service-item">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                        <i class="fa fa-dollar-sign fa-3x text-white"></i>
                    </div>
                    <h5 class="mt-4">Pay Online</h5>
                    <hr class="w-25 mx-auto bg-primary mb-1">
                    <hr class="w-50 mx-auto bg-primary mt-0">
                    <p class="mb-0">Pay Online is a secure and convenient payment solution that allows customers to make transactions over the internet.

                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4 service-item">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                        <i class="fa fa-plane fa-3x text-white"></i>
                    </div>
                    <h5 class="mt-4">Fly Today</h5>
                    <hr class="w-25 mx-auto bg-primary mb-1">
                    <hr class="w-50 mx-auto bg-primary mt-0">
                    <p class="mb-0">Fly Today is an innovative online travel platform designed to make booking flights quick, easy, and hassle-free.

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Process Start -->
@endsection
