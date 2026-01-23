<?php
session_start();

$uploadDir = __DIR__ . '/uploads/';


if(isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] === 0){
    $uploadDir = __DIR__ . '/uploads/';
    if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    
    $fileName = basename($_FILES['uploadfile']['name']);
    $targetFile = $uploadDir . $fileName;

    if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $targetFile)){
        $data['fichier_acceptation'] = $fileName;
    } else {
        throw new Exception("Erreur lors du téléchargement du fichier");
    }
} else {
    throw new Exception("Aucun fichier téléchargé");
}