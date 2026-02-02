@extends('layout')

@section('title', $job->title)

@section('content')
<div class="card">
    <h1>{{ $job->title }}</h1>
    <p><strong>Company:</strong> {{ $job->company }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Salary:</strong> {{ $job->salary ?? 'Not specified' }}</p>
    <hr style="margin: 1rem 0;">
    <h3>Description</h3>
    <p>{{ $job->description }}</p>

    @auth
        @if(auth()->user()->role === 'user')
            <button onclick="applyJob({{ $job->id }})" class="btn" style="margin-top: 1rem;">Apply Now</button>
        @endif
    @else
        <p style="margin-top: 1rem;"><a href="{{ route('login') }}">Login</a> to apply for this job.</p>
    @endauth
</div>

<script>
function applyJob(jobId) {
    if(!confirm('Are you sure you want to apply for this job?')) return;

    fetch('/api/apply', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ job_id: jobId })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if(data.success) {
            window.location.href = '/my-applications';
        }
    })
    .catch(err => alert('Error applying for job'));
}
</script>
@endsection
