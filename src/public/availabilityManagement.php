<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVAILABILITY - MANAGEMENT</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once "./navbar.php";
    ?>

    <div class="availability-page">
        <div class="availability-container">

            <h2>Set Availability</h2>

            <!-- FORM -->
            <form method="post" action="<?= $_ENV['base_url'] ?>/insertAvailability">
                <div class="availability-form-group">

                    <div>
                        <label for="day">Day</label>
                        <select id="day" name="day" class="availability-select" required>
                            <option value="">-- Choisir un jour --</option>
                            <option value="Lundi">lundi</option>
                            <option value="Mardi">mardi</option>
                            <option value="Mercredi">mercredi</option>
                            <option value="Jeudi">jeudi</option>
                            <option value="Vendredi">vendredi</option>
                            <option value="Samedi">samedi</option>
                            <option value="Dimanche">dimanche</option>
                        </select>

                    </div>

                    <div>
                        <label for="start_hour">Start Hour</label>
                        <select id="start_hour" name="start_hour" class="availability-select" required>
                            <option value="">--</option>
                            <?php
                            for ($h = 8; $h < 20; $h++) {
                                $hour = str_pad($h, 2, '0', STR_PAD_LEFT);
                                echo "<option value=\"$hour\">$hour</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="end_hour">End Hour</label>
                        <select id="end_hour" name="end_hour" class="availability-select" required>
                            <option value="">--</option>
                            <?php
                            for ($h = 9; $h < 21; $h++) {
                                $hour = str_pad($h, 2, '0', STR_PAD_LEFT);
                                echo "<option value=\"$hour\">$hour</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <button type="submit" class="availability-button">
                        Add Availability
                </button>

            </form>

            <!-- TABLE -->
            <h2 style="margin-top:40px;">Available Times</h2>

            <table class="availability-table">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Start Hour</th>
                        <th>End Hour</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($availabilities as $availability): ?>
                        <tr>
                            <td><?= $availability['jour'] ?></td>
                            <td><?= $availability['heure_debut'] ?></td>
                            <td><?= $availability['heure_fin'] ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-edit" type="button">Edit</button>
                                    <button class="btn-delete" type="button">Delete</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>

        </div>
    </div>

</body>

</html>