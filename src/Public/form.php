<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un professionnel - ISTICHARA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="logo">ISTICHARA</a>
            <ul class="nav-links">
                <li><a href="index.html">Accueil</a></li>
                <li><a href="professionals.html">Professionnels</a></li>
                <li><a href="admin.html">Admin</a></li>
                <li><a href="form.html" class="active">Ajouter</a></li>
            </ul>
            <div class="burger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Ajouter un professionnel</h2>

        <form id="dynamicForm">
            <label for="role">Type de professionnel:</label>
            <select id="role">
                <option value="">Sélectionner</option>
                <option value="avocat">Avocat</option>
                <option value="huissier">Huissier</option>
            </select>

            <div class="common-fields">
                <label>Nom:</label>
                <input type="text" name="name" required>

                <label>Ville:</label>
                <input type="text" name="city" required>
            </div>

            <div id="avocatFields" class="dynamic-fields">
                <label>Spécialité:</label>
                <select name="speciality">
                    <option>Droit Pénal</option>
                    <option>Droit Civil</option>
                    <option>Droit Famille</option>
                    <option>Droit Affaires</option>
                </select>

                <label>Consultation en ligne:</label>
                <select name="online">
                    <option>Oui</option>
                    <option>Non</option>
                </select>
            </div>

            <div id="huissierFields" class="dynamic-fields">
                <label>Type d'actes:</label>
                <select name="actType">
                    <option>Signification</option>
                    <option>Exécution</option>
                    <option>Constats</option>
                </select>
            </div>

            <button type="submit" class="btn">Ajouter</button>
        </form>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2026 ISTICHARA. Tous droits réservés.</p>
            <p>Contact: contact@istichara.ma</p>
        </div>
    </footer>

    <script>
        const roleSelect = document.getElementById('role');
        const avocatFields = document.getElementById('avocatFields');
        const huissierFields = document.getElementById('huissierFields');

        roleSelect.addEventListener('change', () => {
            avocatFields.style.display = roleSelect.value === 'avocat' ? 'block' : 'none';
            huissierFields.style.display = roleSelect.value === 'huissier' ? 'block' : 'none';
        });

        // Burger menu
        const burger = document.querySelector('.burger');
        const nav = document.querySelector('.nav-links');
        burger.addEventListener('click', () => {
            nav.classList.toggle('nav-active');
            burger.classList.toggle('toggle');
        });
    </script>
</body>
</html>
