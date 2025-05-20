<?php
session_start();
require_once '../connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre_quizz = htmlspecialchars($_POST['titre_quizz']);
    $id_classe = intval($_POST['id_classe']);

    $stmt = $conn->prepare("INSERT INTO quizz (titre_quizz, id_classe) VALUES (:titre_quizz, :id_classe)");
    $stmt->bindParam(':titre_quizz', $titre_quizz);
    $stmt->bindParam(':id_classe', $id_classe);

    if ($stmt->execute()) {
        header("Location: ../enseignant/pages/classe.php?page2=quizz&id_classe=$id_classe");
    } else {
        echo "Erreur lors de l'ajout du quiz.";
    }
}
?>
