<?php
session_start();
// Inclure le fichier de connexion
require_once '../connexion.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $niveau_id = $_POST['niveau_id'];
    $module = $_POST['module'];

    // Insérer la classe dans la base de données
    $sql = "INSERT INTO classes (nom, niveau_id, module) VALUES (:nom, :niveau_id, :module)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':niveau_id', $niveau_id);
    $stmt->bindParam(':module', $module);
    $stmt->execute();
}
?>