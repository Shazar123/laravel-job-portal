<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // API endpoint - Apply for job (AJAX)
    public function apply(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id'
        ]);

        // Check if already applied
        $exists = Application::where('user_id', Auth::id())
            ->where('job_id', $request->job_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'You have already applied for this job!'
            ]);
        }

        Application::create([
            'user_id' => Auth::id(),
            'job_id' => $request->job_id,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully!'
        ]);
    }

    // User side - My applications
    public function myApplications()
    {
        $applications = Application::where('user_id', Auth::id())
            ->with('job')
            ->latest()
            ->get();

        return view('applications.index', compact('applications'));
    }

    // Admin side - View applicants for a job
    public function viewApplicants(Job $job)
    {
        $applications = $job->applications()->with('user')->get();
        return view('admin.applications', compact('job', 'applications'));
    }

    // Admin side - Update application status
    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application ' . $request->status . ' successfully!');
    }
}
