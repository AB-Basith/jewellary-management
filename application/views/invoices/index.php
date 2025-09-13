<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Invoice Management</h1>
    <a href="<?php echo base_url('invoices/add'); ?>" class="btn btn-success btn-custom">
        <i class="fas fa-plus"></i> Add New Invoice
    </a>
</div>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<!-- Invoice Statistics Cards -->
<div class="row mb-4">
    <!-- Total Invoice Amount -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-success h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Total Invoice Amount
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            $<?php 
                            $total_invoices = 0;
                            foreach($invoices as $inv) {
                                $total_invoices += $inv->total_amount;
                            }
                            echo number_format($total_invoices, 2); 
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice-dollar fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Invoices -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Total Invoices
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php echo count($invoices); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Invoices -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-warning h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Today's Invoices
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php 
                            $today_invoices = 0;
                            foreach($invoices as $inv) {
                                if(date('Y-m-d', strtotime($inv->invoice_date)) == date('Y-m-d')) {
                                    $today_invoices++;
                                }
                            }
                            echo $today_invoices; 
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-day fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Average Invoice -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-danger h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Average Invoice
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            $<?php 
                            $avg_invoice = count($invoices) > 0 ? $total_invoices / count($invoices) : 0;
                            echo number_format($avg_invoice, 2); 
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-percentage fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Invoices Table -->
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Invoices Records</h6>
            </div>
            <div class="col-auto">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInvoices" placeholder="Search invoices...">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="invoiceTable">
                <thead class="thead-light">
                    <tr>
                        <th>Invoice #</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Tax</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $inv): ?>
                    <tr>
                        <td><strong><?php echo $inv->invoice_number; ?></strong></td>
                        <td><?php echo $inv->customer_name; ?></td>
                        <td><?php echo $inv->customer_email; ?></td>
                        <td><strong class="text-success">$<?php echo number_format($inv->total_amount, 2); ?></strong></td>
                        <td>$<?php echo number_format($inv->tax_amount, 2); ?></td>
                        <td>$<?php echo number_format($inv->discount_amount, 2); ?></td>
                        <td>
                            <?php if($inv->status == 'paid'): ?>
                                <span class="badge badge-success">Paid</span>
                            <?php elseif($inv->status == 'pending'): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php elseif($inv->status == 'draft'): ?>
                                <span class="badge badge-warning">Draft</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Overdue</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($inv->invoice_date)); ?></td>
                        <td><?php echo date('M d, Y', strtotime($inv->due_date)); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?php echo base_url('invoices/view/'.$inv->id); ?>" 
                                   class="btn btn-outline-primary" title="view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo base_url('invoices/billing/'.$inv->id); ?>" target="_blank"
                                    class="btn btn-outline-success" title="Download">
                                        <i class="fas fa-download"></i>
                                </a>
                                <a href="<?php echo base_url('invoices/delete/'.$inv->id); ?>" 
                                   class="btn btn-outline-danger" 
                                   onclick="return confirm('Are you sure you want to delete this invoice?')" 
                                   title="Delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Invoice search functionality
document.getElementById('searchInvoices').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const table = document.getElementById('invoiceTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        const invoiceNum = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
        const customerName = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
        
        if (invoiceNum.indexOf(searchTerm) > -1 || customerName.indexOf(searchTerm) > -1) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
</script>
