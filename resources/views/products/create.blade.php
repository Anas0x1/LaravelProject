@extends('products.layout')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h2 class="fw-bold mb-0 text-dark">Add New Product</h2>
    <a class="btn btn-outline-secondary px-4 shadow-sm" href="{{ route('products.index') }}">
        &larr; Back to List
    </a>
</div>

<!-- Form Card -->
<div class="card shadow-sm border-0 mb-5">
    <div class="card-body p-4">
        
        <!-- Validation Errors Summary (Optional but helpful) -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8 mx-auto"> <!-- Centers the form on large screens -->

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Enter product name" 
                               value="{{ old('name') }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Details Field -->
                    <div class="mb-3">
                        <label for="details" class="form-label fw-semibold">Product Details <span class="text-danger">*</span></label>
                        <textarea name="details" 
                                  id="details" 
                                  class="form-control @error('details') is-invalid @enderror" 
                                  rows="4" 
                                  placeholder="Enter product description..." 
                                  required>{{ old('details') }}</textarea>
                        @error('details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div class="mb-4">
                        <label for="image" class="form-label fw-semibold">Product Image <span class="text-danger">*</span></label>
                        <input type="file" 
                               name="image" 
                               id="image" 
                               class="form-control @error('image') is-invalid @enderror" 
                               accept="image/*" 
                               required>
                        <div class="form-text text-muted mt-1">Allowed formats: jpeg, png, jpg, gif, svg. Max size: 2MB.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2 border-top pt-4 mt-2">
                        <a href="{{ route('products.index') }}" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Product</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection