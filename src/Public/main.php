<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISTICHARA - Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="logo">ISTICHARA</a>
            <ul class="nav-links">
                <li><a href="index.html">Accueil</a></li>
                <li><a href="professionals.html">Professionnels</a></li>
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

    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <h1>Bienvenue sur ISTICHARA</h1>
            <p>Accédez rapidement aux avocats et huissiers qualifiés au Maroc</p>
            <a href="professionals.html" class="btn">Rechercher un professionnel</a>
        </div>
    </header>

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
