<?php
require_once '../connexion.php';
session_start();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

if (isset($_POST['addQuestion'])) {
    $id_classe = intval($_POST['id_classe']);
    $id_quizz = $_POST['id_quizz'];
    $texte_question = $_POST['texte_question'];
    $reponses = $_POST['reponses'];
    $correctes = $_POST['correctes'] ?? [];

    // Insérer la question
    $stmt = $conn->prepare("INSERT INTO questions (id_quizz, texte_question) VALUES (?, ?)");
    $stmt->execute([$id_quizz, $texte_question]);
    $id_question = $conn->lastInsertId();

    // Insérer les réponses
    foreach ($reponses as $index => $texte) {
        $est_correcte = in_array($index, $correctes) ? 1 : 0;
        $stmt = $conn->prepare("INSERT INTO reponses (id_question, texte_reponse, est_correcte) VALUES (?, ?, ?)");
        $stmt->execute([$id_question, $texte, $est_correcte]);
    }

    header("Location: ../enseignant/pages/classe.php?page2=quizz&id_classe=$id_classe");
    exit;
}

if (isset($_POST['deleteQuestion'])) {
    $id_question = $_POST['id_question'];
    $id_classe = $_POST['id_classe'];

    $stmt = $conn->prepare("DELETE FROM questions WHERE id_question = :id_question");
    $stmt->bindParam(':id_question', $id_question);
    $stmt->execute();

    header("Location: ../enseignant/pages/classe.php?page2=quizz&id_classe=$id_classe");
}
?>