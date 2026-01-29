<?php
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . "/layout/app.php";
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professionnels ISTICHARA</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar -->

    <?php

    use Services\personService;

    $person = new personService();
    $persons = $person->getAll();

    ?>

    <div class="container">
        <h2>Liste des professionnels</h2>

        <!-- Filters -->
        <form method="GET" class="filters">
            <input type="hidden" name="id">
            <input type="text" id="searching" name="search" placeholder="Recherche par nom..."
                value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">

            <select name="type">
                <option value="">Tous</option>
                <option value="avocat" <?= (isset($_GET['type']) && $_GET['type'] == 'Avocat') ? 'selected' : '' ?>>Avocat</option>
                <option value="huissier" <?= (isset($_GET['type']) && $_GET['type'] == 'Huissier') ? 'selected' : '' ?>>Huissier</option>
            </select>

            <button type="submit" class="btn">Filtrer</button>
        </form>


        <!-- Cards -->
        <div class="cards">
            <?php foreach ($persons as $person): ?>
                <div class="card">
                    <div class="card-header">
                        <h3><?= htmlspecialchars($person['fullname']) ?></h3>
                        <span class="role-badge">
                            <?= ($person['role']) ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <p><strong>Spécialité:</strong> <?= ($person['speciality'] ?? $person['type_actes']) ?></p>
                        <p><strong>Expérience:</strong> <?= htmlspecialchars($person['experience']) ?> ans</p>
                        <p><strong>Tarif:</strong> <?= htmlspecialchars($person['tarif']) ?> MAD</p>
                        <?php if (!empty($person['consultate_online'])): ?>
                            <p><strong>Consultation en ligne:</strong> <?= ucfirst($person['consultate_online']) ?></p>
                        <?php endif; ?>
                    </div>
                    <form class="card-footer" method="POST" action="">
                        <input type="hidden" name="delete" value="<?= htmlentities($person['id']) ?>">
                        <button type="button" class="del" onclick="openEditModal()">Reserver</button>
                        <a href="/showprofile?id=<?= $person['id'] ?>" class="btn-profile">View</a>
                    </form>

                </div>
            <?php endforeach; ?>
        </div>

        <div id="editModal" class="availability-modal" style="display: none;">
            <div class="availability-modal-contentt">
                <h3>Reservation</h3>
                <form class="form-pro" method="post" action="<?= $_ENV['base_url'] ?>/addReservation">
                    <input type="hidden" name="professional_id" id="modal_professional_id">
                    <div class="availability-form-group">
                        <div>
                            <label>Jour</label>
                            <select id="edit_day" name="jour" class="availability-select" required>
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
                            <select id="edit_start" name="heure_debut" class="availability-select" required>
                                <?php for ($h = 8; $h < 20; $h++):
                                    $hour = str_pad($h, 2, '0', STR_PAD_LEFT); ?>
                                    <option value="<?= $hour ?>"><?= $hour ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div>
                            <label>Heure de fin</label>
                            <select id="edit_end" name="heure_fin" class="availability-select" required>
                                <?php for ($h = 9; $h < 21; $h++):
                                    $hour = str_pad($h, 2, '0', STR_PAD_LEFT); ?>
                                    <option value="<?= $hour ?>"><?= $hour ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-actions">
                        <button type="button" class="availability-button" onclick="closeEditModal()"  style="background-color:orange;padding:3px">Annuler</button>
                        <button type="submit" class="availability-button" style="background-color:aquamarine;padding:3px">Reserver</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="pagination">
            <a href="#">«</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">»</a>
        </div>
    </div>


    <?php require_once "./footer.php"; ?>

    <script>
        // // Burger menu toggle
        // const burger = document.querySelector('.burger');
        // const nav = document.querySelector('.nav-links');
        // burger.addEventListener('click', () => {
        //     nav.classList.toggle('nav-active');
        //     burger.classList.toggle('toggle');
        // });

        function openEditModal(professionalId) {
            document.getElementById('modal_professional_id').value = professionalId;
            document.getElementById('editModal').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Close modal on clicking outside the modal content
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                closeEditModal();
            }
        };
    </script>

    <script src="./script//script.js"></script>
</body>

</html>