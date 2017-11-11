<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    //
    public function index()
    {
        return Client::all();
    }
 
    public function show($id)
    {
        return Client::find($id);
    }

    public function store(Request $request)
    {
        return Client::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = Client::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Client::findOrFail($id);
        $article->delete();

        return 204;
    }
}
