<?php
session_start();
// Inclure le fichier de connexion
require_once '../connexion.php';

if (isset($_POST['publishQuizz']) && isset($_POST['id_quizz']) && isset($_POST['id_classe'])) {
    $id_quizz = $_POST['id_quizz'];
    $id_classe = $_POST['id_classe'];

    $stmt = $conn->prepare("UPDATE quizz SET publie_quizz = 1 WHERE id_quizz = :id_quizz AND id_classe = :id_classe");
    $stmt->bindParam(':id_quizz', $id_quizz, PDO::PARAM_INT);
    $stmt->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../enseignant/pages/classe.php?page2=quizz&id_classe=$id_classe");
        exit();
    } else {
        echo "Erreur lors de la publication du quizz.";
    }
} else {
    echo "Paramètres manquants.";
}