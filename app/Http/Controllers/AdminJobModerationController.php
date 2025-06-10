<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

 class AdminJobModerationController extends Controller
 {
     public function index()
     {
         $jobs = \App\Models\Job::where('is_approved', false)
             ->latest()
             ->get();
         return view('admin.jobs.index', compact('jobs'));
     }
     public function approve(Job $job)
     {
         $job->update(['is_approved' => true]);
         return back()->with('success', 'Annuncio approvato.');
     }
 }

