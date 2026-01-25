<?php

require_once "../autoload.php";

use Services\personService;

$client = new personService;
$clients = $client->getAllClients();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <title>Document</title>
</head>

<body>
    <div class="cards-container">
        <?php foreach ($clients as $client): ?>
            <div class="card client-card">
                <h3><?= htmlspecialchars($client['fullname']) ?></h3>
                <span class="role-badge client">
                    <?= htmlspecialchars($client['role']) ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>