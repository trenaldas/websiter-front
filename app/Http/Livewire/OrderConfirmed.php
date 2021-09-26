<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class OrderConfirmed extends Component
{
    public string $confirm_code;
    public Order  $order;
    public bool   $confirmed = false;

    public function mount(): void
    {
        if ($this->order->confirm_code === $this->confirm_code) {
            $this->order->update(['confirmed' => true]);
            $this->confirmed = true;
        }
    }

    public function back(): Redirector
    {
        return redirect()->route('home');
    }

    public function render(): View
    {
        return view('livewire.order-confirmed');
    }
}
