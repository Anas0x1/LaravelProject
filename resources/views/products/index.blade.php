@extends('products.layout')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h2 class="fw-bold mb-0 text-dark">Product Management</h2>
    <a class="btn btn-primary px-4 shadow-sm" href="{{ route('products.create') }}" role="button">
        <i class="bi bi-plus-lg"></i> Add New Product
    </a>
</div>

<!-- Success Alert -->
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Product Table Card -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th class="text-end pe-4" style="width: 220px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                    <tr>
                        <!-- Pagination-aware numbering -->
                        <td class="ps-4 fw-bold text-muted">{{ $i + $loop->iteration }}</td>
                        
                        <!-- Image with fallback -->
                        <td>
                            @if($item->image)
                                <img src="{{ asset('images/' . $item->image) }}" 
                                     class="img-thumbnail rounded" 
                                     style="width: 60px; height: 60px; object-fit: cover;" 
                                     alt="{{ $item->name }}">
                            @else
                                <span class="badge bg-secondary">No Image</span>
                            @endif
                        </td>
                        
                        <td class="fw-semibold">{{ $item->name }}</td>
                        
                        <!-- Limit text length to keep table clean -->
                        <td class="text-muted">{{ Str::limit($item->details, 50) }}</td>
                        
                        <td class="text-end pe-4">
                            <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-flex justify-content-end gap-2 m-0">
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('products.show', $item->id) }}">Show</a>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('products.edit', $item->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <!-- Empty State -->
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <h5 class="mb-2">No products found</h5>
                            <p class="mb-0">Click "Add New Product" to create your first entry.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-end mt-4">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

@endsection