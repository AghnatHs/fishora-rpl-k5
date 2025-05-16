<x-app-layout>
    @forelse ($cartOrders as $order)
        <p>ORDER ID : {{ $order->id }}</p>
        @forelse ($order->orderLines as $orderLine)
            <p>------------------------------------------------</p>
            <p>---PRODUCT ID : {{ $orderLine->product->id }}</p>
            <p>---PRODUCT NAME : {{ $orderLine->product->name }}</p>
            <p>---PRODUCT PRICE : {{ $orderLine->product->price }}</p>
            <p>---QUANTITY : {{ $orderLine->quantity }}</p>
            <p>------------------------------------------------</p>
        @empty
            <p>NO PRODUCT IN THIS ORDER</p>
        @endforelse
    @empty
        <p>NO ORDER</p>
    @endforelse
</x-app-layout>
