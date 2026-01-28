<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVAILABILITY - MANAGEMENT</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="availability-layout">
        <aside class="availability-sidebar">
            <div>
                <h2 class="availability-logo">ISTICHARA</h2>

                <nav class="availability-nav">
                    <a href="professional_dashboard">📊 Statistiques</a>
                    <a href="availability" class="active">🕒 Availability</a>
                    <a href="reservations">📅 Reservations</a>
                    <a href="professional_consultation">💬 Consultations</a>
                </nav>
            </div>

            <div class="availability-logout">
                <a href="logout.php">🚪 Logout</a>
            </div>
        </aside>

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
                                <option value="lundi">lundi</option>
                                <option value="mardi">mardi</option>
                                <option value="mercredi">mercredi</option>
                                <option value="jeudi">jeudi</option>
                                <option value="vendredi">vendredi</option>
                                <option value="samedi">samedi</option>
                                <option value="dimanche">dimanche</option>
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
                                <td><?= $availability['heure_debut'] ?>h</td>
                                <td><?= $availability['heure_fin'] ?>h</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-edit" type="button" onclick="openEditModal('<?= $availability['id'] ?>', '<?= $availability['jour'] ?>','<?= $availability['heure_debut'] ?>','<?= $availability['heure_fin'] ?>')">Edit</button>
                                        <a href="<?= $_ENV['base_url'] ?>/deleteAvailability?rowId=<?= $availability['id'] ?>"><button class="btn-delete" type="button">Delete</button></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;
                        ?>
                    </tbody>
                </table>

            </div>
            <!-- EDIT MODAL -->
            <div id="editModal" class="availability-modal">
                <div class="availability-modal-content">
                    <h3>Modifier la disponibilité</h3>

                    <form method="post" action="<?= $_ENV['base_url'] ?>/updateAvailability">
                        <div class="availability-form-group">

                            <!-- for the row id -->
                            <input type="hidden" name="rowId" id="edit_row_id">

                            <div>
                                <label>Jour</label>
                                <select id="edit_day" name="new_day" class="availability-select" required>
                                    <option value="lundi">lundi</option>
                                    <option value="mardi">mardi</option>
                                    <option value="mercredi">mercredi</option>
                                    <option value="jeudi">jeudi</option>
                                    <option value="vendredi">vendredi</option>
                                    <option value="samedi">samedi</option>
                                    <option value="dimanche">dimanche</option>
                                </select>
                            </div>

                            <div>
                                <label>Heure de début</label>
                                <select id="edit_start" name="new_start_hour" class="availability-select" required>
                                    <?php
                                    for ($h = 8; $h < 20; $h++) {
                                        $hour = str_pad($h, 2, '0', STR_PAD_LEFT);
                                        echo "<option value=\"$hour\">$hour</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div>
                                <label>Heure de fin</label required>
                                <select id="edit_end" name="new_end_hour" class="availability-select">
                                    <?php
                                    for ($h = 9; $h < 21; $h++) {
                                        $hour = str_pad($h, 2, '0', STR_PAD_LEFT);
                                        echo "<option value=\"$hour\">$hour</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>

                        <div class="modal-actions">
                            <button type="button" class="availability-button" onclick="closeEditModal()">Annuler</button>
                            <button type="submit" class="availability-button">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>


        <script>
            function openEditModal(id, day, start, end) {
                document.getElementById('edit_row_id').value = id;
                document.getElementById('edit_day').value = day;
                document.getElementById('edit_start').value = start.substring(0, 2);
                document.getElementById('edit_end').value = end.substring(0, 2);

                document.getElementById('editModal').style.display = 'flex';
            }


            function closeEditModal() {
                document.getElementById('editModal').style.display = 'none';
            }
        </script>
    </div>
</body>

</html>