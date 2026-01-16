<?php
require_once "../Repository/villeRepository.php";

$villeRepo = new villeRepository();
$villes = $villeRepo->getAll();
$personRepo = new personRepository();



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un professionnel - ISTICHARA</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require_once "navbar.php"; ?>

    <div class="container">
        <h2>Ajouter un professionnel</h2>

        <form action="store" method="POST" id="dynamicForm">

            <label for="role">Type de professionnel:</label>
            <select id="role" name="role" required>
                <option value="">Sélectionner</option>
                <option value="avocat">Avocat</option>
                <option value="huissier">Huissier</option>
            </select>

            <div class="common-fields">
                <label>Nom complet:</label>
                <input type="text" name="fullname" value="<?= $persons['fullname'] ?? '' ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?= $persons['email'] ?? '' ?>" required>

                <label>Téléphone:</label>
                <input type="text" name="phone" value="<?= $persons['phone'] ?? '' ?>" required>

                <label>Expérience (en années):</label>
                <input type="number" name="experience" value="<?= $persons['experience'] ?? '' ?>" required min="0">

                <label>Tarif (MAD):</label>
                <input type="number" name="tarif" value="<?= $persons['tarif'] ?? '' ?>" required min="0">

                <label>Ville:</label>
                <select name="ville_id" required>
                    <option value="">Sélectionner la ville</option>
                    <?php foreach ($villes as $ville): ?>
                        <option value="<?= $ville['id'] ?>"><?= htmlspecialchars($ville['nom']) ?? '' ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="avocatFields" class="dynamic-fields" style="display:none;">
                <label>Spécialité:</label>
                <select name="speciality">
                    <option>Droit Pénal</option>
                    <option>Droit Civil</option>
                    <option>Droit Famille</option>
                    <option>Droit Affaires</option>
                </select>

                <label>Consultation en ligne:</label>
                <select name="consultate_online">
                    <option>yes</option>
                    <option>no</option>
                </select>
            </div>

            <!-- Huissier specific fields -->
            <div id="huissierFields" class="dynamic-fields" style="display:none;">
                <label>Type d'actes:</label>
                <select name="type_actes">
                    <option>signification</option>
                    <option>excecution</option>
                    <option>constat</option>
                </select>
            </div>

            <form action="update" method="POST">
                <input type="hidden" name="update_id" value="<?= $persons['id'] ?>">
                <button type="submit" name="delete" class="del"></button>
                <button type="submit" name="update" class="update btn"></button>
            </form>

        </form>
    </div>

    <?php require_once "footer.php"; ?>

    <script>
        const roleSelect = document.getElementById('role');
        const avocatFields = document.getElementById('avocatFields');
        const huissierFields = document.getElementById('huissierFields');

        roleSelect.addEventListener('change', () => {
            avocatFields.style.display = roleSelect.value === 'avocat' ? 'block' : 'none';
            huissierFields.style.display = roleSelect.value === 'huissier' ? 'block' : 'none';
        });

        // Burger menu
        const burger = document.querySelector('.burger');
        const nav = document.querySelector('.nav-links');
        if (burger && nav) {
            burger.addEventListener('click', () => {
                nav.classList.toggle('nav-active');
                burger.classList.toggle('toggle');
            });
        }
    </script>
</body>

</html>