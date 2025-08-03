<!DOCTYPE html>
<html>
<head>
    <title>{$car.name}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{$css_url}">
    <style>
        /* Reset and base styles */
        
    </style>
</head>
<body>

    <div class="container">
        <img src="{$cars_url}" alt="{$car.name}" class="car-image">

        <h1>{$car.name}</h1>
        <p><strong>Model:</strong> {$car.model}</p>
        <p><strong>Price:</strong> ₦{$car.price}</p>
        <p><strong>Description:</strong> {$car.description}</p>

        <div class="button-group">
            <form method="POST" action="{$addCart_url}" style="display:inline;">
                  <label for="units">Quantity:</label>
                  <input type="number" id="units" name="units" min="1" value="1" required class="qty-input">
                  <input type="hidden" name="_token" value="{$csrf_token}">
                  <button type="submit" class="btn">Add to Cart</button>
            </form>

            <a href="{$home_url}" class="btn" style="background-color: #28a745;">Back to Home</a>
        </div>
    </div>

</body>
</html>
