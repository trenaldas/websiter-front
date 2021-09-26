<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function index(): RedirectResponse
    {
        $project = Project::where('domain_url', request()->getHost())
            ->orWhere('subdomain_url', str_replace('.websiter.com', '', request()->getHost()))
            ->whereActive(true)
            ->firstOrFail();

        return redirect()->route('tag.show', $project->homeTag());
    }
}
