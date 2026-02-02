@extends('layout')

@section('title', 'My Applications')

@section('content')
<h1>My Applications</h1>

<table>
    <thead>
        <tr>
            <th>Job Title</th>
            <th>Company</th>
            <th>Applied On</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($applications as $app)
        <tr>
            <td>{{ $app->job->title }}</td>
            <td>{{ $app->job->company }}</td>
            <td>{{ $app->created_at->format('M d, Y') }}</td>
            <td>
                @if($app->status === 'pending')
                    <span style="color: orange;">Pending</span>
                @elseif($app->status === 'approved')
                    <span style="color: green;">Approved</span>
                @else
                    <span style="color: red;">Rejected</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($applications->isEmpty())
    <p>You haven't applied to any jobs yet.</p>
@endif
@endsection
