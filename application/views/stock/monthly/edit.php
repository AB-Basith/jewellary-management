<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Stock Item</h1>
    <a href="<?php echo base_url('stockmonthly'); ?>" class="btn btn-secondary btn-custom">
        <i class="fas fa-arrow-left"></i> Back to Stock
    </a>
</div>

<div class="row">
    <!-- Stock Edit Form -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Update Product Information</h6>
            </div>
            <div class="card-body">
                <?php echo form_open('stockmonthly/edit/'.$stock['id'], ['class' => 'needs-validation', 'novalidate' => '']); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ornaments">Ornaments <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ornaments" name="ornaments"
                                value="<?php echo set_value('ornaments', $stock['ornaments']); ?>"
                                placeholder="Enter Ornaments" required>
                            <div class="invalid-feedback">
                                Please provide a Ornaments.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity">No of Pieces<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="quantity" name="quantity" 
                                value="<?php echo set_value('quantity', $stock['quantity']); ?>"
                                placeholder="Enter quantity" required>
                            <div class="invalid-feedback">
                                Please provide a quantity.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gram_wt">Gram Weight <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="gram_wt" name="gram_wt" 
                                value="<?php echo set_value('gram_wt', $stock['gram_wt']); ?>"
                                placeholder="Enter Gram Weight" min="0" required>
                            <div class="invalid-feedback">
                                Please provide a valid gram.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="dealer">Dealer</label>
                                <input type="text" class="form-control" id="dealer" name="dealer" 
                                    value="<?php echo set_value('dealer', $stock['dealer']); ?>"
                                    placeholder="Enter dealer name">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="metal_type">Metal Type <span class="text-danger">*</span></label>
                            
                            <div class="custom-control custom-radio">
                                <input type="radio" id="old" name="metal_type" value="Old" 
                                    class="custom-control-input" required
                                    <?php echo ($stock['metal_type'] == 'Old') ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="old">Old Gold</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="new" name="metal_type" value="New" 
                                    class="custom-control-input" required
                                    <?php echo ($stock['metal_type'] == 'New') ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="new">New Gold</label>
                            </div>

                            <div class="invalid-feedback">
                                Please select a metal type.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calculated Total Value -->
                <?php
                    $gram = $stock['gram'];
                    $rate = $stock['gram_rate'];
                    $wastagePercent = $stock['wastage_percent'] ?? 0; // if available

                    $wastageGram = ($gram * $wastagePercent) / 100;
                    $totalGram   = $gram + $wastageGram;
                    $totalValue  = $totalGram * $rate;
                ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Calculated Total Value</h6>
                                    <p class="card-text">
                                        <span class="h4 text-primary" id="totalValue">
                                            ₹<?php echo number_format($totalValue, 2); ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Calculated Total Weight</h6>
                                    <p class="card-text">
                                        <span class="h4 text-primary" id="totalValue">
                                            ₹<?php echo number_format($totalValue, 2); ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-custom">
                        <i class="fas fa-save"></i> Update Stock Item
                    </button>
                    <a href="<?php echo base_url('stock'); ?>" class="btn btn-secondary btn-custom ml-2">
                        Cancel
                    </a>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Tips -->
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
                        <small class="ml-2">Low stock alerts trigger at gram ≤ 10</small>
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-calculator text-success"></i>
                        <small class="ml-2">Total value updates automatically</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Bootstrap validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function(form) {
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
