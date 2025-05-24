<?php
// Inclure le fichier de connexion
require_once '../../connexion.php';

$stmt = $conn->prepare("SELECT * FROM quizz WHERE id_classe = :id_classe");
$stmt->bindParam(':id_classe', $id_classe);
$stmt->execute();
$quizzes = $stmt->fetchAll();

?>

<!-- ====================================================== --> 
<!-- ============= Liste des quizz ajoutés ============= -->
<!-- ====================================================== --> 
<div class="quizzes classes">
    <!-- Ajouter un quizz -->
    <section class="ajouter-quizz ajout-classe space-between">
        <h2>Mes Quizz</h2>
    </section>

    <!-- Quizz disponibles -->
    <section class="quizzes-container classes-container">
        <?php foreach ($quizzes as $quiz) {?>
        <?php $id_quizz = $quiz['id_quizz']; ?>

        <!-- Début du quizz -->
        <div class="quizz">
            <!-- Quizz -->
            <div class="quizz-header space-between">
                <h3><?=$quiz['titre_quizz'] ?></h3>
                <div>
                    <button id="show-quizz"><i class="fa-solid fa-caret-down"></i></button>
                </div>
            </div>

            <div class="quizz-content">
            <?php if($quiz['publie_quizz'] === "1"): ?>
                <!-- Affichage des questions du quizz -->
                <?php 
                $count = 0;

                $stmt = $conn->prepare("SELECT * FROM questions WHERE id_quizz = :id_quizz");
                $stmt->bindParam(':id_quizz', $id_quizz);
                $stmt->execute();
                $questions = $stmt->fetchAll();

                foreach ($questions as $question) {
                    $count = $count + 1;
                ?>
                <div class="quizz-question">
                    <h4><?= $count ?>. <?= $question['texte_question'] ?></h4>

                    <!-- Affichage des réponses -->
                    <?php 
                    $stmt2 = $conn->prepare("SELECT * FROM reponses WHERE id_question = :id_question");
                    $stmt2->bindParam(':id_question', $question['id_question']);
                    $stmt2->execute();
                    $reponses = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <ul>
                        <?php foreach ($reponses as $reponse) { ?>
                        <li class="quizz-reponse"><?= $reponse['texte_reponse'] ?></li>
                        <?php } ?>
                    </ul>

                </div>
                <?php } ?>
            <?php endif; ?>

                <p><span>Date de création: </span> <?= $quiz['date_creation_quizz'] ?></p>
            </div>
        </div>
        <!-- Fin du quizz -->
        <?php } ?>
    </section>
</div>