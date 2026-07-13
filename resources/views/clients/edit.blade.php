@extends('layouts.app')

@section('content')
<!-- Edit Page -->
<div class="card-box p-4 m-2 mt-4">
    <!-- BreadCrumb -->
    @include('components.breadcrumb', [
        'items' => [
            [
                'label' => 'Clients',
                'url' => session('clients_index_url', route('clients.index')),
            ],
            [
                'label' => $client->name,
                'url' => route('clients.show', $client),
            ],
            [
                'label' => 'Edit',
                'active' => true,
            ],
        ]
    ])
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div class="d-flex align-items-center gap-3">

            <div>
                <h4 class="mb-1">{{ $client->name }} ( {{ $client->code }} )</h4>
                <p class="text-muted mb-0">
                    {{ $client->email }}
                </p>
            </div>

        </div>

        <div class="d-flex align-items-center gap-2">

            @if($client->is_active)
                <span class="badge bg-success-subtle text-success border border-success-subtle">
                    Active
                </span>
            @else
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                    Inactive
                </span>
            @endif

        </div>

    </div>

    <!-- Content -->
    <form action="{{ route('clients.update', $client->id) }}" method="POST" class="form form-control mt-5">
        @csrf
        @method('PUT')

        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $client->name }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Default Delivery Fee</label>
                <input type="number" step="0.01" class="form-control" name="default_delivery_fee" value="{{ $client->default_delivery_fee }}" required>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label">Contact Person Name</label>
                <input type="text" name="contact_person_name" class="form-control" value="{{ $client->contact_person_name }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $client->email }}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $client->phone }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" value="{{ $client->city }}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ $client->address }}">
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted small">
                    <i class="bi bi-buildings me-1"></i> Branch
                </label>
                <select name="branch_id" id="editClientBranchId" class="form-select">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}"
                            @selected($client->branch_id === $branch->id)
                        >
                            {{ $branch->name }} - {{ $branch->city }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <textarea name="client_notes"  class="form-control" rows="6">
                    {{ trim($client->notes) }}
                </textarea>
            </div>
        </div>

        <div class="modal-footer mt-3 gap-2">

            <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>

            <button class="btn btn-primary" type="submit">
                Update
            </button>
        </div>

    </form>

</div>
@endsection