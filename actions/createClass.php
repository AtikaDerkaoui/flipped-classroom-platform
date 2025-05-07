<?php
session_start();
// Inclure le fichier de connexion
require_once '../connexion.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $niveau_id = $_POST['niveau_id'];
    $module = $_POST['module'];

    // id_enseignant
    $enseignant_id = $_SESSION['user_id'];

    // Insérer la classe dans la base de données
    $sql = "INSERT INTO classes (nom, niveau_id, module, enseignant_id) VALUES (:nom, :niveau_id, :module, :enseignant_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':niveau_id', $niveau_id);
    $stmt->bindParam(':module', $module);
    $stmt->bindParam(':enseignant_id', $enseignant_id);
    $stmt->execute();

    header("Location: ../enseignant/dashboard.php?page=classes");
    exit;
}
?>