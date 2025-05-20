<?php
session_start();
require_once '../connexion.php';


if (isset($_POST['supprimer-compte']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Supprimer l'utilisateur
    $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    if ($stmt->execute()) {
        // Détruire la session
        session_unset();
        session_destroy();

        // Redirection vers page d'accueil ou login
        header("Location: ../index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du compte.";
    }
}else {
    header("Location: ../index.php");
    exit();
}
?>
