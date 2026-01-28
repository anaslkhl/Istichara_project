<?php
use Services\personService;

require_once "../autoload.php";

$service = new personService();

$total_consultation = $service->total_consultation();
$total_houres_worked_person = $service->total_houres_worked_person();
$chiffres_affaires_person = $service->chiffres_affaires_person();
$total_demandes_attendus = $service->total_demandes_attendus();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Dashboard</title>

    <!-- Tailwind CDN (إلا ما مركبوش محليا) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">

</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between">
        <div>
            <h2 class="text-2xl font-bold p-6 border-b border-slate-700">
                ISTICHARA
            </h2>

            <nav class="flex flex-col p-4 gap-2">
                <a href="" class="bg-slate-800 px-4 py-3 rounded-lg">
                    📊 Statistiques
                </a>
                <a href="availability" class="hover:bg-slate-800 px-4 py-3 rounded-lg">
                    🕒 availability
                </a>
                <a href="reservations" class="hover:bg-slate-800 px-4 py-3 rounded-lg">
                    📅 Reservations
                </a>
                <a href="professional_consultation" class="hover:bg-slate-800 px-4 py-3 rounded-lg">
                    💬 Consultations
                </a>
            </nav>
        </div>

        <!-- LOGOUT -->
        <div class="p-4">
            <a href="logout.php"
               class="block text-center bg-red-600 hover:bg-red-700 py-3 rounded-lg font-semibold">
                🚪 Logout
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

       

        <!-- DASHBOARD CONTENT -->
        <main class="p-8">

            <h1 class="text-3xl font-bold mb-8">📊 Professional Dashboard</h1>

            <!-- STAT CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-xl shadow-lg">
                    <p class="text-sm opacity-90">Total Consultations</p>
                    <p class="text-3xl font-bold mt-2"><?= $total_consultation ?></p>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-700 text-white p-6 rounded-xl shadow-lg">
                    <p class="text-sm opacity-90">Heures travaillées</p>
                    <p class="text-3xl font-bold mt-2"><?= intval($total_houres_worked_person).'h'.(intval($total_houres_worked_person)-$total_houres_worked_person)*60 . "min" ?></p>
                </div>

                <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white p-6 rounded-xl shadow-lg">
                    <p class="text-sm opacity-90">Chiffre d'affaires</p>
                    <p class="text-3xl font-bold mt-2"><?= $chiffres_affaires_person ?>DH</p>
                </div>

                <div class="bg-gradient-to-r from-red-500 to-red-700 text-white p-6 rounded-xl shadow-lg">
                    <p class="text-sm opacity-90">Demandes en attente</p>
                    <p class="text-3xl font-bold mt-2"><?= $total_demandes_attendus ?></p>
                </div>

            </div>

            <!-- TABLE -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-xl font-semibold mb-4">
                    Dernières réservations
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3">Client</th>
                                <th class="p-3">Date</th>
                                <th class="p-3">Heure</th>
                                <th class="p-3">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-3">Ahmed Benali</td>
                                <td class="p-3">2026-01-20</td>
                                <td class="p-3">10:30</td>
                                <td class="p-3 text-green-600 font-semibold">
                                    Confirmée
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-3">Salma Idrissi</td>
                                <td class="p-3">2026-01-21</td>
                                <td class="p-3">14:00</td>
                                <td class="p-3 text-yellow-500 font-semibold">
                                    En attente
                                </td>
                            </tr>
                            <tr>
                                <td class="p-3">Youssef Karim</td>
                                <td class="p-3">2026-01-22</td>
                                <td class="p-3">09:00</td>
                                <td class="p-3 text-red-600 font-semibold">
                                    Annulée
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </div>
</div>

</body>
</html>
