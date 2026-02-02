@extends('layout')

@section('title', 'Create Job')

@section('content')
<div class="card">
    <h2>Create New Job</h2>
    <form method="POST" action="{{ route('admin.jobs.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Job Title" required>
        <input type="text" name="company" placeholder="Company Name" required>
        <input type="text" name="location" placeholder="Location" required>
        <input type="text" name="salary" placeholder="Salary (optional)">
        <textarea name="description" rows="5" placeholder="Job Description" required></textarea>
        <select name="status">
            <option value="active">Active</option>
            <option value="closed">Closed</option>
        </select>
        <button type="submit" class="btn">Create Job</button>
    </form>
</div>
@endsection
