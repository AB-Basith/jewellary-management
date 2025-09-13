<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Invoice</h1>
    <a href="<?php echo base_url('invoices'); ?>" class="btn btn-secondary btn-custom">
        <i class="fas fa-arrow-left"></i> Back to Invoices
    </a>
</div>

<div class="row">
    <!-- Invoice Edit Form -->
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Invoice Information</h6>
                <a href="<?php echo base_url('invoices/billing/'); ?>" 
                class="btn btn-outline-success" title="Print">
                    <i class="fas fa-print"></i>
                </a>
            </div>
            <div class="card-body">
                <?php echo form_open('invoices/view/'.$invoice->id, ['class' => 'needs-validation', 'novalidate' => '']); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="invoice_number">Invoice Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                                   value="<?php echo set_value('invoice_number', $invoice->invoice_number); ?>"
                                   readonly>
                            <div class="invalid-feedback">Please enter the invoice number.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_name">Customer Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                   value="<?php echo set_value('customer_name', $invoice->customer_name); ?>"
                                   readonly>
                            <div class="invalid-feedback">Please enter customer name.</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_email">Customer Email</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email"
                                   value="<?php echo set_value('customer_email', $invoice->customer_email); ?>"
                                   readonly>
                            <div class="invalid-feedback">Please enter valid email.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="status" name="status"
                                   value="<?php echo $invoice->status; ?>"
                                   readonly>
                            <div class="invalid-feedback">Please select status.</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_amount">Total Amount ($) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="total_amount" name="total_amount"
                                   value="<?php echo set_value('total_amount', $invoice->total_amount); ?>"
                                   readonly>
                            <div class="invalid-feedback">Please enter total amount.</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tax_amount">Tax Amount ($)</label>
                            <input type="number" class="form-control" id="tax_amount" name="tax_amount"
                                   value="<?php echo set_value('tax_amount', $invoice->tax_amount); ?>"
                                   readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount_amount">Discount ($)</label>
                            <input type="number" class="form-control" id="discount_amount" name="discount_amount"
                                   value="<?php echo set_value('discount_amount', $invoice->discount_amount); ?>"
                                   readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="invoice_date">Invoice Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date"
                                   value="<?php echo set_value('invoice_date', $invoice->invoice_date); ?>" readonly>
                            <div class="invalid-feedback">Please select invoice date.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="due_date">Due Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="due_date" name="due_date"
                                   value="<?php echo set_value('due_date', $invoice->due_date); ?>" readonly>
                            <div class="invalid-feedback">Please select due date.</div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-group mb-0">
                    <!-- <button type="submit" class="btn btn-primary btn-custom">
                        <i class="fas fa-save"></i> Update Invoice
                    </button> -->
                    <a href="<?php echo base_url('invoices'); ?>" class="btn btn-secondary btn-custom ml-2">
                        Cancel
                    </a>
                </div>

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
