@extends('layout')

@section('title', 'Applications for ' . $job->title)

@section('content')
<h1>Applications for: {{ $job->title }}</h1>

<table>
    <thead>
        <tr>
            <th>Applicant Name</th>
            <th>Email</th>
            <th>Applied On</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($applications as $app)
        <tr>
            <td>{{ $app->user->name }}</td>
            <td>{{ $app->user->email }}</td>
            <td>{{ $app->created_at->format('M d, Y') }}</td>
            <td>{{ ucfirst($app->status) }}</td>
            <td>
                @if($app->status === 'pending')
                    <form method="POST" action="{{ route('admin.applications.update', $app->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form method="POST" action="{{ route('admin.applications.update', $app->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($applications->isEmpty())
    <p>No applications yet.</p>
@endif
@endsection
