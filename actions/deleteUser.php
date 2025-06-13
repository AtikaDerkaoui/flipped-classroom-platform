<?php
session_start();
include '../connexion.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = :id");

    try {
        $stmt->execute(['id' => $id]);

        header("Location: ../admin/dashboard.php?page=utilisateurs");
        exit;
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "Requête invalide.";
}
?>
