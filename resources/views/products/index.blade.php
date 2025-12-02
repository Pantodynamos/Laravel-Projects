<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Product List</title>
</head>
<body>

<h1>Products</h1>

<form action="{{ route('products.index') }}" method="GET">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product name...">
    <button type="submit">Search</button>

    @if(request('search'))
        <a href="{{ route('products.index') }}">Clear</a>
    @endif
</form>
<br>

<a href="{{ route('products.create') }}">Add New Product</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>
            <a href="{{ route('products.index', ['search' => request('search'), 'sort_by' => 'name', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                Name
            </a>
        </th>
        <th>
            <a href="{{ route('products.index', ['search' => request('search'), 'sort_by' => 'price', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                Price
            </a>
        </th>
        <th>
            <a href="{{ route('products.index', ['search' => request('search'), 'sort_by' => 'quantity', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                Quantity
            </a>
        </th>
        <th>Actions</th>
    </tr>

    @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete product?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach

</table>


<br>
{{ $products->links() }}
<a href="http://127.0.0.1:8000/calculator">Calculator</a>
<br></br>
<a href="http://127.0.0.1:8000">Back to Homepage</a>
</body>
</html>
