<?php

namespace App\Http\Livewire;

use App\Models\Bit;
use App\Models\Cart;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class BitShow extends Component
{
    public Bit $bit;
    public Project $project;

    public function mount(): void
    {
        // Do not show bit if it does not have children bit,
        // or if its tag is inactive
        if (! $this->bit->tag->active
            || count($this->bit->childrenBits) === 0
        ) {
            abort(404);
        }

        $this->project = Project::where('domain_url', request()->getHost())
            ->orWhere('subdomain_url', str_replace('.tnyweb.com', '', request()->getHost()))
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

        $project = Project::where('domain_url', request()->getHost())
            ->orWhere('subdomain_url', str_replace('.websiter.com', '', request()->getHost()))
            ->whereActive(true)
            ->firstOrFail();

        $cart = Cart::where('session_id', $sessionId)
            ->where('bit_id', $bitId)
            ->where('project_id', $project->id)
            ->first();

        if ($cart) {
            $cart->increment('quantity');
            $this->emitTo('cart-component', 'cartUpdated');

            $this->emitTo('bit-show', 'added', $cart->bit->name);

            return;
        }

        $cart = Cart::create([
            'session_id' => $sessionId,
            'bit_id'     => $bitId,
            'project_id' => $project->id,
        ]);

        $this->emitTo('cart-component', 'cartUpdated');
        $this->emitTo('bit-show', 'added', $cart->bit->name);
    }

    public function render(): View
    {
        return view('livewire.bit-show');
    }
}
