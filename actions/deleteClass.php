<?php
session_start();
require_once '../connexion.php';


if (isset($_POST['supprimer']) && isset($_POST['id_classe'])) {
    $id_classe = $_POST['id_classe'];

    $stmt = $conn->prepare("DELETE FROM classes WHERE id = :id");
    $stmt->bindParam(':id', $id_classe);
    $stmt->execute();

    header("Location: ../enseignant/dashboard.php?page=classes");
    exit;
}
?>
