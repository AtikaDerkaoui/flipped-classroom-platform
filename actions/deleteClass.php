<?php
session_start();
require_once '../connexion.php';


if (isset($_POST['supprimer']) && isset($_POST['id_classe'])) {
    $id_classe = $_POST['id_classe'];
    $role = $_SESSION['role'];

    $stmt = $conn->prepare("DELETE FROM classes WHERE id_classe = :id_classe");
    $stmt->bindParam(':id_classe', $id_classe);
    $stmt->execute();

    header("Location: ../$role/dashboard.php?page=classes");
    exit;
}
?>
