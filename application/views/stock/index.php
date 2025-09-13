<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Stock Management</h1>
    <a href="<?php echo base_url('stock/add'); ?>" class="btn btn-primary btn-custom">
        <i class="fas fa-plus"></i> Add New Stock
    </a>
</div>

<!-- Low Stock Alert -->
<?php if (!empty($low_stock)): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-triangle"></i>
    <strong>Low Stock Alert!</strong> <?php echo count($low_stock); ?> items are running low on stock.
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
<?php endif; ?>

<!-- Stock Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Total Products
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php echo count($stocks); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-2x text-white-50"></i>
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
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Low Stock Items
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php echo is_array($low_stock) ? count($low_stock) : 0; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-success h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Total Value
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            $<?php 
                            $total_value = 0;
                            foreach($stocks as $stock) {
                                $total_value += $stock->gram * $stock->gram_rate;
                            }
                            echo number_format($total_value, 0); 
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

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-danger h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Ornaments
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php 
                            $categories = array();
                            foreach($stocks as $stock) {
                                $categories[$stock->ornaments] = true;
                            }
                            echo count($categories); 
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-pie fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Stock Table -->
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Stock Inventory</h6>
            </div>
            <div class="col-auto">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchStock" placeholder="Search products...">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="stockTable">
                <thead class="thead-light">
                    <tr>
                        <th>Product Name</th>
                        <th>Ornaments</th>
                        <th>Gram</th>
                        <th>Gram Rate</th>
                        <th>Total Value</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stocks as $stock): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary rounded-circle mr-2 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                                <strong><?php echo $stock->product_name; ?></strong>
                            </div>
                        </td>
                        <td><span class="badge badge-secondary"><?php echo $stock->ornaments; ?></span></td>
                        <td>
                            <?php if ($stock->gram <= 5): ?>
                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> <?php echo $stock->gram; ?></span>
                            <?php else: ?>
                                <?php echo $stock->gram; ?>
                            <?php endif; ?>
                        </td>
                        <td>$<?php echo number_format($stock->gram_rate, 2); ?></td>
                        <!-- <td><strong>$<?php echo number_format($stock->gram * $stock->gram_rate, 2); ?></strong></td> -->
                        <?php
                            $gram = $stock->gram;
                            $rate = $stock->gram_rate;
                            $wastagePercent = $stock->wastage_percent ?? 0;

                            $wastageGram = ($gram * $wastagePercent) / 100;
                            $totalGram   = $gram + $wastageGram;
                            $totalValue  = $totalGram * $rate;
                        ?>
                        <td><strong>$<?php echo number_format($totalValue, 2); ?></strong></td>
                        <td><?php echo $stock->supplier; ?></td>
                        <td>
                            <?php if ($stock->gram > 20): ?>
                                <span class="badge badge-success">In Stock</span>
                            <?php elseif ($stock->gram > 10): ?>
                                <span class="badge badge-warning">Medium</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Low Stock</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?php echo base_url('stock/edit/'.$stock->id); ?>" 
                                   class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo base_url('stock/delete/'.$stock->id); ?>" 
                                   class="btn btn-outline-danger" 
                                   onclick="return confirm('Are you sure you want to delete this item?')" 
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
// Stock search functionality
document.getElementById('searchStock').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const table = document.getElementById('stockTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        const productName = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
        const ornaments = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
        
        if (productName.indexOf(searchTerm) > -1 || ornaments.indexOf(searchTerm) > -1) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
</script>