<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Admin Dashboard by Basith</title>
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">

  <!-- Fonts and Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />

  <!-- Material Dashboard CSS -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

  <style>
    @media (max-width: 991px) {
      .welcome-side {
        display: none !important;
      }
    }
  </style>
</head>
<body class="bg-gray-200">

    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row justify-content-center min-vh-100">

                        <!-- Login Form -->
                        <div class="col-lg-5 col-md-7 d-flex align-items-center mx-auto">
                            <div class="card card-plain col-12">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h4 class="font-weight-bolder">Sign in</h4>
                                    <p class="mb-0">Enter your credentials to access the dashboard</p>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($error)): ?>
                                    <div class="alert text-danger">
                                        <?= $error ?>
                                    </div>
                                    <?php endif; ?>
                                    <form method="post" action="<?php echo base_url("UserController/login");?>">
                                        <div class="mb-3">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control form-control-lg"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg bg-gradient-primary w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="#" class="text-primary text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Welcome Side -->
                        <div class="col-lg-6 d-none d-lg-flex welcome-side">
                            <div
                                class="position-relative bg-gradient-primary w-100 my-4 px-7 border-radius-lg d-flex flex-column justify-content-center text-center">
                                <h4 class="mt-5 text-white font-weight-bolder">Welcome Back!</h4>
                                <p class="text-white">Please login to manage your dashboard content securely.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- JS Files -->
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/material-dashboard.min.js?v=3.2.0"></script>

</body>
</html>
