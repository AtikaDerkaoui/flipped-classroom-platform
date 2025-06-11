<?php
session_start();
require_once '../connexion.php';

if (isset($_POST['addQuizz'])) {
    $titre_quizz = htmlspecialchars($_POST['titre_quizz']);
    $id_classe = intval($_POST['id_classe']);
    
    if (isset($_POST['id_video'])){
        $id_video = intval($_POST['id_video']);

        $stmt = $conn->prepare("INSERT INTO quizz (titre_quizz, id_classe, id_video) VALUES (:titre_quizz, :id_classe, :id_video)");
        $stmt->bindParam(':titre_quizz', $titre_quizz);
        $stmt->bindParam(':id_classe', $id_classe);
        $stmt->bindParam(':id_video', $id_video);

        if ($stmt->execute()){
            header("Location: ../enseignant/pages/video.php?page3=video-feedback&id_classe=$id_classe&id_video=$id_video");
        } else {
            echo "Erreur lors de l'ajout du quiz.";
        }
    }else{
        $stmt = $conn->prepare("INSERT INTO quizz (titre_quizz, id_classe) VALUES (:titre_quizz, :id_classe)");
        $stmt->bindParam(':titre_quizz', $titre_quizz);
        $stmt->bindParam(':id_classe', $id_classe);

        if ($stmt->execute()) {
            header("Location: ../enseignant/pages/classe.php?page2=quizz-standard&id_classe=$id_classe");
        } else {
            echo "Erreur lors de l'ajout du quiz.";
        }
    }
}

if (isset($_POST['deleteQuizz'])) {
    $id_quizz = $_POST['id_quizz'];
    $id_classe = $_POST['id_classe'];
    

    $stmt = $conn->prepare("DELETE FROM quizz WHERE id_quizz = :id_quizz");
    $stmt->bindParam(':id_quizz', $id_quizz);
    $stmt->execute();

    if (isset($_POST['id_video'])){
        $id_video = intval($_POST['id_video']);
        header("Location: ../enseignant/pages/video.php?page3=video-feedback&id_classe=$id_classe&id_video=$id_video");
    }else{
        header("Location: ../enseignant/pages/classe.php?page2=quizz-standard&id_classe=$id_classe");
    }
}
?>
