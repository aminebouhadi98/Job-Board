<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;


class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        $request->validate([
            'cover_letter' => 'required|string|min:10',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048', // Aggiungi validazione per il CV
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv', 'public'); // Salva il CV nella cartella 'cvs' nel disco 'public'
        }
        $existingApplication = Application::where('job_id', $job->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingApplication) {
            $existingApplication->update([
                'cover_letter' => $request->cover_letter,
                'cv_path' => $cvPath,
            ]);
           return back()->with('application_updated','La tua candidatura è stata aggiornata con successo!');
        }
       $application = Application::create([
            'job_id' => $job->id,
            'user_id' => auth()->id(),
            'cover_letter' => $request->cover_letter,
            'cv_path' => $cvPath,
        ]);
     //   $job->company->notify(new \App\Notifications\NewApplicationNotification($application));
        return redirect()->back()->with('success', 'Candidatura inviata con successo!');
    }
}
