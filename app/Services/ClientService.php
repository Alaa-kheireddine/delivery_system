<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getIndexData(array $validated){

        // la no7faz e5er request 3a index page sar (la n7afiz 3ala filters)
        
        session(['clients_index_url' => request()->fullUrl()]);

        $clients = $this->applyFilters($validated);

        $branches = Branch::orderBy('id')
                    ->get();
        
        return [
            'clients' => $clients,
            'branches' => $branches,
        ];
    }


    private function applyFilters(array $validated){
        $query = Client::query()
            ->with(['branch', 'users', 'payments']);

        if (!empty($validated['search'])) {
            $search = $validated['search'];

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "$search%")
                ->orWhere('code', 'like', "$search%");
            });
        }

        if (!empty($validated['branch_name'])) {
            $query->whereHas('branch', function ($q) use ($validated) {
                $q->where('name', $validated['branch_name']);
            });
        }

        if (!empty($validated['status'])) {
            if ($validated['status'] === 'active') {
                $query->where('is_active', true);
            }

            if ($validated['status'] === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $clients = $query
            ->visibleTo(Auth::user())
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return $clients;
    }
}
