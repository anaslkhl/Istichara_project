<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Dashboard - Reservations</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR (SAME AS BEFORE) -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold p-6 border-b border-slate-700">
                    ISTICHARA
                </h2>

                <nav class="flex flex-col p-4 gap-2">
                    <a href="professional_dashboared" class="hover:bg-slate-800 px-4 py-3 rounded-lg">
                        📊 Statistiques
                    </a>
                    <a href="professional_reservation" class="bg-slate-800 px-4 py-3 rounded-lg">
                        📅 Reservations
                    </a>
                    <a href="professional_consultation" class="hover:bg-slate-800 px-4 py-3 rounded-lg">
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

                <!-- PAGE TITLE -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold">📅 Reservations</h1>

                    <!-- FILTER -->
                    <select class="border rounded-lg px-4 py-2">
                        <option>All</option>
                        <option>Confirmée</option>
                        <option>En attente</option>
                        <option>Annulée</option>
                    </select>
                </div>

                <!-- RESERVATIONS TABLE -->
                <div class="bg-white rounded-xl shadow p-6">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600">
                                    <th class="p-3">Client</th>
                                    <th class="p-3">Date</th>
                                    <th class="p-3">Heure</th>
                                    <th class="p-3">Type</th>
                                    <th class="p-3">Statut</th>
                                    <th class="p-3 text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="border-b">
                                    <td class="p-3">Ahmed Benali</td>
                                    <td class="p-3">2026-01-20</td>
                                    <td class="p-3">10:30</td>
                                    <td class="p-3">En ligne</td>
                                    <td class="p-3">
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Confirmée
                                        </span>
                                    </td>
                                    <td class="p-3 flex gap-2 justify-center">
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                            Voir
                                        </button>
                                    </td>
                                </tr>

                                <tr class="border-b">
                                    <td class="p-3">Salma Idrissi</td>
                                    <td class="p-3">2026-01-21</td>
                                    <td class="p-3">14:00</td>
                                    <td class="p-3">Présentiel</td>
                                    <td class="p-3">
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                            En attente
                                        </span>
                                    </td>
                                    <td class="p-3 flex gap-2 justify-center">
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                            Confirmer
                                        </button>
                                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                            Annuler
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-3">Youssef Karim</td>
                                    <td class="p-3">2026-01-22</td>
                                    <td class="p-3">09:00</td>
                                    <td class="p-3">En ligne</td>
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