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
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <h5 class="alert-heading">Please fix these errors:</h5>
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?php echo e(session('success')); ?>

                        <?php if(session('product_id')): ?>
                            <br><small>Product ID: <?php echo e(session('product_id')); ?></small>
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('products.store')); ?>" method="POST" id="productForm">
                    <?php echo csrf_field(); ?>
                    
                    <!-- CSRF Token Debug -->
                    <?php if(app()->environment('local')): ?>
                    <div class="alert alert-info debug-section mb-3 py-1">
                        <small>
                            <i class="bi bi-info-circle"></i> CSRF Token: <?php echo e(csrf_token()); ?>

                            | Route: <?php echo e(request()->route()->getName()); ?>

                        </small>
                    </div>
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                            id="name" name="name" value="<?php echo e(old('name')); ?>" required maxlength="100">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?>

                                <?php if(app()->environment('local')): ?>
                                <small class="d-block mt-1">Rules: required|string|max:100</small>
                                <?php endif; ?>
                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" min="0.01" max="9999.99" 
                                   class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="price" name="price" value="<?php echo e(old('price')); ?>" required>
                        </div>
                        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?>

                                <?php if(app()->environment('local')): ?>
                                <small class="d-block mt-1">Rules: required|numeric|min:0.01|max:9999.99</small>
                                <?php endif; ?>
                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="description" name="description" rows="3" maxlength="500"><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?>

                                <?php if(app()->environment('local')): ?>
                                <small class="d-block mt-1">Rules: nullable|string|max:500</small>
                                <?php endif; ?>
                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" min="0" max="10000" 
                               class="form-control <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="stock" name="stock" value="<?php echo e(old('stock')); ?>" required>
                        <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?>

                                <?php if(app()->environment('local')): ?>
                                <small class="d-block mt-1">Rules: required|integer|min:0|max:10000</small>
                                <?php endif; ?>
                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="category" name="category" required>
                            <option value="">Select a category</option>
                            <option value="Whiskey" <?php if(old('category') == 'Whiskey'): echo 'selected'; endif; ?>>Whiskey</option>
                            <option value="Vodka" <?php if(old('category') == 'Vodka'): echo 'selected'; endif; ?>>Vodka</option>
                            <option value="Rum" <?php if(old('category') == 'Rum'): echo 'selected'; endif; ?>>Rum</option>
                            <option value="Tequila" <?php if(old('category') == 'Tequila'): echo 'selected'; endif; ?>>Tequila</option>
                            <option value="Gin" <?php if(old('category') == 'Gin'): echo 'selected'; endif; ?>>Gin</option>
                            <option value="Other" <?php if(old('category') == 'Other'): echo 'selected'; endif; ?>>Other</option>
                        </select>
                        <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?>

                                <?php if(app()->environment('local')): ?>
                                <small class="d-block mt-1">Rules: required|string|max:50|in:Whiskey,Vodka,Rum,Tequila,Gin,Other</small>
                                <?php endif; ?>
                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <?php if(app()->environment('local')): ?>
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
                    <?php endif; ?>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary me-md-2">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php if(app()->environment('local')): ?>
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
<?php endif; ?>
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
</html><?php /**PATH D:\A6 Year3\Web y3\liquorStore\resources\views/products/create.blade.php ENDPATH**/ ?>