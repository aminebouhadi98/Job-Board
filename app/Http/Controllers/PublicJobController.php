<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicJobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::query()
        ->join('users', 'job_listings.user_id', '=', 'users.id')
          ->select('job_listings.*', 'users.name as user_name');

        $contractType = $request->filled('contract_type') ? strtolower($request->input('contract_type')) : null;
        $location = $request->filled('location') ? $request->location : null;
        $salaryMin = $request->filled('salary_min') ? $request->salary_min : null;

        if($location) {
            $query->where('job_listings.location', 'like', '%' . $location . '%');
        }
        if($contractType) {
            $query->where('job_listings.contract_type', $contractType);
        }
        if($salaryMin) {
            $query->where('job_listings.salary', '>=', $salaryMin);
        }
        $query->where('job_listings.is_approved', true);
        $jobs = $query->latest()->paginate(10);


        return view('public_jobs.index', compact('jobs'));
    }

public function show(Job $job)
{
    try {
        $existingApplication = Application::where('job_id', $job->id)
            ->where('user_id', auth()->id())
            ->first();

        $application = $existingApplication ?? [];

        return view('public_jobs.show', compact('job', 'application'));

    } catch (\Exception $e) {
        Log::error('Errore nel recupero della candidatura: ' . $e->getMessage());


        return redirect()->back()->with('',$e->getMessage());
    }
}

}
