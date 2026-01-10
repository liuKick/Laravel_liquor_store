<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Constants for validation rules
    const VALIDATION_RULES = [
        'name' => 'required|string|max:100',
        'price' => 'required|numeric|min:0.01|max:9999.99',
        'description' => 'nullable|string|max:500',
        'stock' => 'required|integer|min:0|max:10000',
        'category' => 'required|string|max:50|in:Whiskey,Vodka,Rum,Tequila,Gin,Other'
    ];

    const VALIDATION_MESSAGES = [
        'price.min' => 'Price must be at least $0.01',
        'category.in' => 'Please select a valid category'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Verify database connection
            DB::connection()->getPdo();
            
            // Debug raw database content
            $rawProducts = DB::table('products')->get();
            Log::debug('Raw DB products:', ['count' => $rawProducts->count()]);
            
            // Main query with pagination
            $products = Product::latest()->paginate(10);
            
            return view('products.index', compact('products'));
            
        } catch (\Exception $e) {
            Log::error('Product fetch failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Failed to load products. Please try again.');
        }
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
    public function store(Request $request)
    {
        try {
            Log::debug('Product Creation - Raw Input:', $request->all());
            
            // Validate request
            $validated = $request->validate(
                self::VALIDATION_RULES,
                self::VALIDATION_MESSAGES
            );

            Log::debug('Product Creation - Validated Data:', $validated);

            // Create product within transaction
            $product = DB::transaction(function () use ($validated) {
                $product = Product::create($validated);
                
                // Verify database insertion
                if (!Product::find($product->id)) {
                    throw new \Exception('Product creation failed - no database record found');
                }
                
                return $product;
            });

            return redirect()->route('products.index')
                ->with([
                    'success' => 'Product created successfully!',
                    'product_id' => $product->id
                ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Product Validation Failed', [
                'errors' => $e->errors(),
                'input' => $request->except('_token')
            ]);
            
            return back()
                ->withErrors($e->validator)
                ->with('error', 'Please fix the errors in the form')
                ->withInput();
            
        } catch (\Exception $e) {
            Log::critical('Product Creation Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->except('_token')
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate(
                self::VALIDATION_RULES,
                self::VALIDATION_MESSAGES
            );
            
            $product->update($validated);
            
            return redirect()->route('products.index')
                ->with('success', 'Product updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Product Update Validation Failed', [
                'errors' => $e->errors(),
                'input' => $request->except('_token')
            ]);
            
            return back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Error updating product:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()
                ->with('error', 'Failed to update product. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            
            return redirect()->route('products.index')
                ->with('success', 'Product deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Error deleting product:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Failed to delete product. Please try again.');
        }
    }
}