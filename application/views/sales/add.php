<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Sale</h1>
    <a href="<?php echo base_url('sales'); ?>" class="btn btn-secondary btn-custom">
        <i class="fas fa-arrow-left"></i> Back to Sales
    </a>
</div>

<div class="row">
    <!-- Sale Form -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Sale Information</h6>
            </div>
            <div class="card-body">
                <?php echo form_open('sales/add', ['class' => 'needs-validation', 'novalidate' => '']); ?>

                <div class="row">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_name">Customer Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                   placeholder="Enter customer name" required>
                            <div class="invalid-feedback">
                                Please provide a customer name.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity_sold">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="quantity_sold" name="quantity_sold"
                                   placeholder="Enter quantity" min="1" required>
                            <div class="invalid-feedback">
                                Please provide a valid quantity.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="unit_price">Unit Price ($) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="unit_price" name="unit_price"
                                   placeholder="0.00" step="0.01" min="0" required>
                            <div class="invalid-feedback">
                                Please provide a valid unit price.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sale_date">Sale Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="sale_date" name="sale_date"
                                   value="<?php echo date('Y-m-d'); ?>" required>
                            <div class="invalid-feedback">
                                Please provide a sale date.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="form-group">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Total Amount</h6>
                            <p class="card-text">
                                <span class="h4 text-success" id="totalAmount">$0.00</span>
                            </p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-custom">
                        <i class="fas fa-save"></i> Save Sale
                    </button>
                    <a href="<?php echo base_url('sales'); ?>" class="btn btn-secondary btn-custom ml-2">
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
                        <small class="ml-2">Choose the correct product for tracking</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-user text-primary"></i>
                        <small class="ml-2">Enter full customer details for reference</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-sort-numeric-up text-warning"></i>
                        <small class="ml-2">Check quantity before saving</small>
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-dollar-sign text-success"></i>
                        <small class="ml-2">Total updates automatically</small>
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

// Calculate total amount
function calculateTotal() {
    const quantity = parseFloat(document.getElementById('quantity_sold').value) || 0;
    const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
    const total = quantity * unitPrice;
    document.getElementById('totalAmount').textContent = '$' + total.toFixed(2);
}
document.getElementById('quantity_sold').addEventListener('input', calculateTotal);
document.getElementById('unit_price').addEventListener('input', calculateTotal);
</script>
