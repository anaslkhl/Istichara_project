<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        
        <?php require_once "navbar.php"; ?>

    </header>

    <!-- DASHBOARD -->
    <main class="dash-wrapper">

        <h1 class="dash-title">📊 Professional Dashboard</h1>

        <!-- STAT CARDS -->
        <section class="dash-cards">

            <div class="dash-card dash-card-blue">
                <p class="label">Total Consultations</p>
                <p class="value">120</p>
            </div>

            <div class="dash-card dash-card-green">
                <p class="label">Heures travaillées</p>
                <p class="value">86h 30min</p>
            </div>

            <div class="dash-card dash-card-yellow">
                <p class="label">Chiffre d'affaires</p>
                <p class="value">14 500 DH</p>
            </div>

            <div class="dash-card dash-card-red">
                <p class="label">Demandes en attente</p>
                <p class="value">7</p>
            </div>

        </section>

        <!-- RESERVATIONS TABLE -->
        <section class="dash-section">
            <h2 class="dash-subtitle">Dernières réservations</h2>

            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ahmed Benali</td>
                        <td>2026-01-20</td>
                        <td>10:30</td>
                        <td class="status done">Confirmée</td>
                    </tr>
                    <tr>
                        <td>Salma Idrissi</td>
                        <td>2026-01-21</td>
                        <td>14:00</td>
                        <td class="status pending">En attente</td>
                    </tr>
                    <tr>
                        <td>Youssef Karim</td>
                        <td>2026-01-22</td>
                        <td>09:00</td>
                        <td class="status canceled">Annulée</td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

    <!-- FOOTER -->

    <?php require_once "footer.php"; ?>


</body>

</html>