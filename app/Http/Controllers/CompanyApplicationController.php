<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class CompanyApplicationController extends Controller
{
    public function index(Job $job){
        if ($job->user_id !== auth()->id()) {
            abort(403, 'Non autorizzato');
        }

        $applications = $job->applications()->with('user')->latest()->get();
        return view('company.applications.index', compact('job', 'applications'));
    }
            public function update(Request $request, Job $job, \App\Models\Application $application)
        {
            if ($job->user_id !== auth()->id() || $application->job_id !== $job->id) {
                abort(403, 'Non autorizzato');
            }

            $request->validate([
                'status' => 'required|in:in valutazione,accettata,rifiutata',
            ]);

            $application->update([
                'status' => $request->status,
            ]);

          //  $application->user->notify(new \App\Notifications\ApplicationStatusUpdatedNotification($application));
            return back()->with('success', 'Stato candidatura aggiornato.');
        }

}
