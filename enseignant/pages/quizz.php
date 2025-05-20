<?php
// Inclure le fichier de connexion
require_once '../../connexion.php';
?>

<form action="../../actions/addQuizz.php" method="POST">
    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

    <label for="titre_quizz">Titre du quizz: </label>
    <input type="text" name="titre_quizz" placeholder="Titre du quiz" required>

    <button type="submit">Ajouter le quiz</button>
</form>

<br><hr><br>
<?php 
$stmt = $conn->prepare("SELECT * FROM quizz WHERE id_classe = :id_classe");
$stmt->bindParam(':id_classe', $id_classe);
$stmt->execute();
$quizzes = $stmt->fetchAll();

foreach ($quizzes as $quiz) {
    echo "<li>Titre : {$quiz['titre_quizz']} - Créé le {$quiz['date_creation_quizz']}</li>";
}
?>