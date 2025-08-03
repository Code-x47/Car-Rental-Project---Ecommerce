<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoStar Car Rental Services</title>
    <link rel="stylesheet" href="{{asset('asset/css/index.css')}}">
    <style>
        
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">🚗 AutoStar Car Rental</div>
                <div class="cart-info">
                    <a href="{{ route('login') }}" class="cart-button">
                        🛒 View Cart
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <h1 class="page-title">Welcome To AutoStar Car Rental Services</h1>
            
            <div class="filters">
                <form method="GET" action="{{ url()->current() }}" style="display: flex; gap: 20px; flex-wrap: wrap; width: 100%;">
                    <div class="filter-item">
                        <label for="price_range">Price Range</label>
                        <select name="price_range" id="price_range" onchange="this.form.submit()">
                            <option value="">All Prices</option>
                            <option value="0-100" {{ request('price_range') == '0-100' ? 'selected' : '' }}>$0 - $100</option>
                            <option value="100-200" {{ request('price_range') == '100-200' ? 'selected' : '' }}>$100 - $200</option>
                            <option value="200+" {{ request('price_range') == '200+' ? 'selected' : '' }}>$200+</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="model">Year</label>
                        <select name="model" id="model" onchange="this.form.submit()">
                            <option value="">All Years</option>
                            <option value="2024" {{ request('model') == '2024' ? 'selected' : '' }}>2024</option>
                            <option value="2023" {{ request('model') == '2023' ? 'selected' : '' }}>2023</option>
                            <option value="2022" {{ request('model') == '2022' ? 'selected' : '' }}>2022</option>
                        </select>
                    </div>
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
                        
                        <!-- Static discount badges based on price ranges -->
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
                        
                        <!-- Static features based on car type/price -->
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
                        
                        <!-- Static discount information -->
                        @if($car['price'] >= 200)
                            <div class="discount-info">
                                💡 Weekend Special - Premium cars with luxury package included!
                            </div>
                        @elseif($car['price'] >= 150)
                            <div class="discount-info">
                                💡 Limited time offer - 20% off for new customers!
                            </div>
                        @else
                            <div class="discount-info">
                                💡 Budget friendly - Great value for money!
                            </div>
                        @endif
                        
                        <div class="pricing">
                            <div class="price-container">
                                 <span class="original-price">${{ number_format($car['price'], 2) }}</span>
                                 <span class="current-price">${{ number_format($car['price'] * 0.85, 2) }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('register') }}" class="add-to-cart">🚗 Add to Cart</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
</body>
</html>