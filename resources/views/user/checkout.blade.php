<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Responsive Checkout Page</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      margin: 0;
      padding: 0;
    }

    .checkout-container {
      max-width: 1100px;
      margin: 2rem auto;
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }

    h2 {
      text-align: center;
      margin-bottom: 2rem;
      color: #222;
    }

    .form-section {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
    }

    .billing, .summary {
      flex: 1;
      min-width: 280px;
    }

    label {
      display: block;
      margin-top: 1rem;
      margin-bottom: 0.4rem;
      font-weight: 600;
      color: #333;
    }

    input, select {
      width: 100%;
      padding: 0.8rem;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 15px;
    }

    .summary-box {
      background: #fafafa;
      padding: 1.2rem;
      border-radius: 8px;
      border: 1px solid #ddd;
    }

    .summary-box h3 {
      margin-top: 0;
      color: #444;
    }

    .summary-item {
      display: flex;
      justify-content: space-between;
      margin: 0.6rem 0;
      font-size: 15px;
    }

    .total {
      font-weight: bold;
      font-size: 18px;
      border-top: 1px solid #ccc;
      padding-top: 1rem;
      margin-top: 1rem;
    }

    .buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-top: 2rem;
    }

    .pay-btn {
      flex: 1;
      padding: 1rem;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      color: white;
      transition: background-color 0.3s ease;
    }

    .pay-delivery {
      background-color: #16a34a;
    }

    .pay-delivery:hover {
      background-color: #15803d;
    }

    .pay-card {
      background-color: #4f46e5;
    }

    .pay-card:hover {
      background-color: #3730a3;
    }

    @media (max-width: 768px) {
      .form-section {
        flex-direction: column;
      }

      .buttons {
        flex-direction: column;
      }
    }

    



  </style>
</head>
<body>

  <div class="checkout-container">
    <h2>Checkout</h2>

    <a href="{{ route('dashboard') }}" class="pay-btn" style="background-color:#6b7280;">
      ← Back to Dashboard
     </a>


    <form action="{{route('order.checkout')}}" method="POST">
      @csrf
      <div class="form-section">

        <!-- Billing Section -->
        <div class="billing">
          <h3>Billing Details</h3>
            
            @if(session('success'))
            <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
            </div>
          @endif

          
          <input type="hidden" id="total" name="grandTotal" value="{{$grandTotal}}">

          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>

          <label for="address">Address</label>
          <input type="text" id="address" name="address" required>

          <label for="phone">Phone Number</label>
          <input type="text" id="phone" name="phone" required>
        </div>

        <!-- Summary Section -->
        <div class="summary">
          <h3>Order Summary</h3>
           
          <div class="summary-box">
            @foreach($cars AS $car)
            <div class="summary-item">
              <span>{{$car['car_name']}}</span>
              <span>{{$car['price']}}</span>
            </div>
            @endforeach
            <div class="summary-item total">
              <span>Total</span>
              <span>₦{{$grandTotal}}</span>

            </div>
          </div>
       
      

      <!-- Payment Buttons -->
      <div class="buttons">
<button class="pay-btn pay-delivery" type="submit" name="payment" value="delivery">
          Pay After Inspection
        </button>
        <button class="pay-btn pay-card" type="submit" name="payment" value="card">
          Pay Using Card
        </button>
      </div>
    </form>
  </div>

</body>
</html>
