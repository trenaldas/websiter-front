<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class ContactUs extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';

    public Project $project;

    public $rules = [
        'name'    => 'required|string|min:3|max:25',
        'email'   => 'required|string',
        'phone'   => 'string|min:5|max:25',
        'message' => 'string|min:10|max:500',
    ];

    public function mount(): void
    {
        $this->project = Project::where('domain_url', request()->getHost())
            ->orWhere('subdomain_url', str_replace('.websiter.com', '', request()->getHost()))
            ->whereActive(true)
            ->firstOrFail();
    }

    public function store(): void
    {
        $this->validate();

        $this->project->queries()->create([
            'name'    => $this->name,
            'email'   => $this->name,
            'phone'   => $this->phone,
            'message' => $this->message,
        ]);

        session()->flash('message', $this->project->mail_query_success_message);
    }

    public function render()
    {
        return view('livewire.contact-us');
    }
}
