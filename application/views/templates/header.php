<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Admin Dashboard'; ?></title>
    <link rel="icon" href="assets/img/AGH_logo.jpeg">

    
    <!-- Bootstrap 4 CSS -->
    <link href="../../../../new_aysha_gold/assets/css/bootstrap4.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: 12px 20px;
            margin: 2px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
        }
        
        .main-content {
            margin-left: 240px;
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .stat-card-success {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        }
        
        .stat-card-warning {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
        }
        
        .stat-card-danger {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        @media (max-width: 767.98px) {
            .sidebar {
                position: static;
                height: auto;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-nav {
                display: block !important;
            }
        }
        
        .mobile-nav {
            display: none;
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .btn-custom {
            border-radius: 25px;
            padding: 8px 25px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Mobile Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark mobile-nav" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url('assets/img/AGH_logo.jpeg'); ?>" alt="Aysha Gold Logo" height="50" />
            AYSHA GOLD
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mobileNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('stock'); ?>">
                        <i class="fas fa-boxes"></i> Stock
                    </a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="stockDropdown" role="button" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-boxes"></i> Stock
                    </a>
                    <div class="dropdown-menu" aria-labelledby="stockDropdown">
                        <a class="dropdown-item" href="<?php echo base_url('stockmonthly'); ?>">
                            <i class="fas fa-warehouse"></i> Monthly In-Hand
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url('stockbuyin'); ?>">
                            <i class="fas fa-arrow-down"></i> Buy-In Stock
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url('stockorder'); ?>">
                            <i class="fas fa-arrow-up"></i> Order Stock
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('sales'); ?>">
                        <i class="fas fa-chart-line"></i> Sales
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('production'); ?>">
                        <i class="fas fa-cogs"></i> Production
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('expenses'); ?>">
                        <i class="fas fa-money-bill-wave"></i> Expenses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('invoices'); ?>">
                        <i class="fas fa-file-invoice"></i> Invoices
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">
                        <i class="fas fa-lock"></i> Log-out
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Desktop Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <div class="text-center p-3">
                        <h4 class="text-white">
                            <img src="<?php echo base_url('assets/img/AGH_logo.jpeg'); ?>" alt="Aysha Gold Logo" height="70" /><br>
                            <small>AYSHA GOLD</small>
                        </h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (uri_string() == 'dashboard' || uri_string() == '') ? 'active' : ''; ?>" 
                               href="<?php echo base_url('dashboard'); ?>">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link <?php echo (uri_string() == 'stock') ? 'active' : ''; ?>" 
                               href="<?php echo base_url('stock'); ?>">
                                <i class="fas fa-boxes"></i> Stock Management
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" 
                            data-toggle="collapse" href="#stockSubmenu" role="button" 
                            aria-expanded="false" aria-controls="stockSubmenu">
                                <span><i class="fas fa-boxes"></i> Stock Management</span>
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <div class="collapse" id="stockSubmenu">
                                <ul class="nav flex-column ml-3">
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo (uri_string() == 'stockmonthly') ? 'active' : ''; ?>" 
                                        href="<?php echo base_url('stockmonthly'); ?>">
                                        <i class="fas fa-warehouse"></i> Monthly In-Hand
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo (uri_string() == 'stockbuyin') ? 'active' : ''; ?>" 
                                        href="<?php echo base_url('stockbuyin'); ?>">
                                        <i class="fas fa-arrow-down"></i> Buy-In Stock
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo (uri_string() == 'stockorder') ? 'active' : ''; ?>" 
                                        href="<?php echo base_url('stockorder'); ?>">
                                        <i class="fas fa-arrow-up"></i> Order Stock
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (uri_string() == 'sales') ? 'active' : ''; ?>" 
                               href="<?php echo base_url('sales'); ?>">
                                <i class="fas fa-chart-line"></i> Sales Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (uri_string() == 'production') ? 'active' : ''; ?>" 
                               href="<?php echo base_url('production'); ?>">
                                <i class="fas fa-cogs"></i> Production Tracking 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (uri_string() == 'expenses') ? 'active' : ''; ?>" 
                               href="<?php echo base_url('expenses'); ?>">
                                <i class="fas fa-money-bill-wave"></i> Expenses Tracking
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (uri_string() == 'invoices') ? 'active' : ''; ?>" 
                               href="<?php echo base_url('invoices'); ?>">
                                <i class="fas fa-file-invoice"></i> Invoices Handling
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (uri_string() == 'auth') ? 'active' : ''; ?>" 
                               href="<?php echo base_url('auth/logout'); ?>">
                                <i class="fas fa-lock"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-10 ml-sm-auto main-content">