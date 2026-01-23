<?php

use Services\personService;

require_once "../autoload.php";

$service = new personService();
$id=$_GET['id'];
$professionel = $service->getbyid($id);
$viewers = $service->viewers_profile();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Profile</title>
    <link rel="stylesheet" href="css/style.css">


    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
<?= require "./navbar_user.php" ?>
<main class="max-w-6xl mx-auto p-6">



    <!-- PROFILE HEADER -->
    <div class="bg-white rounded-xl shadow p-8 flex flex-col md:flex-row items-center gap-6 mb-10">

        <!-- AVATAR -->
        <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 
                    flex items-center justify-center text-white text-4xl font-bold">
            <?=substr($professionel['fullname'],0,1)  ?>
        </div>

        <!-- INFO -->
        <div class="flex-1 text-center md:text-left">
            <h1 class="text-3xl font-bold"> <?= $professionel['fullname'] ?></h1>
            <p class="text-gray-600 mt-1"><?= $professionel['role'] ?> • Casablanca</p>
        </div>

        
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm">Consultations</p>
            <p class="text-3xl font-bold mt-2">120</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm">Expérience</p>
            <p class="text-3xl font-bold mt-2"><?= $professionel['experience'] ?> ans</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm">Clients</p>
            <p class="text-3xl font-bold mt-2">56</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm">Tarif / heure</p>
            <p class="text-3xl font-bold mt-2"><?= $professionel['tarif'] ?> DH</p>
        </div>

    </div>

    <!-- ABOUT -->
    <!-- <div class="bg-white rounded-xl shadow p-6 mb-10">
        <h2 class="text-xl font-semibold mb-4">À propos</h2>
        <p class="text-gray-600 leading-relaxed">
            Avocat expérimenté spécialisé en droit civil et pénal, avec plus de 8 ans d’expérience.
            J’accompagne mes clients avec sérieux, confidentialité et professionnalisme.
        </p>
    </div> -->

    <!-- SPECIALITIES -->
    <!-- <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Spécialités</h2>

        <div class="flex flex-wrap gap-3">
            <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold">
                Droit Civil
            </span>
            <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold">
                Droit Pénal
            </span>
            <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold">
                Droit des Affaires
            </span>
        </div>
    </div> -->

</main>

</body>
</html>
