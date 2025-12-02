<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index()
    {
        return view('pokemon');
    }

public function search(Request $request)
{
    $pokemonName = strtolower($request->input('pokemon'));

    $cacheKey = 'pokemon_' . $pokemonName;

    $pokemon = cache()->remember($cacheKey, now()->addHours(24), function () use ($pokemonName) {

        // First API: pokemon data
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$pokemonName}");

        if ($response->failed()) {
            return null;
        }

        $data = $response->json();

        // Second API: species data
        $speciesResponse = Http::get($data['species']['url']);
        $speciesData = $speciesResponse->ok() ? $speciesResponse->json() : null;

        return [
            'name' => ucfirst($data['name']),
            'image' => $data['sprites']['front_default'],
            'imageShiny' => $data['sprites']['front_shiny'],
            'height' => $data['height'],
            'weight' => $data['weight'],

            'types' => array_map(function ($item) {
                return $item['type']['name'];
            }, $data['types']),

            // Stats
            'stats' => array_map(function ($item) {
                return [
                    'name' => $item['stat']['name'],
                    'value' => $item['base_stat']
                ];
            }, $data['stats']),

            // Abilities
            'abilities' => array_map(function ($item) {
                return $item['ability']['name'];
            }, $data['abilities']),

            // Species info: flavor text, habitat, color
            'species' => [
                'habitat' => $speciesData['habitat']['name'] ?? 'Unknown',
                'color' => $speciesData['color']['name'] ?? 'Unknown',
                'flavor' => $speciesData['flavor_text_entries'][0]['flavor_text'] ?? ''
            ]
        ];
    });

    if (!$pokemon) {
        return view('pokemon', ['error' => 'Pokémon not found!']);
    }

    return view('pokemon', compact('pokemon'));
}

}