<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicJobController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Job::query();

        $contractType = $request->filled('contract_type') ? strtolower($request->input('contract_type')) : null;
        $location = $request->filled('location') ? $request->location : null;
        $salaryMin = $request->filled('salary_min') ? $request->salary_min : null;

        if($location) {
            $query->where('location', 'like', '%' . $location . '%');
        }
        if($contractType) {
            $query->where('contract_type', $contractType);
        }
        if($salaryMin) {
            $query->where('salary', '>=', $salaryMin);
        }
        $query->where('is_approved', true);
        $jobs = $query->latest()->paginate(10);
        return view('public_jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        return view('public_jobs.show', compact('job'));
    }
}
