<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $jobs = auth()->user()->jobs()->latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'contract_type' => 'required|string',
            'salary' => 'nullable|integer',
        ]);

        auth()->user()->jobs()->create($data);

        return redirect()->route('company.jobs.index')->with('success', 'Annuncio creato!');
    }

    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'contract_type' => 'required|string',
            'salary' => 'nullable|integer',
        ]);

        $job->update($data);

        return redirect()->route('company.jobs.index')->with('success', 'Annuncio aggiornato!');
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();

        return redirect()->route('company.jobs.index')->with('success', 'Annuncio eliminato.');
    }
}
