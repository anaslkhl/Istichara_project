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
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="logo">ISTICHARA</a>
            <ul class="nav-links">
                <li><a href="index.html">Accueil</a></li>
                <li><a href="professionals.html" class="active">Professionnels</a></li>
                <li><a href="admin.html">Admin</a></li>
                <li><a href="form.html">Ajouter</a></li>
            </ul>
            <div class="burger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Liste des professionnels</h2>

        <!-- Filters -->
        <div class="filters">
            <input type="text" placeholder="Recherche par nom..." id="searchName">
            <select id="filterType">
                <option value="">Tous</option>
                <option value="avocat">Avocat</option>
                <option value="huissier">Huissier</option>
            </select>
        </div>

        <!-- Cards -->
        <div class="cards">
            <div class="card">
                <h3>Mehdi El Khadir</h3>
                <p>Avocat - Droit Civil</p>
                <p>10 ans d'expérience</p>
                <p>Tarif horaire: 500 MAD</p>
                <p>Consultation en ligne: Oui</p>
            </div>
            <div class="card">
                <h3>Youssef Benali</h3>
                <p>Huissier - Signification</p>
                <p>5 ans d'expérience</p>
                <p>Tarif horaire: 400 MAD</p>
            </div>
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
    <footer>
        <div class="container">
            <p>&copy; 2026 ISTICHARA. Tous droits réservés.</p>
            <p>Contact: contact@istichara.ma</p>
        </div>
    </footer>

    <script>
        // Burger menu toggle
        const burger = document.querySelector('.burger');
        const nav = document.querySelector('.nav-links');
        burger.addEventListener('click', () => {
            nav.classList.toggle('nav-active');
            burger.classList.toggle('toggle');
        });
    </script>
</body>
</html>
