<x-app-layout>
    @include('components.modals.status')
    @include('components.modals.errors')

    @forelse ($cartOrders as $order)
        <p>ORDER ID : {{ $order->id }}</p>
        @forelse ($order->orderLines as $orderLine)
            <p>------------------------------------------------</p>
            <p>---PRODUCT ID : {{ $orderLine->product->id }}</p>
            <p>---PRODUCT NAME : {{ $orderLine->product->name }}</p>
            <p>---PRODUCT PRICE : {{ $orderLine->product->price }}</p>
            <p>---QUANTITY : {{ $orderLine->quantity }}</p>

            <div class="flex items-center gap-2 mt-1">
                {{-- Increment button --}}
                <form method="POST"
                    action="{{ route('homepage.customer.add-to-cart', ['product' => $orderLine->product->id]) }}">
                    @csrf
                    <button type="submit"
                        class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600">+</button>
                </form>

                {{-- Decrement button --}}
                <form method="POST"
                    action="{{ route('homepage.customer.remove-from-cart', ['order' => $order->id, 'product' => $orderLine->product->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">-</button>
                </form>
            </div>

            <p>------------------------------------------------</p>
        @empty
            <p>NO PRODUCT IN THIS ORDER</p>
        @endforelse
    @empty
        <p>NO ORDER</p>
    @endforelse
</x-app-layout>
