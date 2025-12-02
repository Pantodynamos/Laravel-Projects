<!DOCTYPE html>
<html>
<head>
    <title>Pokémon Search</title>
</head>
<body>
    <h1>Pokémon Search</h1>

    <form action="{{ route('pokemon.search') }}" method="POST">
        @csrf
        <input type="text" name="pokemon" placeholder="Enter Pokémon name" required>
        <button type="submit">Search</button>
    </form>

    <br>

    @isset($error)
        <h3 style="color:red;">{{ $error }}</h3>
    @endisset

    @isset($pokemon)
        <h2>{{ $pokemon['name'] }}</h2>

        <img src="{{ $pokemon['image'] }}" alt="Pokemon Image">

        <img src="{{ $pokemon['imageShiny'] }}" alt="Pokemon Image Shiny">

        <p><strong>Height:</strong> {{ $pokemon['height'] }}</p>

        <p><strong>Weight:</strong> {{ $pokemon['weight'] }}</p>

        <h3>Stats</h3>
        <ul>
        @foreach ($pokemon['stats'] as $stat)
            <li>{{ ucfirst($stat['name']) }}: {{ $stat['value'] }}</li>
        @endforeach
        </ul>

           <h3>Abilities</h3>
        <ul>
        @foreach ($pokemon['abilities'] as $ability)
            <li>{{ ucfirst($ability) }}</li>
        @endforeach
        </ul>

        <h3>Species Info</h3>
        <p><strong>Habitat:</strong> {{ ucfirst($pokemon['species']['habitat']) }}</p>
        <p><strong>Color:</strong> {{ ucfirst($pokemon['species']['color']) }}</p>
        <p><strong>Description:</strong> {{ $pokemon['species']['flavor'] }}</p>
        <p><strong>Types:</strong>
            @foreach ($pokemon['types'] as $type)
                {{ ucfirst($type) }}
            @endforeach
        </p>
    @endisset
<footer>
    <a href="http://127.0.0.1:8000">Back to Home</a>
</footer>
</body>
</html>
