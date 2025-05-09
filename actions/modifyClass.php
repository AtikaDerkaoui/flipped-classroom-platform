<?php
session_start();
// Inclure le fichier de connexion
require_once '../connexion.php';

if (isset($_POST['modifier']) && isset($_POST['id_classe'])) {
    $id_classe = $_POST['id_classe'];
    $nom_classe = $_POST['nom_classe'];
    $id_departement = $_POST['id_departement'];
    $id_niveau = $_POST['id_niveau'];
    $module = $_POST['module'];
    // id_enseignant
    $id_enseignant = $_SESSION['user_id'];

    $sql = "UPDATE classes SET nom_classe = :nom_classe, 
            id_departement = :id_departement, 
            id_niveau = :id_niveau,
            module = :module
            WHERE id_classe = :id_classe";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':nom_classe' => $nom_classe,
    ':id_departement' => $id_departement,
    ':id_niveau' => $id_niveau,
    ':module' => $module,
    ':id_classe' => $id_classe
]);

    header("Location: ../enseignant/dashboard.php?page=classes");
    exit;
}
?>