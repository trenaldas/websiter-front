@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => $url])
{{ $order->project->title }}
@endcomponent
@endslot

# Your Order Has Been Placed

Hello, {{ $order->name }} {{ $order->surname }}, thanks for placing your order.
Please confirm your order by pressing the button bellow.
@component('mail::button', ['url' => $url . '/order/' . $order->id . '/confirm/' . $order->confirm_code])
Confirm
@endcomponent
@component('mail::table')
| Item          | Price/Item    | Qty      | Price  |
| ------------- |:-------------:|:--------:|--------:
@foreach($order->orderItems as $orderItem)
| {{ $orderItem->bit->name }} | ${{ number_format($orderItem->bit_price / 100, 2) }} | {{ $orderItem->quantity }} | ${{ number_format(($orderItem->bit_price * $orderItem->quantity) / 100, 2) }} |
@endforeach
|||Subtotal: | ${{ number_format($order->orderItems->sum('order_item_full_cost') / 100, 2) }}|
@endcomponent
@if($shipping)
Shipping: ${{ number_format($shipping / 100, 2) }}
@endif
<br>
Total Cost: ${{ number_format(($order->orderItems->sum('order_item_full_cost') + $shipping) / 100, 2) }}
<br>
<br>
Thanks,<br>
{{ $order->project->title }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© 2021  {{ $order->project->title }}. All rights reserved.
@endcomponent
@endslot
@endcomponent
