<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class BranchController extends Controller
{
    public function __construct(private BranchService $service)
    {}
    public function index(){

        $this->authorize('viewAny', Branch::class);

        $data = $this->service->getIndexData(Auth::user());

        return view('branches.index' , $data);
    }

    public function show(Branch $branch){
        $this->authorize('view', $branch);

        $data = $this->service->getShowData($branch);

        return view('branches.show', $data);
    }

    public function store(Request $request){

        $this->authorize('create', Branch::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        try {
            $this->service->create($validated);

            return back()->with('success', 'Branch created successfully.');
        } catch (Throwable $e) {
            return back()->with('error', 'Something went wrong while creating the branch.');
        }
    }

    public function update(Request $request, Branch $branch){

        $this->authorize('update', $branch);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        try {
            $this->service->update($branch, $validated);

            return back()->with('success', 'Branch updated successfully.');
        } catch (Throwable $e) {
            return back()->with('error', 'Something went wrong while updating the branch.');
        }

    }

    public function activate(Branch $branch)
    {
        $this->authorize('activate', $branch);
        try {
            $this->service->activate($branch);

            return back()->with('success', 'Branch status updated successfully.');
        } catch (Throwable $e) {
            return back()->with('error', 'Something went wrong while updating the branch status.');
        }
    }

    public function deactivate(Branch $branch)
    {
        $this->authorize('deactivate', $branch);
        try {
            $result = $this->service->deactivate($branch);

            if (! $result) {
                return back()->with('error', 'Cannot deactivate this branch because it has active shipments.');
            }

            return back()->with('success', 'Branch status updated successfully.');
        } catch (Throwable $e) {
            return back()->with('error', 'Something went wrong while updating the branch status.');
        }
    }


}
