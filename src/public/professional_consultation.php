<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Dashboard - Consultations</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR (SAME) -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between">
        <div>
            <h2 class="text-2xl font-bold p-6 border-b border-slate-700">
                ISTICHARA
            </h2>

            <nav class="flex flex-col p-4 gap-2">
                <a href="professional_dashboared" class="hover:bg-slate-800 px-4 py-3 rounded-lg">
                    📊 Statistiques
                </a>
                <a href="professional_reservation" class="hover:bg-slate-800 px-4 py-3 rounded-lg">
                    📅 Reservations
                </a>
                <a href="" class="bg-slate-800 px-4 py-3 rounded-lg">
                    💬 Consultations
                </a>
            </nav>
        </div>

        <div class="p-4">
            <a href="logout.php"
               class="block text-center bg-red-600 hover:bg-red-700 py-3 rounded-lg font-semibold">
                🚪 Logout
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

        <main class="p-8">

            <!-- PAGE HEADER -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold">💬 Consultations</h1>

                <!-- FILTER -->
                <select class="border rounded-lg px-4 py-2">
                    <option>Toutes</option>
                    <option>En cours</option>
                    <option>Terminée</option>
                    <option>Annulée</option>
                </select>
            </div>

            <!-- CONSULTATIONS TABLE -->
            <div class="bg-white rounded-xl shadow p-6">

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600">
                                <th class="p-3">Client</th>
                                <th class="p-3">Sujet</th>
                                <th class="p-3">Date</th>
                                <th class="p-3">Durée</th>
                                <th class="p-3">Statut</th>
                                <th class="p-3 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="border-b">
                                <td class="p-3">Ahmed Benali</td>
                                <td class="p-3">Conseil juridique</td>
                                <td class="p-3">2026-01-20</td>
                                <td class="p-3">45 min</td>
                                <td class="p-3">
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                        En cours
                                    </span>
                                </td>
                                <td class="p-3 flex gap-2 justify-center">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                        Rejoindre
                                    </button>
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                        Clôturer
                                    </button>
                                </td>
                            </tr>

                            <tr class="border-b">
                                <td class="p-3">Salma Idrissi</td>
                                <td class="p-3">Rédaction contrat</td>
                                <td class="p-3">2026-01-18</td>
                                <td class="p-3">30 min</td>
                                <td class="p-3">
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Terminée
                                    </span>
                                </td>
                                <td class="p-3 flex justify-center">
                                    <button class="bg-slate-600 hover:bg-slate-700 text-white px-3 py-1 rounded">
                                        Voir
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="p-3">Youssef Karim</td>
                                <td class="p-3">Litige commercial</td>
                                <td class="p-3">2026-01-15</td>
                                <td class="p-3">—</td>
                                <td class="p-3">
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Annulée
                                    </span>
                                </td>
                                <td class="p-3 text-center text-gray-400">
                                    —
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </main>

        <?php require_once "footer.php"; ?>

    </div>
</div>

</body>
</html>
