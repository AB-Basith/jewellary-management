<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Overview</h1>
    <div class="text-muted">
        <i class="fas fa-calendar"></i> <?php echo date('F d, Y'); ?>
    </div>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<!-- Stats Cards Row -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Stock Value</div>
                        <div class="h5 mb-0 font-weight-bold">$<?php echo number_format($stats['total_stock_value'], 2); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-2x text-white-50"></i>
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
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Monthly Sales</div>
                        <div class="h5 mb-0 font-weight-bold text-white">$<?php echo number_format($stats['monthly_sales'], 2); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-white-50"></i>
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
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Monthly Expenses</div>
                        <div class="h5 mb-0 font-weight-bold text-white">$<?php echo number_format($stats['monthly_expenses'], 2); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill-wave fa-2x text-white-50"></i>
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
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Pending Invoices</div>
                        <div class="h5 mb-0 font-weight-bold text-white"><?php echo $stats['pending_invoices']; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Sales Overview</h6>
            </div>
            <div class="card-body">
                <canvas id="salesChart" width="100%" height="50"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Expense Categories</h6>
            </div>
            <div class="card-body">
                <canvas id="expenseChart" width="100%" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Sales Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Recent Sales</h6>
                <a href="<?php echo base_url('sales'); ?>" class="btn btn-primary btn-sm btn-custom">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Gram</th>
                                <th>Gram Rate</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_sales)): ?>
                                <?php foreach ($recent_sales as $sale): ?>
                                <tr>
                                    <td><?php echo $sale->product_name ?? 'N/A'; ?></td>
                                    <td><?php echo $sale->customer_name; ?></td>
                                    <td><?php echo $sale->quantity_sold; ?></td>
                                    <td>$<?php echo number_format($sale->total_amount, 2); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($sale->sale_date)); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No recent sales found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Sales Chart
const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        datasets: [{
            label: 'Sales ($)',
            data: [1200, 1900, 3000, 5000, 2300, 3200, 4100, <?php echo $stats['monthly_sales']; ?>],
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return ' + value;'
                    }
                }
            }
        }
    }
});

// Expense Chart
const expenseCtx = document.getElementById('expenseChart').getContext('2d');
const expenseChart = new Chart(expenseCtx, {
    type: 'doughnut',
    data: {
        labels: ['Office Supplies', 'Utilities', 'Marketing', 'Travel', 'Software'],
        datasets: [{
            data: [300, 500, 800, 400, 600],
            backgroundColor: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#9966FF'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            }
        }
    }
});
</script>