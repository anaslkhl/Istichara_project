<?php

use Services\personService;

require_once "../autoload.php";

$service = new personService();


$totalAvocats   = $service->countByType('avocat');
$totalHuissiers = $service->countByType('huissier');

$byCity     = $service->getByCity();

$topAvocats = $service->topAvocats();

///statistique 

$total_houres_worked = $service->houres_worked();
$chiffres_affaires = $service->chiffre_afaires();
$total_unique_clients = $service->unique_clients();
$total_reservation = $service->total_reservation();
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
            <div class="dash-card dash-card-red">
                <p class="dash-card-label">Cumul des heures de travail effectuées</p>
                <p class="dash-card-value"><?= intval($total_houres_worked) ."h" . ($total_houres_worked-intval($total_houres_worked))*60 . "min" ?> </p>
            </div>
            <div class="dash-card dash-card-yellow">
                <p class="dash-card-label">Totale de chiffres D'affaires</p>
                <p class="dash-card-value"><?= intval($chiffres_affaires) . "Dh" ?> </p>
            </div>
            <div class="dash-card dash-card-dark">
                <p class="dash-card-label">Nombre de clients uniques</p>
                <p class="dash-card-value"><?= $total_unique_clients . " Clients" ?> </p>
            </div>
            <div class="dash-card dash-card-gold">
                <p class="dash-card-label">Nombre total de demandes reçues</p>
                <p class="dash-card-value"><?= $total_reservation . "Reservations reçues" ?> </p>
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