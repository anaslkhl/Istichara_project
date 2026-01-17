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
    <title><?= $title ?> - ISTICHARA</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php require_once "navbar.php"; ?>

    <div class="container">
        <h2><?= $title ?></h2>

        <form action="<?= $action ?>" method="POST" id="dynamicForm">

            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $person['id'] ?>">
            <?php endif; ?>

            <label>Type de professionnel:</label>
            <select id="role" name="role" required>
                <option value="">Sélectionner</option>
                <option value="avocat" <?= $personRole === 'avocat' ? 'selected' : '' ?>>Avocat</option>
                <option value="huissier" <?= $personRole === 'huissier' ? 'selected' : '' ?>>Huissier</option>

            </select>

            <label>Nom complet:</label>
            <input type="text" name="fullname" value="<?= $isEdit ? htmlspecialchars($person['fullname']) : '' ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= $isEdit ? htmlspecialchars($person['email']) : '' ?>" required>

            <label>Téléphone:</label>
            <input type="text" name="phone" value="<?= $isEdit ? $person['phone'] : '' ?>" required>

            <label>Expérience (en années):</label>
            <input type="number" name="experience" value="<?= $isEdit ? $person['experience'] : '' ?>" required min="0">

            <label>Tarif (MAD):</label>
            <input type="number" name="tarif" value="<?= $isEdit ? $person['tarif'] : '' ?>" required min="0">

            <label>Ville:</label>
            <select name="ville_id" required>
                <option value="">Sélectionner la ville</option>
                <?php foreach ($villes as $ville): ?>
                    <option value="<?= $ville['id'] ?>" <?= $isEdit && $person['ville_id'] == $ville['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ville['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div id="avocatFields" style="<?= $personRole === 'avocat' ? 'display:block' : 'display:none' ?>">
                <label>Spécialité:</label>
                <select name="speciality">
                    <option value="">---</option>
                    <option value="Droit des affaires" <?= $isEdit && $person['speciality'] === 'Droit des affaires' ? 'selected' : '' ?>>Droit des affaires</option>
                    <option value="Contentieux des affaires" <?= $isEdit && $person['speciality'] === 'Contentieux des affaires' ? 'selected' : '' ?>>Contentieux des affaires</option>
                    <option value="Droit des droits humains" <?= $isEdit && $person['speciality'] === 'Droit des droits humains' ? 'selected' : '' ?>>Droit des droits humains</option>
                    <option value="Droit international" <?= $isEdit && $person['speciality'] === 'Droit international' ? 'selected' : '' ?>>Droit international</option>
                    <option value="Conseil juridique international" <?= $isEdit && $person['speciality'] === 'Conseil juridique international' ? 'selected' : '' ?>>Conseil juridique international</option>
                </select>

                <label>Consultation en ligne:</label>
                <select name="consultate_online">
                    <option value="yes" <?= $isEdit && $person['consultate_online'] === 'yes' ? 'selected' : '' ?>>Yes</option>
                    <option value="no" <?= $isEdit && $person['consultate_online'] === 'no' ? 'selected' : '' ?>>No</option>
                </select>
            </div>

            <div id="huissierFields" style="<?= $personRole === 'huissier' ? 'display:block' : 'display:none' ?>">
                <label>Type d'actes:</label>
                <select name="type_actes">
                    <option value="">---</option>
                    <option value="signification" <?= $isEdit && $person['type_actes'] === 'signification' ? 'selected' : '' ?>>signification</option>
                    <option value="excecution" <?= $isEdit && $person['type_actes'] === 'excecution' ? 'selected' : '' ?>>excecution</option>
                    <option value="constat" <?= $isEdit && $person['type_actes'] === 'constat' ? 'selected' : '' ?>>constat</option>
                </select>
            </div>

            <button type="submit" class="btn"><?= $isEdit ? 'update' : 'create' ?></button>
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