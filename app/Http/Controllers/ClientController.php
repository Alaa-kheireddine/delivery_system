<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct(private ClientService $service)
    {}

    public function index(Request $request)
    {
        $rules = [
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:active,inactive'],
        ];

        if (Auth::user()->role->name === 'admin') {
            $rules['branch_name'] = ['nullable', 'string', 'exists:branches,name'];
        }

        $validated = $request->validate($rules);
        
        $data = $this->service->getIndexData($validated);

        return view('clients.index', $data);
    }

    public function show(Client $client)
    {

        $client->load(['branch']);

        $total_shipments_count = $client->shipments()->count();

        $pending_shipments_count = $client->shipments()
                                        ->where('status', 'pending')
                                        ->count();

        $delivered_shipments_count = $client->shipments()
                                        ->where('status', 'delivered')
                                        ->count();
        $cancelled_shipments_count = $client->shipments()
                                        ->where('status', 'cancelled')
                                        ->count();

        $recent_shipments = $client->shipments()
                                ->latest()
                                ->take(5)
                                ->get();

        $recent_payments = $client->payments()
                                ->latest()
                                ->take(5)
                                ->get();


        return view('clients.show', compact('client',
                            'total_shipments_count',
                            'pending_shipments_count',
                            'delivered_shipments_count',
                            'cancelled_shipments_count',
                            'recent_shipments',
                            'recent_payments'));
    }

    public function edit(Client $client)
    {
        $branches = Branch::orderBy('id')->get();

        return view('clients.edit', compact('client', 'branches'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'default_delivery_fee' => ['required', 'numeric', 'min:0'],
            'contact_person_name' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:100'],
            'phone' => ['nullable', 'string', 'max:100', 'min:8'],
            'city' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:100'],
            'branch_id' => ['required', 'exists:branches,id'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $client->update($validated);

        return redirect()
                ->route('clients.show', $client)
                ->with('success', 'Client updated successfully.');

    }

}