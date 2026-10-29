<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Required for $this->authorize()
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    use AuthorizesRequests; // Add this trait to enable $this->authorize()

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only fetch products belonging to the logged-in user
        $products = Product::where('user_id', Auth::id())->latest()->paginate(5);
        return view('products.index', compact('products'))->with('i', (request()->input('page',1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Uses validated data from StoreProductRequest
        $input = $request->validated();
        
        // Attach the logged-in user's ID
        $input['user_id'] = Auth::id();

        if ($image = $request->file('image')) {
            $destinationPath = public_path('images'); 
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        
        Product::create($input);
        return redirect()->route('products.index')->with('success','Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Policy check: Ensures the user owns the product
        $this->authorize('view', $product);
        
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Policy check: Ensures the user owns the product
        $this->authorize('update', $product);
        
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Policy check: Ensures the user owns the product
        $this->authorize('update', $product);

        // Uses validated data from UpdateProductRequest
        $input = $request->validated();
        
        if ($image = $request->file('image')) {
            // Delete the old image if it exists
            $oldImagePath = public_path('images/' . $product->image);
            if (file_exists($oldImagePath) && $product->image) {
                unlink($oldImagePath);
            }

            $destinationPath = public_path('images'); 
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        
        $product->update($input);

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Policy check: Ensures the user owns the product
        $this->authorize('delete', $product);
        
        // Optional: Delete the image file when the product is deleted
        $imagePath = public_path('images/' . $product->image);
        if (file_exists($imagePath) && $product->image) {
            unlink($imagePath);
        }

        $product->delete();
        
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}