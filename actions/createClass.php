<?php
session_start();
// Inclure le fichier de connexion
require_once '../connexion.php';

if (isset($_POST['submit'])) {
    $nom_classe = $_POST['nom_classe'];
    $id_departement = $_POST['id_departement'];
    $id_niveau = $_POST['id_niveau'];
    $module = $_POST['module'];

    // id_enseignant
    $id_enseignant = $_SESSION['user_id'];

    // Insérer la classe dans la base de données
    $sql = "INSERT INTO classes (nom_classe, id_departement, id_niveau, module, id_enseignant) VALUES (:nom_classe, :id_departement, :id_niveau, :module, :id_enseignant)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom_classe', $nom_classe);
    $stmt->bindParam(':id_departement', $id_departement);
    $stmt->bindParam(':id_niveau', $id_niveau);
    $stmt->bindParam(':module', $module);
    $stmt->bindParam(':id_enseignant', $id_enseignant);
    $stmt->execute();

    header("Location: ../enseignant/dashboard.php?page=classes");
    exit;
}
?>