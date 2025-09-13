<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Sign Up'; ?></title>
    <link rel="icon" href="assets/img/AGH_logo.jpeg">    
    <!-- Bootstrap 4 CSS -->
    <link href="../../../../new_aysha_gold/assets/css/bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .auth-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .auth-header h2 {
            margin: 0;
            font-weight: 300;
            font-size: 2rem;
        }
        .auth-header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }
        .auth-body {
            padding: 30px;
        }
        .form-group input {
            height: 50px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
        }
        .form-group input:focus {
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
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .auth-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .alert {
            border-radius: 10px;
        }
        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
        }
        .alert-success {
            background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
            color: white;
        }
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
        .input-group {
            position: relative;
        }
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 8px;
            background: #e9ecef;
        }
        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        .strength-weak { width: 33%; background: #ff6b6b; }
        .strength-medium { width: 66%; background: #ffd93d; }
        .strength-strong { width: 100%; background: #51cf66; }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="fas fa-user-plus fa-2x mb-3"></i>
                <h2>Join Us Today</h2>
                <p>Create your account to get started</p>
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
                
                <?php echo form_open('auth/signup', ['class' => 'needs-validation', 'novalidate' => '']); ?>
                    
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user mr-2"></i>Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?php echo set_value('name'); ?>" required>
                        <?php echo form_error('name', '<div class="invalid-feedback d-block">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope mr-2"></i>Email address</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo set_value('email'); ?>" required>
                        <?php echo form_error('email', '<div class="invalid-feedback d-block">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock mr-2"></i>Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" 
                                   required onkeyup="checkPasswordStrength(this.value)">
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="password-strength-bar"></div>
                        </div>
                        <small class="text-muted" id="password-strength-text">Password must be at least 6 characters</small>
                        <?php echo form_error('password', '<div class="invalid-feedback d-block">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password"><i class="fas fa-lock mr-2"></i>Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                                <i class="fas fa-eye" id="confirm_password-eye"></i>
                            </button>
                        </div>
                        <?php echo form_error('confirm_password', '<div class="invalid-feedback d-block">', '</div>'); ?>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#">Terms of Service</a> and 
                            <a href="#">Privacy Policy</a>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block py-2">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </button>
                <?php echo form_close(); ?>
            </div>
            
            <div class="auth-footer">
                <p class="mb-0">Already have an account? 
                    <a href="<?php echo base_url('auth/signin'); ?>">Sign in here</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 4.6 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
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

        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');
            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.length >= 10) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            strengthBar.className = 'password-strength-bar';
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Weak password';
                strengthText.style.color = '#ff6b6b';
            } else if (strength <= 3) {
                strengthBar.classList.add('strength-medium');
                strengthText.textContent = 'Medium password';
                strengthText.style.color = '#ffd93d';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Strong password';
                strengthText.style.color = '#51cf66';
            }
        }

        document.getElementById('confirm_password').addEventListener('keyup', function() {
            const password = document.getElementById('password').value;
            if (this.value && this.value !== password) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>
