<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Production Tracking</h1>
    <a href="<?php echo base_url('production/add'); ?>" class="btn btn-success btn-custom">
        <i class="fas fa-plus"></i> Add New Production
    </a>
</div>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php elseif($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<!-- Production Statistics Cards -->
<div class="row mb-4">
    <!-- Monthly Production -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-success h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Production This Month
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php echo number_format($stats['monthly_production'] ?? 0); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-industry fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Records -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-warning h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Total Records
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php echo count($productions); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Completed Batches -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Completed Batches
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php 
                                $completed = 0;
                                foreach($stats['by_status'] as $s) {
                                    if($s->status == 'Completed') $completed = $s->count;
                                }
                                echo $completed;
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Production Table -->
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Production Records</h6>
            </div>
            <div class="col-auto">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchProduction" placeholder="Search production...">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="productionTable">
                <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productions as $prod): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary rounded-circle mr-2 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                                <strong><?php echo $prod->product_name ?? 'N/A'; ?></strong>
                            </div>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($prod->production_date)); ?></td>
                        <td><span class="badge badge-info"><?php echo $prod->quantity_produced; ?></span></td>
                        <td>$<?php echo number_format($prod->production_cost, 2); ?></td>
                        <td>
                            <?php if($prod->status == 'completed'): ?>
                                <span class="badge badge-success">Completed</span>
                            <?php elseif($prod->status == 'in_progress'): ?>
                                <span class="badge badge-warning">In Progress</span>
                            <?php elseif($prod->status == 'planned'): ?>
                                <span class="badge badge-secondary">Pending</span>
                            <?php else: ?>
                                <span class="badge badge-dark"><?php echo $prod->status; ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?php echo base_url('production/edit/'.$prod->id); ?>" 
                                   class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo base_url('production/delete/'.$prod->id); ?>" 
                                   class="btn btn-outline-danger" 
                                   onclick="return confirm('Are you sure you want to delete this record?')" 
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
// Production search functionality
document.getElementById('searchProduction').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const table = document.getElementById('productionTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        const productName = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
        const status = rows[i].getElementsByTagName('td')[4].textContent.toLowerCase();
        
        if (productName.indexOf(searchTerm) > -1 || status.indexOf(searchTerm) > -1) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
</script>
