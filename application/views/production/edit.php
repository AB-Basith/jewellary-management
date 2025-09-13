<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Production</h1>
    <a href="<?php echo base_url('production'); ?>" class="btn btn-secondary btn-custom">
        <i class="fas fa-arrow-left"></i> Back to Production
    </a>
</div>

<div class="row">
    <!-- Production Edit Form -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Production Information</h6>
            </div>
            <div class="card-body">
                <?php echo form_open('production/edit/'.$production['id'], ['class' => 'needs-validation', 'novalidate' => '']); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_id">Product <span class="text-danger">*</span></label>
                            <?php echo form_dropdown(
                                'product_id',
                                ['' => 'Select Product'] + $products,   // products list from controller
                                $production['product_id'],
                                'class="form-control" id="product_id" required'
                            ); ?>
                            <div class="invalid-feedback">
                                Please select a product.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="production_date">Production Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="production_date" name="production_date"
                                   value="<?php echo $production['production_date']; ?>" required>
                            <div class="invalid-feedback">
                                Please provide a production date.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity_produced">Quantity Produced <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="quantity_produced" name="quantity_produced"
                                   value="<?php echo $production['quantity_produced']; ?>" placeholder="Enter quantity" min="1" required>
                            <div class="invalid-feedback">
                                Please provide a valid quantity.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="production_cost">Production Cost ($) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="production_cost" name="production_cost"
                                   value="<?php echo $production['production_cost']; ?>" placeholder="0.00" step="0.01" min="0" required>
                            <div class="invalid-feedback">
                                Please provide a valid production cost.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="In Progress" <?php echo ($production['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                                <option value="Completed" <?php echo ($production['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                <option value="Pending" <?php echo ($production['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a status.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Cost -->
                <div class="form-group">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Total Cost</h6>
                            <p class="card-text">
                                <span class="h4 text-success" id="totalCost">
                                    $<?php echo number_format($production['quantity_produced'] * $production['production_cost'], 2); ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-custom">
                        <i class="fas fa-save"></i> Update Production
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
                        <i class="fas fa-cube text-info"></i>
                        <small class="ml-2">Verify product selection</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-calendar text-primary"></i>
                        <small class="ml-2">Update the correct date</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-industry text-warning"></i>
                        <small class="ml-2">Adjust quantity if needed</small>
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-dollar-sign text-success"></i>
                        <small class="ml-2">Check cost calculation</small>
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

// Calculate total cost
function calculateTotal() {
    const quantity = parseFloat(document.getElementById('quantity_produced').value) || 0;
    const unitCost = parseFloat(document.getElementById('production_cost').value) || 0;
    const total = quantity * unitCost;
    document.getElementById('totalCost').textContent = '$' + total.toFixed(2);
}
document.getElementById('quantity_produced').addEventListener('input', calculateTotal);
document.getElementById('production_cost').addEventListener('input', calculateTotal);
</script>
