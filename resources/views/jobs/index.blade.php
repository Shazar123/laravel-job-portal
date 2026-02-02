@extends('layout')

@section('title', 'Browse Jobs')

@section('content')
<h1>Available Jobs</h1>

@foreach($jobs as $job)
<div class="card">
    <h3>{{ $job->title }}</h3>
    <p><strong>Company:</strong> {{ $job->company }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Salary:</strong> {{ $job->salary ?? 'Not specified' }}</p>
    <p>{{ Str::limit($job->description, 150) }}</p>
    <a href="{{ route('jobs.show', $job->id) }}" class="btn">View Details</a>
</div>
@endforeach

@if($jobs->isEmpty())
    <p>No jobs available at the moment.</p>
@endif
@endsection
