<?php

namespace App\Http\Livewire;

use App\Mail\OrderCompletedMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Project;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use Webpatser\Uuid\Uuid;

class CartIndex extends Component
{
    public Collection $cartItems;
    public int        $totalCost = 0;
    public Collection $shippingMethods;
    public int        $shippingCost = 0;
    public Project    $project;
    public string     $sessionId;

    public string $name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $street_name = '';
    public string $city = '';
    public string $country = '';
    public string $details = '';
    public int    $selectedMethod = 0;
    public bool   $ordered = false;

    public array $rules = [
        'name'        => 'required|string|min:3|max:35',
        'last_name'   => 'required|string|min:3|max:35',
        'email'       => 'required|string|min:10|max:35',
        'phone'       => 'required|string|min:5|max:15',
        'street_name' => 'required|string|min:5|max:50',
        'city'        => 'required|string|min:3|max:50',
        'country'     => 'required|string|min:5|max:50',
        'details'     => 'string|max:200',
    ];

    public function mount(): void
    {
        $this->project = Project::where('domain_url', request()->getHost())
            ->orWhere('subdomain_url', str_replace('.websiter.com', '', request()->getHost()))
            ->whereActive(true)
            ->firstOrFail();

        $this->sessionId = Session::get('websiter-cart') ?? '';
        $this->cartItems = new Collection();

        if ($this->sessionId) {
            $this->cartItems = Cart::where('session_id', $this->sessionId)->get();
        }

        $this->totalCost = count($this->cartItems) > 0 ? $this->cartItems->sum('cart_item_price') : 0;
        $this->shippingMethods = $this->project->shippingMethods;

        if (count($this->shippingMethods) > 0) {
            $this->selectedMethod = $this->shippingMethods[0]->id;
            $this->shippingCost   = $this->shippingMethods->first()->price;
            $this->totalCost      += $this->shippingCost;
        }
    }

    public function updatedSelectedMethod(): void
    {
        $this->shippingCost = $this->project
                                   ->shippingMethods
                                   ->where('id', $this->selectedMethod)
                                   ->first()
                                   ->price;

        $this->totalCost = $this->cartItems->sum('cart_item_price')
            + $this->shippingCost;
    }

    public function change(int $cartId, int $increment): void
    {
        $cart = Cart::find($cartId);
        if ($cart) {
            $cart->increment('quantity', $increment);

            if ($cart->quantity === 0) {
                $cart->delete();
            }

            $this->cartItems = Cart::where('session_id', $this->sessionId)
                ->where('project_id', $this->project->id)
                ->get();

            if (count($this->cartItems) > 0) {
                $this->totalCost = $this->cartItems->sum('cart_item_price') + $this->shippingCost;
            }

            $this->emitTo('cart-component', 'cartUpdated');
        }
    }

    public function store(): void
    {
        $this->validate();

        if(! $cartSessionId = Session::get('websiter-cart')) {
            throw new ValidationException('Cart is empty');
        }

        $order = Order::create([
            'project_id'         => $this->cartItems[0]->project_id,
            'shipping_method_id' => $this->selectedMethod > 0 ? $this->selectedMethod : null,
            'confirm_code'       => Uuid::generate(4),
            'name'               => $this->name,
            'last_name'          => $this->last_name,
            'street_name'        => $this->street_name,
            'city'               => $this->city,
            'country'            => $this->country,
            'phone'              => $this->phone,
            'email'              => $this->email,
            'details'            => $this->details,
        ]);

        $cartItems = Cart::where('session_id', $cartSessionId)->get();
        foreach ($cartItems as $cartItem) {
            $order->orderItems()->create([
                'bit_id'    => $cartItem->bit_id,
                'quantity'  => $cartItem->quantity,
                'bit_price' => $cartItem->bit->price,
            ]);

            $cartItem->delete();
        }

        Session::remove('websiter-cart');
        $this->emitTo('cart-component', 'cartUpdated');
        Mail::to($order->email)->send(new OrderCompletedMail($order));
        $this->ordered = true;
    }

    public function back(): Redirector
    {
        return redirect()->route('home');
    }

    public function render(): View
    {
        return view('livewire.cart-index');
    }
}
