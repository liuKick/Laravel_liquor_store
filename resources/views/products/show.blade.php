<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }} - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        .info-badge {
            font-size: 1rem;
            padding: 0.5em 0.75em;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card detail-card mb-4">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="h4 mb-0">
                                <i class="bi bi-box-seam"></i> {{ $product->name }}
                            </h2>
                            <div>
                                <span class="badge bg-success info-badge">${{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-primary mb-4">Product Details</h4>
                                
                                <div class="mb-4">
                                    <h5 class="d-inline-block border-bottom border-primary pb-1">Description</h5>
                                    <p class="mt-3">{{ $product->description ?? 'No description available' }}</p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h5 class="d-inline-block border-bottom border-primary pb-1">Stock</h5>
                                        <div class="mt-3">
                                            <span class="badge bg-{{ $product->stock > 0 ? 'info' : 'warning' }} info-badge">
                                                {{ $product->stock }} units available
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <h5 class="d-inline-block border-bottom border-primary pb-1">Category</h5>
                                        <div class="mt-3">
                                            <span class="badge bg-secondary info-badge">
                                                {{ $product->category }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex mt-4">
                                    <a href="{{ route('products.edit', $product->id) }}" 
                                       class="btn btn-warning me-md-2">
                                        <i class="bi bi-pencil-square"></i> Edit Product
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">
                                Created: {{ $product->created_at->format('M d, Y') }}
                            </small>
                            <small class="text-muted">
                                Last Updated: {{ $product->updated_at->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Back to All Products
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Product details console log
        console.log('Product details:', {
            id: {{ $product->id }},
            name: "{{ $product->name }}",
            stock: {{ $product->stock }}
        });
    </script>
</body>
</html>