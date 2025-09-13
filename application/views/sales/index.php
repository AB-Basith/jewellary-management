<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sales Management</h1>
    <a href="<?php echo base_url('sales/add'); ?>" class="btn btn-success btn-custom">
        <i class="fas fa-plus"></i> Add New Sale
    </a>
</div>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<!-- Sales Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-success h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">Total Sales</div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            $<?php 
                            $total_sales = 0;
                            foreach($sales as $sale) {
                                $total_sales += $sale->total_amount;
                            }
                            echo number_format($total_sales, 0); 
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">Total Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php echo count($sales); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-warning h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">Today's Sales</div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php 
                            $today_sales = 0;
                            foreach($sales as $sale) {
                                if(date('Y-m-d', strtotime($sale->sale_date)) == date('Y-m-d')) {
                                    $today_sales++;
                                }
                            }
                            echo $today_sales; 
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

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-danger h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">Average Sale</div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            $<?php 
                            $avg_sale = count($sales) > 0 ? $total_sales / count($sales) : 0;
                            echo number_format($avg_sale, 0); 
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Sales Table -->
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Sales Records</h6>
            </div>
            <div class="col-auto">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchSales" placeholder="Search sales...">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="salesTable">
                <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Amount</th>
                        <th>Sale Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-success rounded-circle mr-2 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                                <strong><?php echo $sale->product_name ?? 'N/A'; ?></strong>
                            </div>
                        </td>
                        <td><?php echo $sale->customer_name; ?></td>
                        <td><span class="badge badge-primary"><?php echo $sale->quantity_sold; ?></span></td>
                        <td>$<?php echo number_format($sale->unit_price, 2); ?></td>
                        <td><strong class="text-success">$<?php echo number_format($sale->total_amount, 2); ?></strong></td>
                        <td><?php echo date('M d, Y', strtotime($sale->sale_date)); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?php echo base_url('sales/edit/'.$sale->id); ?>" 
                                   class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo base_url('sales/delete/'.$sale->id); ?>" 
                                   class="btn btn-outline-danger" 
                                   onclick="return confirm('Are you sure you want to delete this sale?')" 
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
// Sales search functionality
document.getElementById('searchSales').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const table = document.getElementById('salesTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        const productName = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
        const customerName = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
        
        if (productName.indexOf(searchTerm) > -1 || customerName.indexOf(searchTerm) > -1) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
</script>