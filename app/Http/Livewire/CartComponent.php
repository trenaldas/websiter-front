<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CartComponent extends Component
{
    public int $cartCount;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function updateCartCount(): void
    {
        $project = Project::where('domain_url', request()->getHost())
            ->orWhere('subdomain_url', str_replace('.websiter.com', '', request()->getHost()))
            ->whereActive(true)
            ->firstOrFail();

        $sessionId = Session::get('websiter-cart');

        if ($sessionId) {
            $this->cartCount = $project->carts->where('session_id', $sessionId)->count();
        }
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
