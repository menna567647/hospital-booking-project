<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\Requests\Admin\ClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    public function _construct()
    {
        $this->middleware('can:read clients')->only(['index']);
        $this->middleware('can:update clients')->only(['edit', 'update']);
        $this->middleware('can:delete clients')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::query()
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->paginate(10)
            ->appends($request->query());

        $totalclients = $clients->total();

        return view('admin.client.index', compact(
            'clients',
            'totalclients'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, string $id)
    {
        $client = Client::findOrFail($id);
        $validated = $request->validated();
        $client->update($validated);
        return redirect()->route('admin.clients.index')->with("admin_message",  __("language.UPDATEDSUCCESSFULLY"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destory(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('admin.clients.index')->with("admin_message",  __("language.DELETEDSUCCESSFULLY"));
    }
}
