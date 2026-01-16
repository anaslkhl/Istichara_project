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

    <?php require_once "./navbar.php";
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
                            <?= ($person['speciality']) ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <p><strong>Spécialité:</strong> <?= htmlspecialchars($person['speciality'] ?? $person['type_actes']) ?></p>
                        <p><strong>Expérience:</strong> <?= htmlspecialchars($person['experience']) ?> ans</p>
                        <p><strong>Tarif:</strong> <?= htmlspecialchars($person['tarif']) ?> MAD</p>
                        <?php if (!empty($person['consultate_online'])): ?>
                            <p><strong>Consultation en ligne:</strong> <?= ucfirst($person['consultate_online']) ?></p>
                        <?php endif; ?>
                    </div>
                    <form class="card-footer" method="POST" action="delete">
                        <input type="hidden" name="delete" value="<?= htmlentities($person['id']) ?>">
                        <button type="submit" for="delete" class="del">Delete</button>
                        <a href="/person/<?= $person['id'] ?>" class="btn-view">Edit</a>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>


        <!-- Pagination -->
        <div class="pagination">
            <a href="#">«</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">»</a>
        </div>
    </div>

    <!-- Footer -->

    <?php require_once "./footer.php"; ?>

    <script>
        // Burger menu toggle
        const burger = document.querySelector('.burger');
        const nav = document.querySelector('.nav-links');
        burger.addEventListener('click', () => {
            nav.classList.toggle('nav-active');
            burger.classList.toggle('toggle');
        });
    </script>

    <script src="./script//script.js"></script>
</body>

</html>