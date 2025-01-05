@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Choose Your Plan</h1>
    <form action="{{ route('subscribe') }}" method="POST">
        @csrf
        <input type="radio" name="plan" value="basic" required> Basic ($10) <br>
        <input type="radio" name="plan" value="premium"> Premium ($20) <br>
        <input type="radio" name="plan" value="pro"> Pro ($30) <br>
        <button type="submit" class="btn btn-primary">Subscribe</button>
    </form>
</div>
@endsection
