@extends('layout')

@section('title', 'Register')

@section('content')
<div class="card" style="max-width: 500px; margin: 2rem auto;">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit" class="btn">Register</button>
    </form>
    <p style="margin-top: 1rem;">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</div>
@endsection
