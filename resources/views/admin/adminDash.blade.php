<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="{{asset('asset/css/adminDash.css')}}">

</head>
<body>
  <!-- Mobile Header -->
  <div class="mobile-header">
    <h2>Admin</h2>
    <label for="menu-toggle">&#9776;</label>
  </div>

  <input type="checkbox" id="menu-toggle" hidden>

  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <h2>Dashboard</h2>
      <a href="#">🏠 Home</a>
      <a href="{{route('upload.form')}}">📦 Add Products</a>
      <a href="#">🧑 Users</a>
      <a href="#">🚚 Orders</a>
      <a href="#">⚙️ Settings</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
       <button type="submit" class="logout-link">🚪 Logout</button>
     </form>

    </div>

    <!-- Main Content -->
    <div class="main">
      <div class="topbar">
        <h1>Welcome, Admin</h1>
        <div>🔔 Notifications</div>
      </div>

      @if(session('success'))
    <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
     @endif


      <div class="dashboard">
        <div class="card">
          <h3>Total Users</h3>
          <p>{{$user}}</p>
        </div>
        <div class="card">
          <h3>Sales</h3>
          <p>N{{$sales}}</p>
        </div>
        <div class="card">
          <h3>Orders</h3>
          <p>{{$order}}</p>
        </div>
        <div class="card">
          <h3>Pending</h3>
          <p>{{$pending}}</p>
        </div>
      </div>
    
<!--TABLE-->
<div class="table-responsive">
<div class="orders">
  <h2 style="margin: 30px 0 15px;">Manage Orders</h2>
  <div class="table-responsive">
    <table class="order-table">
      <thead>
        <tr>
          <th>User Name</th>
          <th>Car</th>
          <th>Model</th>
          <th>Units</th>
          <th>Price Per Unit</th>
          <th>Total</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders AS $order)
        <tr>
          <td data-label="User ID">{{$order->users->name}}</td>
          <td data-label="Car">{{$order['car_name']}}</td>
          <td data-label="Model">{{$order['model']}}</td>
          <td data-label="Units">{{$order['units']}}</td>
          <td data-label="Price">{{$order['price']}}</td>
          <td data-label="Total">{{$order['total']}}</td>

         

               <td>
                   @if($order->trashed())
                  <span class="badge cancelled">Cancelled</span>
                  @else
                  <span class="badge active">{{$order['status']}}</span>
                  @endif
              </td>


          <td data-label="Actions" class="actions">

          @if($order->trashed())
              <a href="{{ route('order.restore', $order->id) }}" class="btn restore">Restore</a>
          @else
              <a href="#" class="btn view">View</a>
              <a href="{{ route('cancel.order', $order->id) }}" class="btn delete">Cancel</a>
              <a href="{{ route('update.order', $order->id) }}" class="btn edit">Toggle Status</a>
          @endif

          </td>
        </tr>
        @endforeach
       

      </tbody>
    </table>
  </div>
</div>
</div>



  <!--END-->
</div>
</div>

</div>









</body>
</html>
