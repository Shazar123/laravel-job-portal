<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // User side - Browse jobs
    public function index()
    {
        $jobs = Job::where('status', 'active')->latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    // User side - View job details
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    // Admin side - List all jobs
    public function adminIndex()
    {
        $jobs = Job::withCount('applications')->latest()->get();
        return view('admin.jobs', compact('jobs'));
    }

    // Admin side - Show create form
    public function create()
    {
        return view('admin.create-job');
    }

    // Admin side - Store new job
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'company' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:50',
            'status' => 'required|in:active,closed',
        ]);

        Job::create($request->all());

        return redirect()->route('admin.jobs')->with('success', 'Job created successfully!');
    }

    // Admin side - Delete job
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs')->with('success', 'Job deleted successfully!');
    }
}
