<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Production</h1>
    <a href="<?php echo base_url('production'); ?>" class="btn btn-secondary btn-custom">
        <i class="fas fa-arrow-left"></i> Back to Production
    </a>
</div>

<div class="row">
    <!-- Production Form -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Production Information</h6>
            </div>
            <div class="card-body">
                <?php echo form_open('production/add', ['class' => 'needs-validation', 'novalidate' => '']); ?>

                <div class="row">
                    <!-- Product -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_id">Product <span class="text-danger">*</span></label>
                            <?php echo form_dropdown(
                                'product_id',
                                ['' => 'Select Product'] + $products,   // from controller
                                '',
                                'class="form-control" id="product_id" required'
                            ); ?>
                            <div class="invalid-feedback">
                                Please select a product.
                            </div>
                        </div>
                    </div>

                    <!-- Production Date -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="production_date">Production Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="production_date" name="production_date"
                                   value="<?php echo date('Y-m-d'); ?>" required>
                            <div class="invalid-feedback">
                                Please provide a production date.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Quantity -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity_produced">Quantity Produced <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="quantity_produced" name="quantity_produced"
                                   placeholder="Enter quantity" min="1" required>
                            <div class="invalid-feedback">
                                Please provide a valid quantity.
                            </div>
                        </div>
                    </div>

                    <!-- Cost -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="production_cost">Production Cost ($) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="production_cost" name="production_cost"
                                   placeholder="0.00" step="0.01" min="0" required>
                            <div class="invalid-feedback">
                                Please provide a valid production cost.
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a status.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Card -->
                 <div class="form-group">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Total Cost</h6>
                            <p class="card-text">
                                <span class="h4 text-success" id="summaryCost">$0.00</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Production Summary</h6>
                            <p class="card-text">
                                <strong>Quantity:</strong> <span id="summaryQuantity">0</span><br>
                                <strong>Total Cost:</strong> <span class="h5 text-success" id="summaryCost">$0.00</span>
                            </p>
                        </div>
                    </div>
                </div> -->

                <hr>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-custom">
                        <i class="fas fa-save"></i> Save Production
                    </button>
                    <a href="<?php echo base_url('production'); ?>" class="btn btn-secondary btn-custom ml-2">
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
                        <i class="fas fa-cogs text-info"></i>
                        <small class="ml-2">Select the correct product</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-calendar text-primary"></i>
                        <small class="ml-2">Ensure correct production date</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-boxes text-warning"></i>
                        <small class="ml-2">Double-check produced quantity</small>
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-dollar-sign text-success"></i>
                        <small class="ml-2">Track cost accurately</small>
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

// Update Summary
function updateSummary() {
    const qty = parseFloat(document.getElementById('quantity_produced').value) || 0;
    const cost = parseFloat(document.getElementById('production_cost').value) || 0;
    const total = qty * cost;

    document.getElementById('summaryCost').textContent = '$' + total.toFixed(2);
    
}
document.getElementById('quantity_produced').addEventListener('input', updateSummary);
document.getElementById('production_cost').addEventListener('input', updateSummary);
</script>
