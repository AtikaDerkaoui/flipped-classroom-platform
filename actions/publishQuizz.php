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

    if (isset($_POST['id_video'])){
        if ($stmt->execute()){
            $id_video = intval($_POST['id_video']);
            header("Location: ../enseignant/pages/video.php?page3=video-feedback&id_classe=$id_classe&id_video=$id_video");
        } else {
            echo "Erreur lors de l'ajout du quiz.";
        }
    }else{
        if ($stmt->execute()) {
            header("Location: ../enseignant/pages/classe.php?page2=quizz-standard&id_classe=$id_classe");
        } else {
            echo "Erreur lors de l'ajout du quiz.";
        }
    }
} else {
    echo "Paramètres manquants.";
}