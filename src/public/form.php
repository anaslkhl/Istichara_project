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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Header -->
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

        <main class="main-content">
            <!-- Client Form -->
            <div class="form-container active" id="clientFormContainer">
                <div class="form-header">
                    <h2><i class="fas fa-user-plus"></i> Inscription Client</h2>
                    <p>Créez votre compte pour accéder aux services juridiques</p>
                </div>
                <form action="/store" method="POST" id="clientForm" class="registration-form">
                    <input type="hidden" name="role" value="client">
                    <div class="row">
                        <div class="form-group">
                            <i class="fas fa-user"></i> Role : <i class="fa-user" id="faa">Client</i>
                        </div>
                        <div class="form-group">
                            <label for="client_fullname"><i class="fas fa-user"></i> Nom complet</label>
                            <input type="text" id="client_fullname" name="fullname" required placeholder="Votre nom complet">
                        </div>
                        <div class="form-group">
                            <label for="client_email"><i class="fas fa-envelope"></i> Email Address</label>
                            <input type="email" id="client_email" name="email" required placeholder="votre@email.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="client_phone"><i class="fas fa-phone"></i> Téléphone</label>
                        <input type="text" id="client_phone" name="phone" required placeholder="Votre numéro de téléphone">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="client_password"><i class="fas fa-lock"></i> Mot de passe</label>
                            <div class="password-input">
                                <input type="password" id="client_password" name="password" required placeholder="Créez un mot de passe">
                                <button type="button" class="password-toggle"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client_confirm_password"><i class="fas fa-lock"></i> Confirmer le mot de passe</label>
                            <input type="password" id="client_confirm_password" name="confirm_password" required placeholder="Confirmez le mot de passe">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="client_ville_id"><i class="fas fa-city"></i> Ville</label>
                        <select id="client_ville_id" name="ville_id" required>
                            <option value="">Sélectionnez votre ville</option>
                            <?php foreach ($villes as $ville): ?>
                                <option value=" <?= htmlentities($ville['id']) ?>"><?= htmlspecialchars($ville['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="client_terms" name="terms" required>
                        <label for="client_terms">J'accepte les <a href="#">Conditions d'utilisation</a> et la <a href="#">Politique de confidentialité</a></label>
                    </div>
                    <button type="submit" class="submit-btn" name="client-btn"><i class="fas fa-user-check"></i> Créer mon compte</button>
                </form>
                <div class="form-group">
                    <p>Déjà inscrit ?</p>
                    <button type="button" class="loginToggleBtn login-toggle-btn">Se connecter</button>
                </div>
            </div>

            <!-- Professional Form -->
            <div class="form-container" id="professionalFormContainer">
                <form id="professionalForm" method="POST" action="/store" enctype="multipart/form-data">
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

                    <!-- Step 1: Informations -->
                    <div class="form-step active" id="step1">
                        <div class="form-header">
                            <h2><i class="fas fa-user-tie"></i> Informations Professionnelles</h2>
                            <p>Remplissez vos informations personnelles et professionnelles</p>
                        </div>

                        <!-- <div class="form-group">
                            <label for="pro_type">Role *</label>
                            <select id="pro_type" name="role" required>
                                <option value="">Sélectionner</option>
                                <option value="admin" <?= $personRole === 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="client" <?= $personRole === 'client' ? 'selected' : '' ?>>Client</option>
                                <option value="avocat" <?= $personRole === 'avocat' ? 'selected' : '' ?>>Avocat</option>
                                <option value="huissier" <?= $personRole === 'huisser' ? 'selected' : '' ?>>Huisser</option>
                            </select>
                        </div> -->


                        <div class="form-row">
                            <div class="form-group">
                                <label for="pro_fullname"><i class="fas fa-user"></i> Nom complet *</label>
                                <input type="text" id="pro_fullname" name="fullname" required value="<?= $isEdit ? htmlspecialchars($person['fullname']) : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="pro_email"><i class="fas fa-envelope"></i> Email professionnel *</label>
                                <input type="email" id="pro_email" name="email" required value="<?= $isEdit ? htmlspecialchars($person['email']) : '' ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="client_password"><i class="fas fa-lock"></i> Mot de passe</label>
                                <div class="password-input">
                                    <input type="password" id="client_password" name="password" required placeholder="Créez un mot de passe">
                                    <button type="button" class="password-toggle"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="client_confirm_password"><i class="fas fa-lock"></i> Confirmer le mot de passe</label>
                                <input type="password" id="client_confirm_password" name="confirm_password" required placeholder="Confirmez le mot de passe">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="pro_phone"><i class="fas fa-phone"></i> Téléphone *</label>
                                <input type="text" id="pro_phone" name="phone" required value="<?= $isEdit ? $person['phone'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="pro_experience"><i class="fas fa-briefcase"></i> Expérience (années) *</label>
                                <input type="number" id="pro_experience" name="experience" required min="0" value="<?= $isEdit ? $person['experience'] : '' ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="pro_tarif"><i class="fas fa-money-bill-wave"></i> Tarif (MAD) *</label>
                                <input type="number" id="pro_tarif" name="tarif" required min="0" value="<?= $isEdit ? $person['tarif'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="pro_ville_id"><i class="fas fa-city"></i> Ville *</label>
                                <select id="pro_ville_id" name="ville_id" required>
                                    <?php foreach ($villes as $ville): var_dump($ville) ?>
                                        <option value=" <?= htmlentities($ville['id']) ?>"><?= htmlspecialchars($ville['nom']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pro_role">Type de professionnel *</label>
                            <select id="pro_role" name="role" required>
                                <option value="">Sélectionner</option>
                                <option value="avocat" <?= $personRole === 'avocat' ? 'selected' : '' ?>>Avocat</option>
                                <option value="huisser" <?= $personRole === 'huissier' ? 'selected' : '' ?>>Huissier</option>
                                <option value="admin" <?= $personRole === 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="client" <?= $personRole === 'client' ? 'selected' : '' ?>>Client</option>

                            </select>
                        </div>

                        <!-- Avocat Fields -->
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

                        <!-- Huissier Fields -->
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

                        <!-- Step 1 Buttons -->
                        <div class="step-buttons">
                            <button type="button" class="btn-next">Suivant <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Documents -->
                    <div class="form-step" id="step2">
                        <div class="form-header">
                            <h2><i class="fas fa-file-upload"></i> Documents Professionnels</h2>
                            <p>Téléchargez vos justificatifs pour vérification</p>
                        </div>
                        <div class="documents-section">
                            <div class="document-upload upload-area">
                                <h2>File Upload</h2>
                                <input type="file" name="uploadfile" required>
                                <!-- Remove the separate submit button here; Step 3 final submit will handle it -->
                            </div>
                        </div>
                        <!-- Step 2 Buttons -->
                        <div class="step-buttons">
                            <button type="button" class="btn-prev"><i class="fas fa-arrow-left"></i> Précédent</button>
                            <button type="button" class="btn-next">Suivant <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                    <!-- Step 2 Buttons -->
                    <div class="step-buttons">
                        <button type="button" class="btn-prev"><i class="fas fa-arrow-left"></i> Précédent</button>
                        <button type="button" class="btn-next">Suivant <i class="fas fa-arrow-right"></i></button>
                    </div>
            </div>

            <!-- Step 3: Vérification -->
            <div class="form-step" id="step3">
                <div class="form-header">
                    <h2><i class="fas fa-clipboard-check"></i> Vérification et Soumission</h2>
                    <p>Vérifiez vos informations avant soumission</p>
                </div>
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="pro_terms" name="pro_terms" required>
                    <label for="pro_terms">
                        Je certifie que toutes les informations fournies sont exactes et j'accepte les
                        <a href="#">Conditions d'utilisation</a> et la <a href="#">Politique de confidentialité</a>
                    </label>
                </div>
                <div class="step-buttons">
                    <button class="btn-prev" type="button"><i class="fas fa-arrow-left"></i> Précédent</button>
                    <button type="submit" id="submitbtn" class="submit-btn"><i class="fas fa-paper-plane"></i> Soumettre la demande</button>
                </div>
            </div>
            </form>
    </div>

    <!-- Login Form -->
    <div class="login-form-container">
        <div class="form-header">
            <h2><i class="fas fa-sign-in-alt"></i> Se Connecter</h2>
            <p>Accédez à votre compte ISTICHARA</p>
        </div>
        <form id="loginForm" class="login-form" action="/login" method="POST">
            <div class="form-group">
                <label for="login_email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" id="login_email" name="email" required placeholder="votre@email.com">
            </div>
            <div class="form-group">
                <label for="login_password"><i class="fas fa-lock"></i> Mot de passe</label>
                <div class="password-input">
                    <input type="password" id="login_password" name="password" required placeholder="Votre mot de passe">
                    <button type="button" class="password-toggle"><i class="fas fa-eye"></i></button>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    <label for="remember_me">Se souvenir de moi</label>
                </div>
                <div class="form-group">
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </button>
            </div>
        </form>
    </div>
    </main>
    </div>

    <script src="./script/script.js"></script>
</body>

</html>