@component('mail::message')

{{-- Body --}}
{{-- # Order Status Update --}}
<h1>Order passed</h1>
<p>Dear {{ $user->lastname }} {{ $user->firstname }} ,</p>

<p>We wanted to inform you about the status of your order with order number: <strong>{{ $this->details->order_detail->id }}</strong>.</p>

<p><strong>Order Status:</strong> {{   $this->details->order_status->name }}</p>

<p><strong>Order Details:</strong></p>
<ul>
    @foreach($order_items as $item)
        <li>{{ $item['name'] }} ({{ $item['quantity'] }})</li>
    @endforeach
    <li>items</li>
</ul>
{{-- Action Button --}}
@isset($viewOrderUrl)
    @component('mail::button', ['url' => $viewOrderUrl, 'color' => 'primary'])
        View Order Details
    @endcomponent
@endisset

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    @endcomponent
@endslot
@endcomponent
