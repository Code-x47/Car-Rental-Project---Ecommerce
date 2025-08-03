<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HOME') }}
        </h2>
    </x-slot>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoStar Car Rental Services</title>
    <style>
      
    </style>
    <link rel="stylesheet" href="{{asset('asset/css/dashboard.css')}}">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">🚗 AutoStar Car Rental</div>
                <div class="cart-info">
                    <a href="{{route('view.cart')}}" class="cart-button">🛒 View Cart</a>

                  @if(auth()->check() && auth()->user()->role === 'admin')
                   <a href="{{ route('admin.dashboard') }}" class="admin-dashboard-link" style="margin-left: 20px; color: #fff; background: #4f46e5; padding: 10px 15px; border-radius: 5px; text-decoration: none;">
                   🛠 Admin Dashboard
                   </a>
                   @endif

                </div>
            </div>
        </div>
    </header>

    <main class="main-content">

        <div class="container">
           
        

            @if(session('success'))
            <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
            </div>
             @endif

            <h1 class="page-title">Welcome To AutoStar Car Rental Services</h1>

            <div class="filters">
               <form method="GET" action="{{ route('cars.search') }}" style="display: flex; gap: 20px; flex-wrap: wrap; width: 100%;">
    <div class="filter-item">
        <label for="price_range">Price Range</label>
        <select name="price_range" id="price_range">
            <option value="">All Prices</option>
            <option value="0-100000" {{ request('price_range') == '0-100000' ? 'selected' : '' }}>N0 - N100000</option>
            <option value="100000-200000" {{ request('price_range') == '100000-200000' ? 'selected' : '' }}>N100000 - N200000</option>
            <option value="200000+" {{ request('price_range') == '200000+' ? 'selected' : '' }}>N200000+</option>
        </select>
    </div>

    <div class="filter-item">
        <label for="model">Year</label>
        <select name="model" id="model">
            <option value="">All Years</option>
            <option value="2024" {{ request('model') == '2024' ? 'selected' : '' }}>2024</option>
            <option value="2023" {{ request('model') == '2023' ? 'selected' : '' }}>2023</option>
            <option value="2022" {{ request('model') == '2022' ? 'selected' : '' }}>2022</option>
        </select>
 </div>

    <button type="submit">Search</button>
</form>

            </div>

            <div class="cars-grid">
                @foreach ($cars as $car)
                    <div class="car-card" data-price="{{ $car['price'] }}">
                        <div class="car-image">
                            @if(isset($car['file']) && $car['file'])
                                <img src="{{ asset('cars/' . $car['file']) }}" alt="{{ $car['name'] }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=500&h=300&fit=crop" alt="{{ $car['name'] }}">
                            @endif

                            @if($car['price'] >= 200)
                                <div class="discount-badge">15% OFF</div>
                                @if($car['price'] >= 250)
                                    <div class="premium-badge">⭐ PREMIUM</div>
                                @endif
                            @elseif($car['price'] >= 150)
                                <div class="discount-badge">20% OFF</div>
                            @elseif($car['price'] >= 100)
                                <div class="discount-badge">25% OFF</div>
                            @endif
                        </div>

                        <div class="car-content">
                            <h3 class="car-name">{{ $car['name'] }}</h3>
                            <div class="car-details">
                                <span class="car-model">{{ $car['model'] }}</span>
                                <span>Per Day</span>
                            </div>

                            <div class="car-features">
                                <span class="feature">GPS</span>
                                <span class="feature">AC</span>
                                @if($car['price'] >= 200)
                                    <span class="feature">Leather Seats</span>
                                    <span class="feature">Premium Sound</span>
                                @endif
                                @if($car['price'] >= 150)
                                    <span class="feature">Bluetooth</span>
                                    <span class="feature">Automatic</span>
                                @endif
                                @if($car['model'] >= 2024)
                                    <span class="feature">Latest Model</span>
                                @endif
                            </div>

                            <div class="discount-info">
                                @if($car['price'] >= 200)
                                    💡 Weekend Special - Premium cars with luxury package included!
                                @elseif($car['price'] >= 150)
                                    💡 Limited time offer - 20% off for new customers!
                                @else
                                    💡 Budget friendly - Great value for money!
                                @endif
                            </div>

                            <div class="pricing">
                                <div class="price-container">
                                   
                        @if (empty($car['discount']) || $car['discount'] === 0.00)
                                    <span class="original-price">N{{ number_format($car['price'], 2) }}</span>
                                 @else
                                      @php
                                      $discountedPrice =
                                       $car['price'] * (1 - ($car['discount'] / 100));
                                      @endphp
                                     <span class="original-price line-through text-gray-500">N{{ number_format($car['price'], 2) }}</span>
                                     <span class="current-price text-red-600 font-bold">N{{ number_format($discountedPrice, 2) }}</span>
   
                        @endif 



                                </div>
                            </div>
                            <a href="{{route('car.detail',$car->id)}}" class="add-to-cart">Details</a>

                            <form action="{{ Route('add.cart', $car->id) }}" method="POST" style="margin-top: 10px;">
                                @csrf
                               

                                <div style="margin-bottom: 10px;">
                                    <label for="quantity_{{ $car['id'] ?? $loop->index }}" style="font-weight: 600; font-size: 0.9rem;">Units</label>
                                    <input
                                        type="number"
                                        name="units"
                                        id="quantity_{{ $car['id'] ?? $loop->index }}"
                                        min="1"
                                        value="1"
                                        required
                                        style="width: 100%; padding: 10px; font-size: 0.9rem; border: 1px solid #ccc; border-radius: 8px;">
                                </div>

                                <button type="submit" class="add-to-cart">
                                    🚗 Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</body>
</html>
</x-app-layout>
