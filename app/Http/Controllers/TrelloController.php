<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TrelloController extends Controller
{
    private $apiKey;
    private $apiToken;
    private $boardId;

    public function __construct()
    {
        $this->apiKey = env('TRELLO_API_KEY');
        $this->apiToken = env('TRELLO_API_TOKEN');
        $this->boardId = env('TRELLO_BOARD_ID');
    }
    public function getLists()
    {
        $client = new Client();
        $url = "https://api.trello.com/1/boards/{$this->boardId}/lists?key={$this->apiKey}&token={$this->apiToken}";
        $response = $client->get($url);
        $lists = json_decode($response->getBody(), true);

        return $lists;
    }


    public function getCards()
    {
        $client = new Client();
        $url = "https://api.trello.com/1/boards/{$this->boardId}/cards?key={$this->apiKey}&token={$this->apiToken}";
        $response = $client->get($url);
        $cards = json_decode($response->getBody(), true);

        foreach ($cards as &$card) {
            $members = $client->get("https://api.trello.com/1/cards/{$card['id']}/members?key={$this->apiKey}&token={$this->apiToken}");
            $card['members'] = json_decode($members->getBody(), true);
        }

        return view('trello.index', compact('cards'));
    }

    public function createCardForm()
    {
        $lists = $this->getLists();
        return view('trello.create', compact('lists'));
    }


    public function getCardMembers($cardId)
    {
        $client = new Client();
        $url = "https://api.trello.com/1/cards/{$cardId}/members?key={$this->apiKey}&token={$this->apiToken}";
        $response = $client->get($url);
        $members = json_decode($response->getBody(), true);

        $memberNames = [];
        foreach ($members as $member) {
            $memberNames[] = $member['fullName'];
        }

        return $memberNames;
    }


    // app/Http/Controllers/TrelloController.php
public function updateCard(Request $request, $cardId)
{
    $name = $request->input('name');
    $desc = $request->input('desc');

    $client = new Client();
    $url = "https://api.trello.com/1/cards/{$cardId}?key={$this->apiKey}&token={$this->apiToken}";

    $response = $client->put($url, [
        'form_params' => [
            'name' => $name,
            'desc' => $desc,
        ],
    ]);

    return redirect()->route('trello.cards');
}



    public function createCard(Request $request)
    {
        $client = new Client();
        $url = "https://api.trello.com/1/cards?key={$this->apiKey}&token={$this->apiToken}";

        $data = [
            'name' => $request->input('name'),
            'desc' => $request->input('description'),
            'idList' => $request->input('idList'), // <-- aquí recuperas el ID de la lista
        ];

        // Agregar la fecha límite (due date) si está definida en la solicitud
        if ($request->has('due')) {
            $dueDate = Carbon::parse($request->input('due'))->format('Y-m-d\TH:i:s\Z');
            $data['due'] = $dueDate;
        }

        $client->post($url, [
            'json' => $data
        ]);
        return redirect()->route('trello.cards');
    }
    public function deleteCard($id)
    {
        $client = new Client();
        $url = "https://api.trello.com/1/cards/{$id}?key={$this->apiKey}&token={$this->apiToken}";

        $client->delete($url);

        return redirect()->route('trello.cards')->with('success', 'Card deleted successfully');
    }
    public function editCardForm($cardId)
    {
        $client = new Client();
        $url = "https://api.trello.com/1/cards/{$cardId}?key={$this->apiKey}&token={$this->apiToken}";
    
        $response = $client->get($url);
        $card = json_decode($response->getBody(), true);
    
        return view('trello.edit', compact('card'));
    }
    


}
