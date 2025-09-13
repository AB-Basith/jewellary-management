<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Expense</h1>
    <a href="<?php echo base_url('expenses'); ?>" class="btn btn-secondary btn-custom">
        <i class="fas fa-arrow-left"></i> Back to Expenses
    </a>
</div>

<div class="row">
    <!-- Expense Add Form -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">New Expense Information</h6>
            </div>
            <div class="card-body">
                <?php echo form_open('expenses/add', ['class' => 'needs-validation', 'novalidate' => '']); ?>

                <div class="row">
                    <!-- Category -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Category <span class="text-danger">*</span></label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="Office" <?php echo set_select('category', 'Office'); ?>>Office</option>
                                <option value="Utility" <?php echo set_select('category', 'Utility'); ?>>Utility</option>
                                <option value="Travel" <?php echo set_select('category', 'Travel'); ?>>Travel</option>
                                <option value="Salary" <?php echo set_select('category', 'Salary'); ?>>Salary</option>
                                <option value="Misc" <?php echo set_select('category', 'Misc'); ?>>Miscellaneous</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a category.
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="description" name="description"
                                   value="<?php echo set_value('description'); ?>"
                                   placeholder="e.g., Internet Bill, Taxi Fare" required>
                            <div class="invalid-feedback">
                                Please provide a description.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Amount -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Amount ($) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                   value="<?php echo set_value('amount'); ?>"
                                   placeholder="0.00" step="0.01" min="0" required>
                            <div class="invalid-feedback">
                                Please provide a valid amount.
                            </div>
                        </div>
                    </div>

                    <!-- Expense Date -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expense_date">Expense Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="expense_date" name="expense_date"
                                   value="<?php echo set_value('expense_date'); ?>" required>
                            <div class="invalid-feedback">
                                Please select an expense date.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                <!-- Payment Method -->
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="payment_method">Payment Method <span class="text-danger">*</span></label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="">Select Payment Method</option>
                                <option value="Cash" <?php echo set_select('payment_method', 'Cash'); ?>>Cash</option>
                                <option value="Card" <?php echo set_select('payment_method', 'Card'); ?>>Card</option>
                                <option value="Bank Transfer" <?php echo set_select('payment_method', 'Bank Transfer'); ?>>Bank Transfer</option>
                                <option value="UPI" <?php echo set_select('payment_method', 'UPI'); ?>>UPI</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a payment method.
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-custom">
                        <i class="fas fa-save"></i> Add Expense
                    </button>
                    <a href="<?php echo base_url('expenses'); ?>" class="btn btn-secondary btn-custom ml-2">
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
                    <li class="mb-2"><i class="fas fa-money-bill text-success"></i> <small class="ml-2">Record expenses daily</small></li>
                    <li class="mb-2"><i class="fas fa-tags text-info"></i> <small class="ml-2">Categorize properly for reports</small></li>
                    <li class="mb-2"><i class="fas fa-calendar-alt text-primary"></i> <small class="ml-2">Use the exact transaction date</small></li>
                    <li class="mb-0"><i class="fas fa-credit-card text-warning"></i> <small class="ml-2">Select correct payment method</small></li>
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
</script>
