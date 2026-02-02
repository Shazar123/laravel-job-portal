@extends('layout')

@section('title', 'Manage Jobs')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Manage Jobs</h1>
    <a href="{{ route('admin.jobs.create') }}" class="btn">Create New Job</a>
</div>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Company</th>
            <th>Status</th>
            <th>Applications</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jobs as $job)
        <tr>
            <td>{{ $job->title }}</td>
            <td>{{ $job->company }}</td>
            <td>{{ ucfirst($job->status) }}</td>
            <td>{{ $job->applications->count() }}</td>
            <td>
                <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-success">Edit</a>
                <a href="{{ route('admin.applications', $job->id) }}" class="btn">View Applicants</a>
                <form method="POST" action="{{ route('admin.jobs.destroy', $job->id) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this job?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
