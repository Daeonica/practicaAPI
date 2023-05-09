<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SpoonacularController extends Controller
{
    public function searchRecipes(Request $request)
    {
        $client = new Client([
            'base_uri' => 'https://api.spoonacular.com/',
        ]);

        $response = $client->request('GET', 'recipes/complexSearch', [
            'query' => [
                'apiKey' => env('SPOONACULAR_API_KEY'),
                'query' => $request->input('query')
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        $results = $data['results'];

        return view('spoonacular.search', compact('results'));
    }


    public function getRandomRecipe()
    {
        $client = new Client([
            'base_uri' => 'https://api.spoonacular.com/',
        ]);
    
        $response = $client->request('GET', 'recipes/random', [
            'query' => [
                'apiKey' => env('SPOONACULAR_API_KEY'),
            ]
        ]);
    
        $recipe = json_decode($response->getBody(), true)['recipes'][0];
    
        return view('spoonacular.recipe', compact('recipe'));
    }
    

    public function getRecipe($id)
    {
        $client = new Client([
            'base_uri' => 'https://api.spoonacular.com/',
        ]);

        $response = $client->request('GET', 'recipes/' . $id . '/information', [
            'query' => [
                'apiKey' => env('SPOONACULAR_API_KEY'),
                'includeNutrition' => true
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        $recipe = $data;

        return view('spoonacular.recipe', compact('recipe'));
    }


    public function index()
    {
        return view('spoonacular.index');
    }
}
