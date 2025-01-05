@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center">Features of TripAI</h1>
    <p class="text-center text-muted">Discover why TripAI is the ultimate AI-powered travel companion.</p>
    
    <div class="row mt-5">
        <div class="col-md-4 text-center">
            <img src="/path-to-image1.jpg" class="img-fluid mb-3" alt="Feature 1">
            <h5>AI-Powered Trip Planning</h5>
            <p>Personalized trip recommendations based on your preferences.</p>
        </div>
        <div class="col-md-4 text-center">
            <img src="/path-to-image2.jpg" class="img-fluid mb-3" alt="Feature 2">
            <h5>Flight Finder</h5>
            <p>Discover the best flight deals quickly and efficiently.</p>
        </div>
        <div class="col-md-4 text-center">
            <img src="/path-to-image3.jpg" class="img-fluid mb-3" alt="Feature 3">
            <h5>Seamless Itineraries</h5>
            <p>Create detailed itineraries effortlessly with AI assistance.</p>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('home') }}" class="btn btn-primary">Go Back to Home</a>
    </div>
</div>

<!-- Styles -->
<style>
h1 {
    font-size: 2.5rem;
    font-weight: bold;
}

p {
    font-size: 1.1rem;
    line-height: 1.6;
}

img {
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
}
</style>
@endsection
