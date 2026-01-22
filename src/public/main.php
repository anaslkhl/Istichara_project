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
    <?php require_once "./navbar.php"; ?>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <h1>Bienvenue sur ISTICHARA</h1>
            <p>Accédez rapidement aux avocats et huissiers qualifiés au Maroc</p>
            <a href="<?= $_ENV['base_url'] ?>/professionals" class="btn">Rechercher un professionnel</a>
        </div>
    </header>

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


</body>

</html>