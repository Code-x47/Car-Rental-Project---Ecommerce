<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Upload Portal</title>
    <link rel="stylesheet" href="{{asset('asset/css/uploadcar.css')}}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚗 Upload Cars</h1>
            <p>Add your vehicle details to our inventory</p>
        </div>
        
        <form action="{{route('upload.car')}}" method="POST" enctype="multipart/form-data" class="form-grid">
           @csrf
        
            
            <div class="form-group">
                <label for="name" class="form-label">Car Name</label>
                <input name="name" id="name" type="text" class="form-input" placeholder="e.g., BMW X5" required>
                <span class="input-icon">🏷️</span>
            </div>

            <div class="form-group">
                <label for="model" class="form-label">Model Year</label>
                <input name="model" id="model" type="number" class="form-input" placeholder="e.g., 2024" min="1900" max="2030" required>
                <span class="input-icon">📅</span>
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Price (N)</label>
                <input name="price" type="number" class="form-input"  placeholder="e.g., 45000"  min="0" required>
                <span class="input-icon">💰</span>
            </div>

            <div class="form-group">
                <label for="quantity" class="form-label">Quantity</label>
                <input name="quantity" id="quantity" type="number" class="form-input" placeholder="e.g., 5" min="1" required>
                <span class="input-icon">📊</span>
            </div>

            <div class="form-group full-width">
                <label for="file" class="form-label">Car Images</label>
                <div class="file-input-wrapper">
                    <input name="file" id="file" type="file" class="file-input" multiple>
                    <label for="file" class="file-input-label">
                        <span class="file-icon">📸</span>
                        <span>Click to upload images or drag and drop</span>
                    </label>
                </div>
            </div>

            

            <div class="form-group">
                <label for="discount" class="form-label">Discount (%)</label>
                <input name="discount" id="discount" type="number" class="form-input" placeholder="e.g., 10" min="0" max="100" step="0.01">
                <span class="input-icon">🏷️</span>
            </div>

            <div class="form-group full-width">
                <label for="discount_detail" class="form-label">Discount Details</label>
                <input name="discount_detail" id="discount_detail" type="text" class="form-input" placeholder="e.g., Limited time offer, bulk purchase discount">
                <span class="input-icon">📝</span>
            </div>

            <button type="submit" class="submit-btn">
                Upload Car Details
            </button>
        </form>
    </div>

    <script>
       
    </script>
</body>
</html>