{{-- @extends('layouts.app') --}}

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   TripAI
  </title>
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="{{url('img/favicon.jpeg')}}" rel="icon">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
 </head>
 <body>
    @include('layouts.navigation')
  <div class="container-fluid vh-100 d-flex p-0">
   <div class="col-md-6 d-flex flex-column p-3">
    <div class="mb-3">

        <button class="btn btn-outline-secondary" type="button">
            7 Day Island Hopping Trip
        </button>

    </div>
    <div class="flex-grow-1 ">
        <div class="d-flex align-content-end align-items-end flex-wrap h-100">
            <div class="row">

                <div class="d-flex justify-content-start mb-3">
                    <div class="col-md-6 col-lg-6 col-6">
                    <div class="p-3 bg-light rounded">
                     Hey, Layla here! Excited to help you with anything travel related. I can tell you where to go, what time of year to visit, what to do there...the list is endless. I’m on the edge of my seat, ask me anything.
                    </div>
                 </div>
            </div>

                <div class="d-flex justify-content-end mb-3">
                    <div class="col-md-6 col-lg-6 col-6">
                    <div class="p-3 text-white rounded" style="background-color: #0B0B60;">
                     Island hopping, huh? Sounds like a tropical dream! 🌴
                    </div>
                   </div>
            </div>

        </div>

     <div class="d-flex align-items-center mb-3">
      <img alt="User profile picture" class="rounded-circle me-2" height="40" src="https://storage.googleapis.com/a1aa/image/UvOWIqXInEpVN9BGYwM3ci8Ul8oPAAN7ZnMAMkf3nh6wN9AKA.jpg" width="40"/>
      <div class="btn-group" role="group">
       <button class="btn btn-outline-secondary" type="button">
        Maldives
       </button>
       <button class="btn btn-outline-secondary" type="button">
        Greece
       </button>
       <button class="btn btn-outline-secondary" type="button">
        Caribbean
       </button>
      </div>
     </div>
        </div>

    </div>
    <div class="input-group mt-auto">
     <input class="form-control" placeholder="Ask anything..." type="text"/>
     <button class="btn btn-info" type="button" style="background-color: #0B0B60; color: #fff;">
      <i class="fas fa-paper-plane">
      </i>
     </button>
    </div>
   </div>
   <div class="col-md-6 p-0 position-relative">
    <img alt="A woman standing in front of the ocean with a blue sky in the background" class="img-fluid h-100 w-100 " height="800" src="https://storage.googleapis.com/a1aa/image/Y9ugXLkgBBLFANdf5MDs1ACGk1cssBLi5hJWKee73MRftpHQB.jpg" width="800" style="border-radius: 20px;"/>
    <div class="position-absolute top-0 start-50 translate-middle-x text-center text-white mt-3">
        <h1 class="display-6 fw-bold">YOUR TRAVEL AI GENIUS</h1>
    </div>
    <div class="position-absolute bottom-0 start-50 translate-middle-x text-center text-white mb-3">
        <p class="lead">Got a vacation coming up? Start here by asking me anything about it.</p>
        <div class="arrow">
            <i class="fas fa-arrow-left fa-2x"></i>
        </div>
    </div>
</div>
  </div>
 </body>
</html>



