<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AdminJobModerationController extends Controller
{
    public function index(Request $request)
    {
        //pesca tutti gli utenti che hanno creato annunci
        // utilizza anche le actiobn
        //form request
        $users = User::select('id', 'name')->get();
        $query = Job::query()
            ->join('users', 'job_listings.user_id', '=', 'users.id')
            ->select('job_listings.*', 'users.name as user_name');
        $title = $request->filled('title') ? $request->title : null;
        $contractType = $request->filled('contract_type') ? strtolower($request->input('contract_type')) : null;
        $location = $request->filled('location') ? $request->location : null;
        $salaryMin = $request->filled('salary_min') ? $request->salary_min : null;
        $userId = $request->filled('users') ? $request->users : null;

        $createdAtFrom = $request->filled('created_at_from') ? Carbon::parse($request->created_at_from)->toDateString() : null;
        $createdAtTo = $request->filled('created_at_to') ? Carbon::parse($request->created_at_from)->toDateString() : null;

        if($location) {
            $query->where('job_listings.location', 'like', '%' . $location . '%');
        }
        if($contractType) {
            $query->where('job_listings.contract_type', $contractType);
        }
        if($salaryMin) {
            $query->where('job_listings.salary', '>=', $salaryMin);
        }
        if($title) {
            $query->where('job_listings.title', 'like', '%' . $title . '%');
        }
        if($userId){
            $query->where('job_listings.user_id', $userId);
        }

        if (!is_null($createdAtFrom)) {
            $query->where('job_listings.created_at', '>=', $createdAtFrom . ' 00:00:00');
        }
        if (!is_null($createdAtTo)) {
            $query->where('job_listings.created_at', '<=', $createdAtTo . ' 23:59:59');
        }
        $query->where('is_approved', false)->where('is_deleted', false);
        $jobs = $query->latest()->paginate(10);

        return view('admin.jobs.index', compact('jobs', 'users'));
    }
    public function approve(Job $job)
    {
        $job->update(['is_approved' => true]);
        return back()->with('success', 'Annuncio approvato.');
    }
    public function reject(Job $job)
    {
        try {
            $job->update(['is_approved' => false, 'is_deleted' => true]);
            return back()->with('reject_success', 'Annuncio rifiutato e cancellato.');
        } catch (\Exception $e) {
            return back()->withErrors('Errore durante il rifiuto dell\'annuncio: ' . $e->getMessage());
        }
    }
    public function getRejectedJobs()
    {
        $rejectedJobs = Job::where('is_approved', false)
            ->where('is_deleted', true)
            ->latest()
            ->get();
        return view('admin.jobs.rejected', compact('rejectedJobs'));
    }
    public function reapprove(Job $job)
    {
        try {
            $job->update(['is_approved' => 0, 'is_deleted' => false]);
            return back()->with('reapprove_success', 'Annuncio riapprovato.');
        } catch (\Exception $e) {
            return back()->withErrors('Errore durante la riapprovazione dell\'annuncio: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->withErrors('Errore durante la riapprovazione dell\'annuncio: ' . $e->getMessage());
        }
    }
}
