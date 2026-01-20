<?php




?>



<form action="/update" method="POST" id="dynamicForm">

    <input type="hidden" name="id" value="<?= $person['id'] ?>">

    <label>Type de professionnel:</label>
    <select id="role" name="role" required>
        <option value="avocat" <?= $person['speciality'] ? 'selected' : '' ?>>Avocat</option>
        <option value="huissier" <?= $person['type_actes'] ? 'selected' : '' ?>>Huissier</option>
    </select>

    <label>Nom complet:</label>
    <input type="text" name="fullname" value="<?= htmlspecialchars($person['fullname']) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($person['email']) ?>" required>

    <label>Téléphone:</label>
    <input type="text" name="phone" value="<?= $person['phone'] ?>" required>

    <label>Expérience:</label>
    <input type="number" name="experience" value="<?= $person['experience'] ?>" required>

    <label>Tarif:</label>
    <input type="number" name="tarif" value="<?= $person['tarif'] ?>" required>

    <label>Ville:</label>
    <select name="ville_id">
        <?php foreach ($villes as $ville): ?>
            <option value="<?= $ville['id'] ?>"
                <?= $ville['id'] == $person['ville_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($ville['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Avocat -->
    <div id="avocatFields" style="<?= $person['speciality'] ? 'display:block' : 'display:none' ?>">
        <label>Spécialité:</label>
        <select name="speciality">
            <option <?= $person['speciality']=='Droit Pénal'?'selected':'' ?>>Droit Pénal</option>
            <option <?= $person['speciality']=='Droit Civil'?'selected':'' ?>>Droit Civil</option>
            <option <?= $person['speciality']=='Droit Famille'?'selected':'' ?>>Droit Famille</option>
            <option <?= $person['speciality']=='Droit Affaires'?'selected':'' ?>>Droit Affaires</option>
        </select>

        <label>Consultation en ligne:</label>
        <select name="consultate_online">
            <option value="yes" <?= $person['consultate_online']=='yes'?'selected':'' ?>>Yes</option>
            <option value="no" <?= $person['consultate_online']=='no'?'selected':'' ?>>No</option>
        </select>
    </div>

    <!-- Huissier -->
    <div id="huissierFields" style="<?= $person['type_actes'] ? 'display:block' : 'display:none' ?>">
        <label>Type d'actes:</label>
        <select name="type_actes">
            <option <?= $person['type_actes']=='signification'?'selected':'' ?>>signification</option>
            <option <?= $person['type_actes']=='excecution'?'selected':'' ?>>excecution</option>
            <option <?= $person['type_actes']=='constat'?'selected':'' ?>>constat</option>
        </select>
    </div>

    <button type="submit" class="btn update">Update</button>
</form>
