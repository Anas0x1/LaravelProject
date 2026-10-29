@extends('products.layout')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h2 class="fw-bold mb-0 text-dark">Edit Product</h2>
    <a class="btn btn-outline-secondary px-4 shadow-sm" href="{{ route('products.index') }}">
        &larr; Back to List
    </a>
</div>

<!-- Form Card -->
<div class="card shadow-sm border-0 mb-5">
    <div class="card-body p-4">
        
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

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Required for update requests -->

            <div class="row">
                <div class="col-md-8 mx-auto">

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Details Field -->
                    <div class="mb-3">
                        <label for="details" class="form-label fw-semibold">Product Details <span class="text-danger">*</span></label>
                        <textarea name="details" id="details" class="form-control @error('details') is-invalid @enderror" 
                                  rows="4" required>{{ old('details', $product->details) }}</textarea>
                        @error('details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div class="mb-4">
                        <label for="image" class="form-label fw-semibold">Product Image</label>
                        
                        <!-- Show current image -->
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('images/' . $product->image) }}" class="img-thumbnail rounded" style="height: 100px; object-fit: cover;">
                            </div>
                        @endif

                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        <div class="form-text text-muted mt-1">Leave blank if you do not want to change the image. Max size: 2MB.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2 border-top pt-4 mt-2">
                        <a href="{{ route('products.index') }}" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Update Product</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection