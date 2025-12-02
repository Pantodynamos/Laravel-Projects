<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h1>Add Product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    
    <label>Name:</label>
    <input type="text" name="name"><br><br>

    <label>Price:</label>
    <input type="number" step="0.01" name="price"><br><br>

    <label>Quantity:</label>
    <input type="number" name="quantity"><br><br>

    <button type="submit">Save</button>
</form>

<br>
<a href="{{ route('products.index') }}">Back</a>

</body>
</html>
