<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ISTICHARA</title>
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
                <li><a href="admin.html" class="active">Admin</a></li>
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
        <h2>Dashboard Administrateur</h2>

        <!-- Statistics -->
        <div class="stats">
            <div class="stat-card">
                <h3>Avocats</h3>
                <p>120</p>
            </div>
            <div class="stat-card">
                <h3>Huissiers</h3>
                <p>45</p>
            </div>
        </div>

        <!-- Tables -->
        <h3>Top 3 Avocats par expérience</h3>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Années d'expérience</th>
                    <th>Spécialité</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mehdi El Khadir</td>
                    <td>15</td>
                    <td>Droit Civil</td>
                </tr>
                <tr>
                    <td>Sofia Benali</td>
                    <td>12</td>
                    <td>Droit Famille</td>
                </tr>
                <tr>
                    <td>Rachid Ziani</td>
                    <td>10</td>
                    <td>Droit Pénal</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2026 ISTICHARA. Tous droits réservés.</p>
            <p>Contact: contact@istichara.ma</p>
        </div>
    </footer>

    <script>
        const burger = document.querySelector('.burger');
        const nav = document.querySelector('.nav-links');
        burger.addEventListener('click', () => {
            nav.classList.toggle('nav-active');
            burger.classList.toggle('toggle');
        });
    </script>
</body>
</html>
