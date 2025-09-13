<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Sign In'; ?></title>
    <link rel="icon" href="/assets/img/AGH_logo.jpeg">    
    <!-- Bootstrap 4 CSS -->
    <link href="../../../../new_aysha_gold/assets/css/bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            overflow: hidden;
        }
        .auth-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .auth-header h2 { margin: 0; font-weight: 300; font-size: 2rem; }
        .auth-body { padding: 30px; }
        .form-control {
            height: 50px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .auth-footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .auth-footer a { color: #667eea; font-weight: 600; }
        .auth-footer a:hover { color: #764ba2; }
        .alert { border-radius: 10px; margin-bottom: 20px; }
        .alert-danger { background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%); color: white; }
        .alert-success { background: linear-gradient(135deg, #51cf66 0%, #40c057 100%); color: white; }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            z-index: 5;
        }
        .input-group { position: relative; }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="fas fa-sign-in-alt fa-2x mb-3"></i>
                <h2>Welcome Back</h2>
                <p>Please sign in to your account</p>
            </div>
            
            <div class="auth-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
                
                <?php echo form_open('auth/signin'); ?>
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope mr-2"></i>Email address</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               placeholder="name@example.com" value="<?php echo set_value('email'); ?>" required>
                        <?php echo form_error('email', '<div class="text-danger small">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock mr-2"></i>Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-eye"></i>
                            </button>
                        </div>
                        <?php echo form_error('password', '<div class="text-danger small">', '</div>'); ?>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-3">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </button>
                <?php echo form_close(); ?>
            </div>
            
            <div class="auth-footer">
                <p class="mb-0">Don't have an account? 
                    <a href="<?php echo base_url('auth/signup'); ?>">Sign up here</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(inputId + '-eye');
            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
