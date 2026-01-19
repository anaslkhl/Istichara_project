<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Registration</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <div class="logo">
                <i class="fas fa-balance-scale"></i>
                <h1>LegalConnect</h1>
            </div>
            <nav class="main-nav">
                <a href="index.html">Clients</a>
                <a href="professional.html">Professionals</a>
                <a href="#">Login</a>
            </nav>
        </header>

        <main class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h2><i class="fas fa-user-plus"></i> Client Registration</h2>
                    <p>Create your account to connect with legal professionals</p>
                </div>
                
                <form class="registration-form" id="clientForm">
                    <div class="form-group">
                        <label for="clientName">
                            <i class="fas fa-user"></i> Full Name
                        </label>
                        <input type="text" id="clientName" name="clientName" required placeholder="Enter your full name">
                    </div>
                    
                    <div class="form-group">
                        <label for="clientEmail">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <input type="email" id="clientEmail" name="clientEmail" required placeholder="Enter your email">
                    </div>
                    
                    <div class="form-group">
                        <label for="clientPassword">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="password-input">
                            <input type="password" id="clientPassword" name="clientPassword" required placeholder="Create a password">
                            <button type="button" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar"></div>
                            <span class="strength-text">Password strength: Weak</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPassword">
                            <i class="fas fa-lock"></i> Confirm Password
                        </label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Confirm your password">
                    </div>
                    
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">
                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                        </label>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-user-check"></i> Create Account
                    </button>
                    
                    <div class="form-footer">
                        <p>Already have an account? <a href="#">Sign In</a></p>
                    </div>
                </form>
            </div>
            
            <div class="info-sidebar">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Secure & Confidential</h3>
                    <p>Your information is protected with enterprise-grade security</p>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Quick Matching</h3>
                    <p>Get connected with qualified professionals in minutes</p>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Our team is always here to help you with any questions</p>
                </div>
            </div>
        </main>
    </div>
    
    <script src="script.js"></script>
</body>
</html>