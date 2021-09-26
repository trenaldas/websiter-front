<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class TagShow extends Component
{
    public Tag     $tag;
    public Project $project;

    public function mount(): void
    {
        if (
            ! $this->tag->active
            || ($this->tag->parentTag && !$this->tag->parentTag->active)
        ) {
            abort(404);
        }

        $this->project = Project::where('domain_url', request()->getHost())
            ->orWhere('subdomain_url', str_replace('.websiter.com', '', request()->getHost()))
            ->whereActive(true)
            ->firstOrFail();
    }

    public function addToCart(int $bitId): void
    {
        $sessionId = Session::get('websiter-cart');

        if (! $sessionId) {
            $sessionId = Str::random(20);
            Session::put('websiter-cart', $sessionId);
        }

        $cart = Cart::where('session_id', $sessionId)
            ->where('bit_id', $bitId)
            ->where('project_id', $this->project->id)
            ->first();

        if ($cart) {
            $cart->increment('quantity');
            $this->emitTo('cart-component', 'cartUpdated');
            $this->emitTo('tag-show', 'added');

            return;
        }

        Cart::create([
            'session_id' => $sessionId,
            'bit_id'     => $bitId,
            'project_id' => $this->project->id,
        ]);

        $this->emitTo('cart-component', 'cartUpdated');
        $this->emitTo('tag-show', 'added');
    }

    public function render()
    {
        return view('livewire.tag-show');
    }
}
