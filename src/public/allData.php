<?php

require_once "../autoload.php";

use Repository\personRepository;

$name = $_GET['query'] ?? '';
$type = strtolower($_GET['type'] ?? '');

$personRepo = new personRepository();

try {
    $persons = $personRepo->filterByNameAndType($name, $type);

    header('Content-Type: application/json');
    echo json_encode($persons);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
