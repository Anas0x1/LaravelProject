@extends('products.layout')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h2 class="fw-bold mb-0 text-dark">Product Details</h2>
    <a class="btn btn-outline-secondary px-4 shadow-sm" href="{{ route('products.index') }}">
        &larr; Back to List
    </a>
</div>

<div class="card shadow-sm border-0 mb-5">
    <div class="card-body p-4">
        <div class="row">
            <!-- Image Column -->
            <div class="col-md-4 text-center mb-4 mb-md-0">
                @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: cover;" alt="{{ $product->name }}">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                        <span class="text-muted">No Image Available</span>
                    </div>
                @endif
            </div>

            <!-- Details Column -->
            <div class="col-md-8">
                <h3 class="fw-bold mb-3">{{ $product->name }}</h3>
                
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th style="width: 150px;" class="text-muted">Product ID</th>
                            <td>#{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Added On</th>
                            <td>{{ $product->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Last Updated</th>
                            <td>{{ $product->updated_at->diffForHumans() }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <h6 class="fw-bold text-muted mt-4 mb-2">Description</h6>
                <p class="text-dark" style="white-space: pre-wrap;">{{ $product->details }}</p>

                <div class="d-flex gap-2 mt-4 pt-3 border-top">
                    <a class="btn btn-outline-primary px-4" href="{{ route('products.edit', $product->id) }}">Edit Product</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection