<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Registration</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <div class="logo">
                <i class="fas fa-balance-scale"></i>
                <h1>LegalConnect Pro</h1>
            </div>
            <nav class="main-nav">
                <a href="index.html">Clients</a>
                <a href="professional.html" class="active">Professionals</a>
                <a href="#">Login</a>
            </nav>
        </header>

        <main class="main-content professional-content">
            <div class="form-container professional-form">
                <!-- Progress Steps -->
                <div class="progress-container">
                    <div class="progress-bar" id="progressBar"></div>
                    <div class="steps">
                        <div class="step active" data-step="1">
                            <div class="step-circle">1</div>
                            <div class="step-label">Personal Info</div>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-circle">2</div>
                            <div class="step-label">Documents</div>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-circle">3</div>
                            <div class="step-label">Review</div>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Personal Information -->
                <div class="form-step active" id="step1">
                    <div class="form-header">
                        <h2><i class="fas fa-user-tie"></i> Personal Information</h2>
                        <p>Please provide your professional details</p>
                    </div>
                    
                    <form class="step-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="proFirstName">
                                    <i class="fas fa-user"></i> First Name
                                </label>
                                <input type="text" id="proFirstName" name="proFirstName" required placeholder="Enter first name">
                            </div>
                            
                            <div class="form-group">
                                <label for="proLastName">
                                    <i class="fas fa-user"></i> Last Name
                                </label>
                                <input type="text" id="proLastName" name="proLastName" required placeholder="Enter last name">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="proEmail">
                                <i class="fas fa-envelope"></i> Professional Email
                            </label>
                            <input type="email" id="proEmail" name="proEmail" required placeholder="Enter professional email">
                        </div>
                        
                        <div class="form-group">
                            <label for="proPhone">
                                <i class="fas fa-phone"></i> Phone Number
                            </label>
                            <input type="tel" id="proPhone" name="proPhone" required placeholder="Enter phone number">
                        </div>
                        
                        <div class="form-group">
                            <label for="proSpecialty">
                                <i class="fas fa-graduation-cap"></i> Professional Specialty
                            </label>
                            <select id="proSpecialty" name="proSpecialty" required>
                                <option value="">Select your specialty</option>
                                <option value="lawyer">Lawyer</option>
                                <option value="bailiff">Bailiff</option>
                                <option value="notary">Notary</option>
                                <option value="legal_advisor">Legal Advisor</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="proExperience">
                                <i class="fas fa-briefcase"></i> Years of Experience
                            </label>
                            <input type="number" id="proExperience" name="proExperience" min="0" max="50" required placeholder="Years of experience">
                        </div>
                        
                        <div class="form-group">
                            <label for="proFees">
                                <i class="fas fa-money-bill-wave"></i> Hourly Rate (€)
                            </label>
                            <input type="number" id="proFees" name="proFees" min="50" max="1000" step="10" required placeholder="Hourly rate in euros">
                        </div>
                        
                        <div class="form-group">
                            <label for="proBio">
                                <i class="fas fa-file-alt"></i> Professional Bio
                            </label>
                            <textarea id="proBio" name="proBio" rows="4" placeholder="Brief description of your professional background"></textarea>
                        </div>
                    </form>
                    
                    <div class="step-buttons">
                        <button class="btn-next" onclick="nextStep(2)">
                            Next <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Documents -->
                <div class="form-step" id="step2">
                    <div class="form-header">
                        <h2><i class="fas fa-file-upload"></i> Document Upload</h2>
                        <p>Please upload your professional documents for verification</p>
                    </div>
                    
                    <div class="documents-section">
                        <div class="document-upload">
                            <div class="upload-area" id="professionalCardUpload">
                                <i class="fas fa-id-card"></i>
                                <h4>Professional Card</h4>
                                <p>Upload your professional identification card</p>
                                <input type="file" id="professionalCard" accept=".pdf,.jpg,.png" hidden>
                                <button type="button" class="upload-btn" onclick="document.getElementById('professionalCard').click()">
                                    Choose File
                                </button>
                                <div class="file-info">No file chosen</div>
                            </div>
                            
                            <div class="upload-area" id="diplomaUpload">
                                <i class="fas fa-graduation-cap"></i>
                                <h4>Diplomas & Certifications</h4>
                                <p>Upload your educational certificates</p>
                                <input type="file" id="diplomas" accept=".pdf,.jpg,.png" multiple hidden>
                                <button type="button" class="upload-btn" onclick="document.getElementById('diplomas').click()">
                                    Choose Files
                                </button>
                                <div class="file-info">No files chosen</div>
                            </div>
                            
                            <div class="upload-area" id="idUpload">
                                <i class="fas fa-passport"></i>
                                <h4>Government ID</h4>
                                <p>Upload your government-issued identification</p>
                                <input type="file" id="governmentId" accept=".pdf,.jpg,.png" hidden>
                                <button type="button" class="upload-btn" onclick="document.getElementById('governmentId').click()">
                                    Choose File
                                </button>
                                <div class="file-info">No file chosen</div>
                            </div>
                        </div>
                        
                        <div class="upload-requirements">
                            <h4><i class="fas fa-info-circle"></i> Upload Requirements:</h4>
                            <ul>
                                <li>Maximum file size: 5MB per file</li>
                                <li>Accepted formats: PDF, JPG, PNG</li>
                                <li>Documents must be clear and readable</li>
                                <li>All documents will be verified by our team</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="step-buttons">
                        <button class="btn-prev" onclick="prevStep(1)">
                            <i class="fas fa-arrow-left"></i> Previous
                        </button>
                        <button class="btn-next" onclick="nextStep(3)">
                            Next <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Review -->
                <div class="form-step" id="step3">
                    <div class="form-header">
                        <h2><i class="fas fa-clipboard-check"></i> Review & Submit</h2>
                        <p>Please review your information before submission</p>
                    </div>
                    
                    <div class="review-section">
                        <div class="review-card">
                            <h3><i class="fas fa-user-tie"></i> Personal Information</h3>
                            <div class="review-details">
                                <div class="review-item">
                                    <span>Full Name:</span>
                                    <span id="reviewName">-</span>
                                </div>
                                <div class="review-item">
                                    <span>Email:</span>
                                    <span id="reviewEmail">-</span>
                                </div>
                                <div class="review-item">
                                    <span>Specialty:</span>
                                    <span id="reviewSpecialty">-</span>
                                </div>
                                <div class="review-item">
                                    <span>Experience:</span>
                                    <span id="reviewExperience">-</span>
                                </div>
                                <div class="review-item">
                                    <span>Hourly Rate:</span>
                                    <span id="reviewFees">-</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="review-card">
                            <h3><i class="fas fa-file-alt"></i> Documents</h3>
                            <div class="review-details">
                                <div class="review-item">
                                    <span>Professional Card:</span>
                                    <span id="reviewCard">Not uploaded</span>
                                </div>
                                <div class="review-item">
                                    <span>Diplomas:</span>
                                    <span id="reviewDiplomas">Not uploaded</span>
                                </div>
                                <div class="review-item">
                                    <span>Government ID:</span>
                                    <span id="reviewId">Not uploaded</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="verification-notice">
                            <div class="notice-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="notice-content">
                                <h4>Verification Process</h4>
                                <p>After submission, your application will be reviewed by our administration team. 
                                This process usually takes 2-3 business days. You will receive an email notification once your account is approved.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="step-buttons">
                        <button class="btn-prev" onclick="prevStep(2)">
                            <i class="fas fa-arrow-left"></i> Previous
                        </button>
                        <button class="submit-btn" onclick="submitApplication()">
                            <i class="fas fa-paper-plane"></i> Submit Application
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script src="script.js"></script>
</body>
</html>