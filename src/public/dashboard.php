<?php

use Services\personService;

require_once "../autoload.php";

$service = new personService();

$totalAvocats   = $service->countByType('avocat');
$totalHuissiers = $service->countByType('huissier');

$byCity     = $service->getByCity();

$topAvocats = $service->topAvocats();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | ISTICHARA</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once "navbar.php"; ?>

    <div class="dash-wrapper">

        <h1 class="dash-title">📊 Statistiques ISTICHARA</h1>

        <!-- STAT CARDS -->
        <div class="dash-cards">
            <div class="dash-card dash-card-blue">
                <p class="dash-card-label">Avocats</p>
                <p class="dash-card-value"><?= $totalAvocats ?></p>
            </div>

            <div class="dash-card dash-card-green">
                <p class="dash-card-label">Huissiers</p>
                <p class="dash-card-value"><?= $totalHuissiers ?></p>
            </div>
        </div>

        <!-- BY CITY -->
        <div class="dash-section">
            <h2 class="dash-subtitle">Professionnels par ville</h2>
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Ville</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($byCity as $city => $value): ?>
                        <tr>
                            <td><?= htmlspecialchars($city) ?></td>
                            <td><?= $value ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- TOP AVOCATS -->
        <div class="dash-section">
            <h2 class="dash-subtitle">Top 3 Avocats (Expérience)</h2>
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Expérience (ans)</th>
                        <th>Spécialité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($topAvocats as $avocat): ?>
                        <tr>
                            <td><?= htmlspecialchars($avocat['fullname']) ?></td>
                            <td><?= $avocat['experience'] ?></td>
                            <td><?= htmlspecialchars($avocat['speciality']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php require_once "footer.php"; ?>

</body>

</html>