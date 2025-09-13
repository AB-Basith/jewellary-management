<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Expense Management</h1>
    <a href="<?php echo base_url('expenses/add'); ?>" class="btn btn-success btn-custom">
        <i class="fas fa-plus"></i> Add New Expense
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

<!-- Expense Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-success h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            This Month's Expenses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            $<?php echo number_format($stats['monthly_total'], 2); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-wallet fa-2x text-white-50"></i>
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
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white">
                            Total Records
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php echo count($expenses); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-white-50"></i>
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
                            Categories Used
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php echo count($stats['by_category']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-pie fa-2x text-white-50"></i>
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
                            Average Expense
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            $<?php 
                                $avg_expense = count($expenses) > 0 ? array_sum(array_column($expenses, 'amount')) / count($expenses) : 0;
                                echo number_format($avg_expense, 2); 
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

<!-- Expenses Table -->
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Expense Records</h6>
            </div>
            <div class="col-auto">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchExpenses" placeholder="Search expenses...">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="expensesTable">
                <thead class="thead-light">
                    <tr>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($expenses as $expense): ?>
                    <tr>
                        <td>
                            <span class="badge badge-info"><?php echo $expense->category; ?></span>
                        </td>
                        <td><?php echo $expense->description; ?></td>
                        <td><strong class="text-danger">$<?php echo number_format($expense->amount, 2); ?></strong></td>
                        <td><?php echo ucfirst($expense->payment_method); ?></td>
                        <td><?php echo date('M d, Y', strtotime($expense->expense_date)); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?php echo base_url('expenses/edit/'.$expense->id); ?>" 
                                   class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo base_url('expenses/delete/'.$expense->id); ?>" 
                                   class="btn btn-outline-danger" 
                                   onclick="return confirm('Are you sure you want to delete this expense?')" 
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
// Expenses search functionality
document.getElementById('searchExpenses').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const table = document.getElementById('expensesTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        const category = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
        const description = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
        
        if (category.indexOf(searchTerm) > -1 || description.indexOf(searchTerm) > -1) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});

//  document.getElementById("searchExpenses").addEventListener("keyup", function() {
//         let value = this.value.toLowerCase();
//         document.querySelectorAll("#expensesTable tbody tr").forEach(function(row) {
//             row.style.display = row.textContent.toLowerCase().includes(value) ? "" : "none";
//         });
//     });
</script>
