<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .debug-section {
            font-size: 0.8rem;
        }
        .debug-toggle:checked ~ .debug-section {
    display: block; /* Show when toggle is checked */
}
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">
                    <i class="bi bi-plus-circle"></i> Create New Product
                </h1>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <h5 class="alert-heading">Please fix these errors:</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        @if(session('product_id'))
                            <br><small>Product ID: {{ session('product_id') }}</small>
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" id="productForm">
                    @csrf
                    
                    <!-- CSRF Token Debug -->
                    @if(app()->environment('local'))
                    <div class="alert alert-info debug-section mb-3 py-1">
                        <small>
                            <i class="bi bi-info-circle"></i> CSRF Token: {{ csrf_token() }}
                            | Route: {{ request()->route()->getName() }}
                        </small>
                    </div>
                    @endif
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name') }}" required maxlength="100">
                        @error('name')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                @if(app()->environment('local'))
                                <small class="d-block mt-1">Rules: required|string|max:100</small>
                                @endif
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" min="0.01" max="9999.99" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" required>
                        </div>
                        @error('price')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                @if(app()->environment('local'))
                                <small class="d-block mt-1">Rules: required|numeric|min:0.01|max:9999.99</small>
                                @endif
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="3" maxlength="500">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                @if(app()->environment('local'))
                                <small class="d-block mt-1">Rules: nullable|string|max:500</small>
                                @endif
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" min="0" max="10000" 
                               class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" name="stock" value="{{ old('stock') }}" required>
                        @error('stock')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                @if(app()->environment('local'))
                                <small class="d-block mt-1">Rules: required|integer|min:0|max:10000</small>
                                @endif
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" name="category" required>
                            <option value="">Select a category</option>
                            <option value="Whiskey" @selected(old('category') == 'Whiskey')>Whiskey</option>
                            <option value="Vodka" @selected(old('category') == 'Vodka')>Vodka</option>
                            <option value="Rum" @selected(old('category') == 'Rum')>Rum</option>
                            <option value="Tequila" @selected(old('category') == 'Tequila')>Tequila</option>
                            <option value="Gin" @selected(old('category') == 'Gin')>Gin</option>
                            <option value="Other" @selected(old('category') == 'Other')>Other</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                @if(app()->environment('local'))
                                <small class="d-block mt-1">Rules: required|string|max:50|in:Whiskey,Vodka,Rum,Tequila,Gin,Other</small>
                                @endif
                            </div>
                        @enderror
                    </div>

                    @if(app()->environment('local'))
                    <div class="card border-info mb-3">
                        <div class="card-header bg-info text-white py-1">
                            <small><i class="bi bi-bug"></i> Debug Console</small>
                        </div>
                        <div class="card-body debug-section p-2">
                            <button type="button" class="btn btn-sm btn-outline-info mb-2" onclick="debugForm()">
                                <i class="bi bi-terminal"></i> Show Form Data
                            </button>
                            <pre id="formDebugOutput" class="bg-dark text-white p-2 rounded"></pre>
                        </div>
                    </div>
                    @endif
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-md-2">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if(app()->environment('local'))
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white py-1">
                <small><i class="bi bi-code-square"></i> Session Debug</small>
            </div>
            <div class="card-body debug-section p-2">
    <h6>Old Input:</h6>
    <pre class="bg-dark text-white p-2 rc
    <h6 class="mt-2">Validation Rules:</h6>
    <pre class="bg-dark text-white p-2 rc
    'name' => 'required|string|max:id
    'price' => 'required|numeric|min:
    'description' => 'nullable|string
    'stock' => 'required|integer|min:
    'category' => 'required|string|main:
    ], JSON_PRETTY_PRINT</pre>
</div>

</div>
@endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('productForm').addEventListener('submit', function(e) {
            const price = parseFloat(document.getElementById('price').value);
            if (price <= 0) {
                e.preventDefault();
                alert('Price must be greater than 0');
            }
        });

        function debugForm() {
            const form = document.getElementById('productForm');
            const data = new FormData(form);
            let output = 'Form Data:\n\n';
            
            for (const [key, value] of data.entries()) {
                output += `${key}: ${value}\n`;
            }
            
            document.getElementById('formDebugOutput').textContent = output;
        }
    </script>
</body>
</html>