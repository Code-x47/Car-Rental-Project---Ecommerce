<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            🛒 Shopping Cart
        </h2>
    </x-slot>

    <div class="cart-wrapper">
        @if(session('added_to_cart'))
            <div class="alert-success">{{ session('added_to_cart') }}</div>
        @endif

        @if(session('removed'))
            <div class="alert-error">{{ session('removed') }}</div>
        @endif


       @if(session('success'))
            <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
            </div>
       @endif

        
         
        <a href="{{ route('dashboard') }}" class="back-btn">← Back to Dashboard</a>

        @if(count($cartItems) > 0)
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Car</th>
                        <th>Model</th>
                        <th>Units</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($cartItems as $item)
                       
                        <tr>
                              <td data-label="Image"><img src="{{ asset('cars/' . $item->file) }}" alt="{{ $item->car_name }}"></td>
                              <td data-label="Car">{{ $item->car_name }}</td>
                              <td data-label="Model">{{ $item->model }}</td>
                              <td data-label="Units">{{ $item->units }}</td>
                              <td data-label="Price">₦{{ number_format($item->price) }}</td>
                              <td data-label="Total">₦{{ number_format($item->price * $item->units) }}</td>
                              <td data-label="Remove">
              <form action="{{route('remove.item',$item->id)}}" method="POST">
                 @csrf
                 @method('DELETE')
                <button class="remove-btn">Remove</button>
             </form>

              @php 
              $total = $item->price * $item->units;
              $grandTotal += $total;
              @endphp

     </td>
                        </tr>
                    @endforeach
                </tbody>
               
                <tfoot>
                    <tr class="total-row">
                        <td colspan="5" class="text-right"><strong>Grand Total:</strong></td>
                        <td colspan="2"><strong>₦{{ number_format($grandTotal) }}</strong></td>
                    </tr>
                </tfoot>
            </table>

            <div class="checkout-area">
                <form action="{{route('user.checkout',$grandTotal)}}" method="Get">
                    
                    <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                </form>
            </div>
        @else
            <p class="empty-cart">🛍️ Your cart is empty.</p>
        @endif
    </div>

</x-app-layout>
