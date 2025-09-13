<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Stock Item</h1>
    <a href="<?php echo base_url('stock'); ?>" class="btn btn-secondary btn-custom">
        <i class="fas fa-arrow-left"></i> Back to Stock
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Product Information</h6>
            </div>
            <div class="card-body">
                <?php echo form_open('stock/add', array('class' => 'needs-validation', 'novalidate' => '')); ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_name">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="product_name" name="product_name" 
                                   placeholder="Enter product name" required>
                            <div class="invalid-feedback">
                                Please provide a product name.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ornaments">Ornaments <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ornaments" name="ornaments" 
                                   placeholder="Enter Ornaments" required>
                            <div class="invalid-feedback">
                                Please provide a Ornaments.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gram">Gram <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="gram" name="gram" 
                                   placeholder="Enter gram" min="0" required>
                            <div class="invalid-feedback">
                                Please provide a valid gram.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="wastage_percent">Wastage Percentage (%) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="wastage_percent" name="wastage_percent" 
                                   placeholder="0.00" step="0.01" min="0" required>
                            <div class="invalid-feedback">
                                Please provide a valid Wastage Percentage.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gram_rate">Gram Rate ($) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="gram_rate" name="gram_rate" 
                                   placeholder="0.00" step="0.01" min="0" required>
                            <div class="invalid-feedback">
                                Please provide a valid Gram Rate.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <input type="text" class="form-control" id="supplier" name="supplier" 
                           placeholder="Enter supplier name">
                </div>
                
                <div class="form-group">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Calculated Total Value</h6>
                            <p class="card-text">
                                <span class="h4 text-primary" id="totalValue">$0.00</span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-custom">
                        <i class="fas fa-save"></i> Save Stock Item
                    </button>
                    <a href="<?php echo base_url('stock'); ?>" class="btn btn-secondary btn-custom ml-2">
                        Cancel
                    </a>
                </div>
                
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Quick Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-lightbulb text-warning"></i>
                        <small class="ml-2">Use descriptive product names for easy identification</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-tags text-info"></i>
                        <small class="ml-2">Choose the most appropriate ornaments</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                        <small class="ml-2">Items with gram ≤ 10 will show low stock warnings</small>
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-calculator text-success"></i>
                        <small class="ml-2">Total value is automatically calculated</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Calculate total value
function calculateTotal() {
    const gram = parseFloat(document.getElementById('gram').value) || 0;
    const unitPrice = parseFloat(document.getElementById('gram_rate').value) || 0;
    const WastagePercent = parseFloat(document.getElementById('wastage_percent').value) || 0;

    const wastageGram = (gram * WastagePercent) / 100;
    const totalGram = gram + wastageGram;
    const total = totalGram * unitPrice;
    // const total = gram * unitPrice;

    document.getElementById('totalValue').textContent = '$' + total.toFixed(2);
}

document.getElementById('gram').addEventListener('input', calculateTotal);
document.getElementById('gram_rate').addEventListener('input', calculateTotal);
document.getElementById('wastage_percent').addEventListener('input', calculateTotal);
</script>