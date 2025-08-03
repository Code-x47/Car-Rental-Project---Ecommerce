<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('asset/css/search.css')}}">
    
</head>
<body>

<div class="results-container">
    <h1 class="page-title">Search Results</h1>

    <div class="filter-info">
        @php
            $model = request('model') ? 'Year: ' . request('model') : '';
            $priceRange = request('price_range') ? 'Price Range: ' . request('price_range') : '';
            $filters = trim($model . ' ' . $priceRange);
        @endphp
        {{ $filters ? "Filters applied → $filters" : 'Showing all results' }}
    </div>

    @if($cars->isEmpty())
        <div class="no-results">
            🚫 No cars match your criteria. Try adjusting your filters.
        </div>
    @else
        <div class="cars-grid">
            @foreach($cars as $car)
                <div class="car-card">
                    <img class="car-image" src="{{ $car->file ? asset('cars/' . $car->file) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&h=600&fit=crop' }}" alt="{{ $car->name }}">

                    <div class="car-content">
                        <h3>{{ $car->name }}</h3>
                        <p><strong>Model:</strong> {{ $car->model }}</p>
                        <p><strong>Price:</strong> ₦{{ number_format($car->price, 2) }}</p>

                        {{-- Discount Badges --}}
                        @if($car->price >= 200)
                            <span class="discount-badge">15% OFF</span>
                            @if($car->price >= 250)
                                <span class="premium-badge">⭐ PREMIUM</span>
                            @endif
                        @elseif($car->price >= 150)
                            <span class="discount-badge">20% OFF</span>
                        @elseif($car->price >= 100)
                            <span class="discount-badge">25% OFF</span>
                        @endif

                        <a href="{{ route('car.detail', $car->id) }}">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>
