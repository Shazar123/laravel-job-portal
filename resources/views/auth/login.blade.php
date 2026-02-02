@extends('layout')

@section('title', 'Login')

@section('content')
<div class="card" style="max-width: 500px; margin: 2rem auto;">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn">Login</button>
    </form>
    <p style="margin-top: 1rem;">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
</div>
@endsection
