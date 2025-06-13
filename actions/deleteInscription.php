<?php
session_start();
require_once '../connexion.php';


if (isset($_POST['deleteInscription']) && isset($_POST['id_inscription'])) {
    $id_inscription = $_POST['id_inscription'];
    $id_classe = $_POST['id_classe'];
    $role = $_SESSION['role'];

    $stmt = $conn->prepare("DELETE FROM inscriptions WHERE id_inscription = :id_inscription");
    $stmt->bindParam(':id_inscription', $id_inscription);
    $stmt->execute();

    header("Location: ../$role/pages/classe.php?page2=eleves&id_classe=$id_classe");
    exit;
}
?>
<h1><?= $_SESSION['role'] ?></h1>