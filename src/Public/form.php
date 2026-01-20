<?php

$person = $person ?? null;
$isEdit = $person !== null;

$action = $isEdit ? '/update' : '/store';
$title  = $isEdit ? 'Modifier un professionnel' : 'Ajouter un professionnel';

use Repository\villeRepository;

$villeRepo = new villeRepository();
$villes = $villeRepo->getAll();

$personRole = null;
if ($isEdit) {
    $personRole = $person['speciality'] ? 'avocat' : ($person['type_actes'] ? 'huissier' : null);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISTICHARA - Inscription</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Header avec sélection du type d'utilisateur -->
        <header class="main-header">
            <div class="logo">
                <i class="fas fa-balance-scale"></i>
                <h1>ISTICHARA</h1>
            </div>
            
            <div class="user-type-selector">
                <div class="selector-tabs">
                    <button class="tab-btn active" data-type="client">
                        <i class="fas fa-user"></i> Client
                    </button>
                    <button class="tab-btn" data-type="professional">
                        <i class="fas fa-user-tie"></i> Professionnel
                    </button>
                </div>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Form Client -->
            <div class="form-container active" id="clientFormContainer">
                <div class="form-header">
                    <h2><i class="fas fa-user-plus"></i> Inscription Client</h2>
                    <p>Créez votre compte pour accéder aux services juridiques</p>
                </div>
                
                <form action="/store" method="POST" id="clientForm" class="registration-form">
                    <input type="hidden" name="user_type" value="client">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="client_fullname">
                                <i class="fas fa-user"></i> Nom complet
                            </label>
                            <input type="text" id="client_fullname" name="fullname" required placeholder="Votre nom complet">
                        </div>
                        
                        <div class="form-group">
                            <label for="client_email">
                                <i class="fas fa-envelope"></i> Email
                            </label>
                            <input type="email" id="client_email" name="email" required placeholder="votre@email.com">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="client_phone">
                            <i class="fas fa-phone"></i> Téléphone
                        </label>
                        <input type="text" id="client_phone" name="phone" required placeholder="Votre numéro de téléphone">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="client_password">
                                <i class="fas fa-lock"></i> Mot de passe
                            </label>
                            <div class="password-input">
                                <input type="password" id="client_password" name="password" required placeholder="Créez un mot de passe">
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="client_confirm_password">
                                <i class="fas fa-lock"></i> Confirmer le mot de passe
                            </label>
                            <input type="password" id="client_confirm_password" name="confirm_password" required placeholder="Confirmez le mot de passe">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="client_ville_id">
                            <i class="fas fa-city"></i> Ville
                        </label>
                        <select id="client_ville_id" name="ville_id" required>
                            <option value="">Sélectionnez votre ville</option>
                            <!-- Les options seront chargées dynamiquement -->
                        </select>
                    </div>
                    
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="client_terms" name="terms" required>
                        <label for="client_terms">
                            J'accepte les <a href="#">Conditions d'utilisation</a> et la <a href="#">Politique de confidentialité</a>
                        </label>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-user-check"></i> Créer mon compte
                    </button>
                    
                    <div class="form-footer">
                        <p>Déjà inscrit ? <a href="#">Se connecter</a></p>
                    </div>
                </form>
            </div>

            <!-- Form Professionnel (Multi-step) -->
            <div class="form-container" id="professionalFormContainer">
                <!-- Progress Bar -->
                <div class="progress-container">
                    <div class="progress-bar" id="progressBar"></div>
                    <div class="steps">
                        <div class="step active" data-step="1">
                            <div class="step-circle">1</div>
                            <div class="step-label">Informations</div>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-circle">2</div>
                            <div class="step-label">Documents</div>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-circle">3</div>
                            <div class="step-label">Vérification</div>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Informations personnelles -->
                <div class="form-step active" id="step1">
                    <div class="form-header">
                        <h2><i class="fas fa-user-tie"></i> Informations Professionnelles</h2>
                        <p>Remplissez vos informations personnelles et professionnelles</p>
                    </div>
                    
                    <form class="step-form" id="professionalStep1Form">
                        <input type="hidden" name="user_type" value="professional">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="pro_fullname">
                                    <i class="fas fa-user"></i> Nom complet *
                                </label>
                                <input type="text" id="pro_fullname" name="fullname" required 
                                       value="<?= $isEdit ? htmlspecialchars($person['fullname']) : '' ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="pro_email">
                                    <i class="fas fa-envelope"></i> Email professionnel *
                                </label>
                                <input type="email" id="pro_email" name="email" required 
                                       value="<?= $isEdit ? htmlspecialchars($person['email']) : '' ?>">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="pro_phone">
                                    <i class="fas fa-phone"></i> Téléphone *
                                </label>
                                <input type="text" id="pro_phone" name="phone" required 
                                       value="<?= $isEdit ? $person['phone'] : '' ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="pro_experience">
                                    <i class="fas fa-briefcase"></i> Expérience (années) *
                                </label>
                                <input type="number" id="pro_experience" name="experience" required 
                                       min="0" value="<?= $isEdit ? $person['experience'] : '' ?>">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="pro_tarif">
                                    <i class="fas fa-money-bill-wave"></i> Tarif (MAD) *
                                </label>
                                <input type="number" id="pro_tarif" name="tarif" required 
                                       min="0" value="<?= $isEdit ? $person['tarif'] : '' ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="pro_ville_id">
                                    <i class="fas fa-city"></i> Ville *
                                </label>
                                <select id="pro_ville_id" name="ville_id" required>
                                    <option value="">Sélectionnez la ville</option>
                                    <!-- Les options seront chargées dynamiquement -->
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="pro_role">Type de professionnel *</label>
                            <select id="pro_role" name="role" required>
                                <option value="">Sélectionner</option>
                                <option value="avocat" <?= $personRole === 'avocat' ? 'selected' : '' ?>>Avocat</option>
                                <option value="huissier" <?= $personRole === 'huissier' ? 'selected' : '' ?>>Huissier</option>
                            </select>
                        </div>
                        
                        <!-- Champs spécifiques Avocat -->
                        <div id="avocatFields" style="display: none;">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="pro_speciality">Spécialité</label>
                                    <select id="pro_speciality" name="speciality">
                                        <option value="">---</option>
                                        <option value="Droit des affaires">Droit des affaires</option>
                                        <option value="Contentieux des affaires">Contentieux des affaires</option>
                                        <option value="Droit des droits humains">Droit des droits humains</option>
                                        <option value="Droit international">Droit international</option>
                                        <option value="Conseil juridique international">Conseil juridique international</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="pro_consultate_online">Consultation en ligne</label>
                                    <select id="pro_consultate_online" name="consultate_online">
                                        <option value="yes">Oui</option>
                                        <option value="no">Non</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Champs spécifiques Huissier -->
                        <div id="huissierFields" style="display: none;">
                            <div class="form-group">
                                <label for="pro_type_actes">Type d'actes</label>
                                <select id="pro_type_actes" name="type_actes">
                                    <option value="">---</option>
                                    <option value="signification">Signification</option>
                                    <option value="excecution">Exécution</option>
                                    <option value="constat">Constat</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="pro_bio">
                                <i class="fas fa-file-alt"></i> Biographie professionnelle
                            </label>
                            <textarea id="pro_bio" name="bio" rows="3" 
                                      placeholder="Décrivez votre parcours professionnel..."></textarea>
                        </div>
                    </form>
                    
                    <div class="step-buttons">
                        <button class="btn-next" onclick="nextStep(2)">
                            Suivant <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Documents -->
                <div class="form-step" id="step2">
                    <div class="form-header">
                        <h2><i class="fas fa-file-upload"></i> Documents Professionnels</h2>
                        <p>Téléchargez vos justificatifs pour vérification</p>
                    </div>
                    
                    <div class="documents-section">
                        <div class="document-upload">
                            <div class="upload-area" id="professionalCardUpload">
                                <i class="fas fa-id-card"></i>
                                <h4>Carte professionnelle</h4>
                                <p>Document officiel d'identification professionnelle</p>
                                <input type="file" id="professional_card" name="professional_card" accept=".pdf,.jpg,.png,.jpeg" hidden>
                                <button type="button" class="upload-btn" onclick="triggerFileInput('professional_card')">
                                    <i class="fas fa-upload"></i> Choisir un fichier
                                </button>
                                <div class="file-info" id="professionalCardInfo">Aucun fichier sélectionné</div>
                            </div>
                            
                            <div class="upload-area" id="diplomaUpload">
                                <i class="fas fa-graduation-cap"></i>
                                <h4>Diplômes et Certifications</h4>
                                <p>Vos diplômes et certifications professionnelles</p>
                                <input type="file" id="diplomas" name="diplomas[]" accept=".pdf,.jpg,.png,.jpeg" multiple hidden>
                                <button type="button" class="upload-btn" onclick="triggerFileInput('diplomas')">
                                    <i class="fas fa-upload"></i> Choisir des fichiers
                                </button>
                                <div class="file-info" id="diplomasInfo">Aucun fichier sélectionné</div>
                            </div>
                            
                            <div class="upload-area" id="idUpload">
                                <i class="fas fa-passport"></i>
                                <h4>Carte d'identité / Passeport</h4>
                                <p>Pièce d'identité officielle</p>
                                <input type="file" id="government_id" name="government_id" accept=".pdf,.jpg,.png,.jpeg" hidden>
                                <button type="button" class="upload-btn" onclick="triggerFileInput('government_id')">
                                    <i class="fas fa-upload"></i> Choisir un fichier
                                </button>
                                <div class="file-info" id="governmentIdInfo">Aucun fichier sélectionné</div>
                            </div>
                        </div>
                        
                        <div class="upload-requirements">
                            <h4><i class="fas fa-info-circle"></i> Exigences de téléchargement :</h4>
                            <ul>
                                <li>Taille maximale par fichier : 5MB</li>
                                <li>Formats acceptés : PDF, JPG, PNG</li>
                                <li>Les documents doivent être clairs et lisibles</li>
                                <li>Tous les documents seront vérifiés par notre équipe</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="step-buttons">
                        <button class="btn-prev" onclick="prevStep(1)">
                            <i class="fas fa-arrow-left"></i> Précédent
                        </button>
                        <button class="btn-next" onclick="nextStep(3)">
                            Suivant <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Vérification et Soumission -->
                <div class="form-step" id="step3">
                    <div class="form-header">
                        <h2><i class="fas fa-clipboard-check"></i> Vérification et Soumission</h2>
                        <p>Vérifiez vos informations avant soumission</p>
                    </div>
                    
                    <div class="review-section">
                        <div class="review-card">
                            <h3><i class="fas fa-user-tie"></i> Informations Personnelles</h3>
                            <div class="review-details">
                                <div class="review-item">
                                    <span>Nom complet :</span>
                                    <span id="reviewName">-</span>
                                </div>
                                <div class="review-item">
                                    <span>Email :</span>
                                    <span id="reviewEmail">-</span>
                                </div>
                                <div class="review-item">
                                    <span>Téléphone :</span>
                                    <span id="reviewPhone">-</span>
                                </div>
                                <div class="review-item">
                                    <span>Type de professionnel :</span>
                                    <span id="reviewRole">-</span>
                                </div>
                                <div class="review-item">
                                    <span>Expérience :</span>
                                    <span id="reviewExperience">-</span>
                                </div>
                                <div class="review-item">
                                    <span>Tarif :</span>
                                    <span id="reviewTarif">-</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="review-card">
                            <h3><i class="fas fa-file-alt"></i> Documents</h3>
                            <div class="review-details">
                                <div class="review-item">
                                    <span>Carte professionnelle :</span>
                                    <span id="reviewCard">Non téléchargé</span>
                                </div>
                                <div class="review-item">
                                    <span>Diplômes :</span>
                                    <span id="reviewDiplomas">Non téléchargés</span>
                                </div>
                                <div class="review-item">
                                    <span>Pièce d'identité :</span>
                                    <span id="reviewId">Non téléchargée</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="pro_terms" name="pro_terms" required>
                            <label for="pro_terms">
                                Je certifie que toutes les informations fournies sont exactes et j'accepte les 
                                <a href="#">Conditions d'utilisation</a> et la <a href="#">Politique de confidentialité</a>
                            </label>
                        </div>
                        
                        <div class="verification-notice">
                            <div class="notice-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="notice-content">
                                <h4>Processus de vérification</h4>
                                <p>Après soumission, votre demande sera examinée par notre équipe d'administration. 
                                Ce processus prend généralement 2-3 jours ouvrables. Vous recevrez une notification 
                                par email une fois votre compte approuvé.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="step-buttons">
                        <button class="btn-prev" onclick="prevStep(2)">
                            <i class="fas fa-arrow-left"></i> Précédent
                        </button>
                        <button type="button" class="submit-btn" onclick="submitProfessionalForm()">
                            <i class="fas fa-paper-plane"></i> Soumettre la demande
                        </button>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Section pour la gestion des données existantes (Add/Update) -->
        <div class="data-management-section" style="display: none;" id="dataManagementSection">
            <!-- Cette section peut être utilisée pour l'édition/ajout dynamique -->
        </div>
    </div>
    <script src="./script/script.js"></script>
</body>
</html>