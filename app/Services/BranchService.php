<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BranchService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    // public function getIndexDataOld(User $user): array
    // {
    //     $branches = Branch::query()
    //         ->visibleToUser($user)
    //         ->orderBy('id')
    //         ->get();

    //     return [
    //         'branches' => $branches,
    //         'total_branches' => Branch::count(),
    //         'total_active_branches' => Branch::where('is_active', true)->count(),
    //     ];
    // }

    public function getIndexData(User $user): array
    {
        $branches = Branch::query()
            ->visibleToUser($user)
            ->orderBy('id')
            ->get();

        $branchIds = $branches->pluck('id');

        $shipmentsPerBranch = Branch::query()
            ->whereIn('id', $branchIds)
            ->withCount('shipments')
            ->orderByDesc('shipments_count')
            ->get();

        $statusDistribution = Shipment::query()
            ->whereIn('current_branch_id', $branchIds)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        $chartData = [
            'branch_names' => $shipmentsPerBranch->pluck('name'),
            'branch_shipments' => $shipmentsPerBranch->pluck('shipments_count'),
            'statuses' => $statusDistribution->pluck('status'),
            'status_values' => $statusDistribution->pluck('total'),
        ];

        return [
            'branches' => $branches,
            'total_branches' => Branch::count(),
            'total_active_branches' => Branch::where('is_active', true)->count(),
            'shipmentsPerBranch' => $shipmentsPerBranch,
            'statusDistribution' => $statusDistribution,
            'chartData' => $chartData,
        ];
    }

    public function getShowData(Branch $branch): array
    {
        return [
            'branch' => $branch,

            'total' => $branch->shipments()->count(),
            'active' => $branch->shipments()
                ->whereNotIn('status', ['delivered', 'cancelled', 'returned'])
                ->count(),
            'delivered' => $branch->shipments()
                ->where('status', 'delivered')
                ->count(),
            'pending' => $branch->shipments()
                ->where('status', 'pending')
                ->count(),
            'recentShipments' => $branch->shipments()
                ->latest()
                ->limit(10)
                ->get(),
        ];
    }
    public function create(array $data): Branch
    {
        return Branch::create($data);
    }

    public function update(Branch $branch, array $data): bool
    {
        return $branch->update($data);
    }
    
    public function activate(Branch $branch): bool
    {
        return $branch->update([
            'is_active' => true,
        ]);
    }

    public function deactivate(Branch $branch): bool
    {

        $hasActiveShipments = $branch->shipments()
                            ->whereNotIn('status', [
                                'delivered',
                                'cancelled',
                                'returned',
                            ])
                            ->exists();
        if ($hasActiveShipments) {
            return false;
        }

        return $branch->update([
            'is_active' => false,
        ]);
    }
    
}
