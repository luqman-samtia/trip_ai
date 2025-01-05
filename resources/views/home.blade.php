@extends('layouts.app')

@section('content')
<div class="container-fluid position-relative p-0">
    <!-- Navbar -->
    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">AI Travel & Tours</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('umra.haj') }}">Umra & Haj</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav> --}}

    <!-- Hero Section -->

    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">TripAI - Your Smart TravelBuddy</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Enjoy stress-free travel from start to finish. From booking flights and hotels to arranging personalized tours and transfers, we ensure your travel smarter, not harder!</p>
                    <div class="position-relative w-75 mx-auto animated slideInDown">

                        @auth
                        {{-- action="{{ route('search') }}" method="POST" --}}
                        <form >
                            @csrf
                        <div class="search-box">
                            <div class="d-flex align-items-center">
                                <img alt="User profile picture" class="rounded-circle me-2" height="40" src="https://storage.googleapis.com/a1aa/image/JjfIrUk5EemcWEqMv8R7NTLG2v9aFN2Q4hyc0xmWoHuIt0BUA.jpg" width="40"/>
                                <input id="changingText" type="text"/>
                                <div>
                                    <button id="askAnythingButton" class="btn btn-secondary btn-sm " type="button">
                                        Ask Anything
                                    </button>
                                </div>

                            </div>
                            <hr class="mt-5 mb-1"/>
                            <div class="" style="display: flex;justify-content: space-between;">
                                <button class="btn btn-outline-secondary btn-sm me-2 other-button" type="button">
                                    Inspire me where to go
                                </button>
                                <button class="btn btn-outline-secondary btn-sm  me-2 other-button" type="button">
                                    Create a new Trip
                                </button>
                                <button class="btn btn-outline-secondary btn-sm  me-2 other-button" type="button">
                                    Find family hotels in Dubai
                                </button>
                                <button class="btn btn-outline-secondary btn-sm other-button" type="button">
                                    Build 7 day island hopping
                                </button>
                            </div>
                        </div>
                        <div id="errorMessage" class="error" style="display: none;">Please enter some text.</div>

                    </form>
                    @else
                        <p class="text-center text-warning">Please <a class="btn btn-primary btn-sm" href="{{ route('login') }}">Login</a> or <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a> to use the search functionality.</p>
                    @endauth
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible mt-5">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {{ session('error') }}
                    </div>
                    @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to AI Travel & Tours</h1>
        <p class="lead">Discover the best flights, stays, and tours powered by advanced AI.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('umra.haj') }}" role="button">Explore Umra & Haj Packages</a>
    </div> --}}

    <!-- Search Section -->
    {{-- <section class="mt-5">
        <h2 class="text-center">Search for Your Travel Plans</h2>
        @auth
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="prompt" class="form-control" placeholder="Enter your travel requirements (e.g., 'Non-stop flight from JFK to LHR')..." required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Search</button>
            </form>
        @else
            <p class="text-center">Please <a class="btn btn-primary" href="{{ route('login') }}">Login</a> or <a class="btn btn-info" href="{{ route('register') }}">Register</a> to use the search functionality.</p>
        @endauth
    </section> --}}

    <!-- Results Section -->
    {{-- @if(session('error'))
<div class="alert alert-danger mt-4">
    {{ session('error') }}
</div>
@endif --}}




@if(isset($results) && !empty($results))
<section class="mt-5">
    <h2 class="text-center">Search Results</h2>
    <div class="row">
        @foreach($results as $result)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        @if($result['type'] === 'flight')
                            <h5 class="card-title">Flight</h5>
                            <p>Airline: {{ $result['airline'] }}</p>
                            <p>Price: {{ $result['price'] }}</p>
                            <p>Duration: {{ $result['duration'] }}</p>
                            <p>Stops: {{ $result['stops'] }}</p>
                        @else
                            <h5 class="card-title">Hotel</h5>
                            <p>Name: {{ $result['name'] }}</p>
                            <p>Price: {{ $result['price'] }}</p>
                            <p>Location: {{ $result['location'] }}</p>
                            <p>Rating: {{ $result['rating'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@else
    <div class="text-center mt-4">
        <p>No results to display yet. Please use the search functionality above.</p>
    </div>
@endif

</div>

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="{{url('img/home_about_section.jpg')}}" alt="" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h5 class="section-title  text-start text-primary pe-3">Who We Are</h5>
                <h1 class="mb-4">Welcome to <span class="text-primary">TripAI - Your Smart TravelBuddy</span></h1>
                <p class="mb-4">At TripAI, we believe that planning a journey should be as exciting as the trip itself. With cutting-edge AI technology, we make travel accessible, personalized, and unforgettable."
                </p>
                {{-- <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p> --}}
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>First Class Flights</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Handpicked Hotels</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>5 Star Accommodations</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Latest Model Vehicles</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>150 Premium City Tours</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Service</p>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title  text-center text-primary px-3">Services</h6>
            <h1 class="mb-5">Our Services</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp " data-wow-delay="0.1s" >
                <div class="service-item rounded pt-3" style="min-height: 300px;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                        <h5>WorldWide Tours</h5>
                        <p>WorldWide Tours is your gateway to discovering the most breathtaking destinations across the globe. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded pt-3" style="min-height: 300px;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                        <h5>Hotel Reservation</h5>
                        <p>Hotel Reservation is a comprehensive system designed to streamline the process of booking accommodations at hotels. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded pt-3" style="min-height: 300px;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-user text-primary mb-4"></i>
                        <h5>Travel Guides</h5>
                        <p>Travel Guides are essential resources for any traveler, providing comprehensive information and expert advice on a wide range of destinations around the world.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item rounded pt-3" style="min-height: 300px;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                        <h5>Event Management</h5>
                        <p>Event Management encompasses the planning, organizing, and execution of various types of events, ranging from corporate conferences and trade shows to weddings, festivals, and parties. </p>
                    </div>
                </div>
            </div>




        </div>
    </div>
</div>
<!-- Service End -->

<!-- Destination Start -->
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title  text-center text-primary px-3">Destination</h6>
                <h1 class="mb-5">Popular Destination</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="img/bangkok-city-sunrise-thailand.jpg" alt="">
                                <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">30% OFF</div>
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Thailand</div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="img/view-from-top-st-elias-chavara-pilgrimage-center-india.jpg" alt="">
                                <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">25% OFF</div>
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Malaysia</div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="img/park-city.jpg" alt="">
                                <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">35% OFF</div>
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Australia</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" href="">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{asset('img/vertical-destination.jpg')}}" alt="" style="object-fit: cover;">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">20% OFF</div>
                        <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Indonesia</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Destination Start -->

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
            <h6 class="section-title text-center text-primary px-3">Process</h6>
            <h1 class="mb-5">3 Easy Steps</h1>
        </div>
        <div class="row gy-5 gx-4 justify-content-center">
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4">
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
                <div class="position-relative border border-primary pt-5 pb-4 px-4">
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
                <div class="position-relative border border-primary pt-5 pb-4 px-4">
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

     <!-- Team Start -->
     <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary px-3">Travel Guide</h6>
                <h1 class="mb-5">Meet Our Guide</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-1.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/guy-with-map.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-3.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/22418.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

     <!-- Testimonial Start -->
     <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title  text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Clients Say!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="img/team-1.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mb-0">New York City, often simply called New York, is one of the most iconic and vibrant cities in the world.

                    </p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="img/testimonial-2.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mt-2 mb-0">New York City, often simply called New York, is one of the most iconic and vibrant cities in the world.</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="img/testimonial-3.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mt-2 mb-0">New York City, often simply called New York, is one of the most iconic and vibrant cities in the world.</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="img/team-3.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mt-2 mb-0">New York City, often simply called New York, is one of the most iconic and vibrant cities in the world.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    {{-- @include() --}}
    <script>

        const texts = [
            "Plan me a trip to Canada’s stunning lake",
            "Plan me a trip to the beautiful beaches of Bali",
            "Plan me a trip to the historic sites of Rome",
            "Plan me a trip to the vibrant city of Tokyo"
        ];
        let index = 0;
        let charIndex = 0;
        const changingText = document.getElementById("changingText");

        function typeText() {
            if (charIndex < texts[index].length) {
                changingText.placeholder += texts[index].charAt(charIndex);
                charIndex++;
                setTimeout(typeText, 100);
            } else {
                setTimeout(deleteText, 2000);
            }
        }

        function deleteText() {
            if (charIndex > 0) {
                changingText.placeholder = changingText.placeholder.slice(0, -1);
                charIndex--;
                setTimeout(deleteText, 50);
            } else {
                index = (index + 1) % texts.length;
                setTimeout(typeText, 500);
            }
        }

        typeText();

        const askAnythingButton = document.getElementById('askAnythingButton');
        const otherButtons = document.querySelectorAll('.other-button');
        const errorMessage = document.getElementById('errorMessage');

        const showLoadingAndRedirect = () => {
            if (changingText.value.trim() === "") {
                errorMessage.style.display = "block";
                return;
            }

            errorMessage.style.display = "none";
            askAnythingButton.disabled = true;
            askAnythingButton.innerHTML = '<span class="loading-spinner"></span> Loading...';


            setTimeout(() => {
                window.location.href = '/chat';
            }, 1000);
        };

        askAnythingButton.addEventListener('click', showLoadingAndRedirect);
        otherButtons.forEach(button => button.addEventListener('click', showLoadingAndRedirect));
    </script>
@endsection
{{-- <x-button-popup></x-button-popup> --}}
