<!DOCTYPE html>
<html>
<head>
    <title>{$car.name}</title>
</head>
<body>
    <h1>{$car.name}</h1>
    <p>Model: {$car.model}</p>
    <p>Price: ₦{$car.price}</p>
    <p>Description: {$car.description}</p>

    <a href="{{ Route('add.cart', $car->id) }}" class="btn">Add to Cart</a>
</body>
</html>
