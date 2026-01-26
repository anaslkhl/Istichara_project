<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Consultations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between">
        <div>
            <h2 class="text-2xl font-bold p-6 border-b border-slate-700">ISTICHARA</h2>

            <nav class="flex flex-col p-4 gap-2">
                <a href="professional_dashboard" class="hover:bg-slate-800 px-4 py-3 rounded-lg">📊 Statistiques</a>
                <a href="professional_reservation" class="hover:bg-slate-800 px-4 py-3 rounded-lg">📅 Reservations</a>
                <a href="professional_consultation" class="bg-slate-800 px-4 py-3 rounded-lg">💬 Consultations</a>
            </nav>
        </div>

        <div class="p-4">
            <a href="logout.php" class="block text-center bg-red-600 py-3 rounded-lg">🚪 Logout</a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8">

        <h1 class="text-3xl font-bold mb-6">💬 Consultations</h1>

        <div class="bg-white rounded-xl shadow p-6">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">Client</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Durée</th>
                        <th class="p-3">Statut</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
<?php if (!empty($consultations)): ?>
    <?php foreach ($consultations as $c): ?>

        <?php
        $duree = (strtotime($c['date_fin']) - strtotime($c['date_debut'])) / 60;
        ?>

        <tr class="border-b">

            <!-- CLIENT -->
            <td class="p-3">
                <?= htmlspecialchars($c['client_name']) ?>
            </td>

            <!-- DATE -->
            <td class="p-3">
                <?= htmlspecialchars($c['date_debut']) ?>
            </td>

            <!-- DUREE -->
            <td class="p-3">
                <?= $duree ?> min
            </td>

            <!-- STATUT -->
            <td class="p-3">
                <?php if ($c['statut'] === 'en_attente'): ?>
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                        En attente
                    </span>

                <?php elseif ($c['statut'] === 'valide'): ?>
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                        Validée
                    </span>

                <?php else: ?>
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                        Refusée
                    </span>
                <?php endif; ?>
            </td>

            <!-- ACTIONS -->
            <td class="p-3 text-center flex gap-2 justify-center">

                <?php if ($c['statut'] === 'en_attente'): ?>
                    <a href="/consultation/accept/<?= $c['id'] ?>"
                    class="bg-green-600 text-white px-3 py-1 rounded">
                    Accepter
                    </a>
                    <a href="/consultation/reject/<?= $c['id'] ?>"
                    class="bg-red-600 text-white px-3 py-1 rounded">
                    Refuser
                </a>


                <?php elseif ($c['statut'] === 'valide'): ?>
                    <a href="<?= htmlspecialchars($c['meeting_link']) ?>"
                       class="bg-blue-600 text-white px-3 py-1 rounded">
                        Rejoindre
                    </a>
                <?php else: ?>
                    —
                <?php endif; ?>

            </td>

        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5" class="text-center p-6 text-gray-400">
            Aucune consultation
        </td>
    </tr>
<?php endif; ?>
</tbody>

</html>
