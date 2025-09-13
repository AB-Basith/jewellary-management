<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Invoice</h1>
    <a href="<?php echo base_url('invoices'); ?>" class="btn btn-secondary btn-custom">
        <i class="fas fa-arrow-left"></i> Back to Invoices
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Invoice Information</h6>
            </div>
            <div class="card-body">
                <?php echo form_open('invoices/add', ['class' => 'needs-validation', 'novalidate' => '']); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="invoice_number">Invoice Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="invoice_number" id="invoice_number"
                                   value="<?php echo set_value('invoice_number'); ?>" required>
                            <div class="invalid-feedback">Invoice number is required.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_name">Customer Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name"
                                   value="<?php echo set_value('customer_name'); ?>" required>
                            <div class="invalid-feedback">Customer name is required.</div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="customer_email">Customer Email</label>
                    <input type="email" class="form-control" name="customer_email" id="customer_email"
                           value="<?php echo set_value('customer_email'); ?>">
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_amount">Total Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="total_amount" id="total_amount"
                                   value="<?php echo set_value('total_amount'); ?>" required>
                            <div class="invalid-feedback">Total amount is required.</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tax_amount">Tax Amount</label>
                            <input type="number" step="0.01" class="form-control" name="tax_amount" id="tax_amount"
                                   value="<?php echo set_value('tax_amount'); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount_amount">Discount</label>
                            <input type="number" step="0.01" class="form-control" name="discount_amount" id="discount_amount"
                                   value="<?php echo set_value('discount_amount'); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Paid">Paid</option>
                                <option value="Overdue">Overdue</option>
                            </select>
                            <div class="invalid-feedback">Please select a status.</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="invoice_date">Invoice Date</label>
                            <input type="date" class="form-control" name="invoice_date" id="invoice_date"
                                   value="<?php echo set_value('invoice_date'); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" name="due_date" id="due_date"
                                   value="<?php echo set_value('due_date'); ?>">
                        </div>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary btn-custom"><i class="fas fa-save"></i> Save Invoice</button>
                <a href="<?php echo base_url('invoices'); ?>" class="btn btn-secondary btn-custom ml-2">Cancel</a>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
     <!-- Tips -->
    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Quick Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-file-invoice text-success"></i> <small class="ml-2">Update customer details correctly</small></li>
                    <li class="mb-2"><i class="fas fa-percentage text-info"></i> <small class="ml-2">Include applicable discounts/taxes</small></li>
                    <li class="mb-2"><i class="fas fa-calendar-alt text-primary"></i> <small class="ml-2">Set realistic due dates</small></li>
                    <li class="mb-0"><i class="fas fa-check-circle text-warning"></i> <small class="ml-2">Update status after payment</small></li>
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
