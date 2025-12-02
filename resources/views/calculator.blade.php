<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>
<h1>Calculator</h1>
<h2>First Number :</h2>
<form action="{{ route('calculator.calculate') }}" method="POST">
    @csrf
    <input type="number" name="num1" required><br><br>

    <h2>Second Number :</h2>
    <input type="number" name="num2" required><br><br>

    <button type="submit" name="operation" value="add">Add</button>
    <button type="submit" name="operation" value="subtract">Subtract</button>
    <button type="submit" name="operation" value="multiply">Multiply</button>
    <button type="submit" name="operation" value="divide">Divide</button>
</form>

@if(isset($result))
    <h1>Total: {{ $result }}</h1>
@endif

<a href="http://127.0.0.1:8000/products">CRUD App</a>
<br></br>
<a href="http://127.0.0.1:8000">Homepage</a>
</body>
</html>
