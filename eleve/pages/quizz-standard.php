<?php
// Inclure le fichier de connexion
require_once '../../connexion.php';

$id_eleve = $_SESSION['user_id'];

// Quizz de la classe ou quizz d'une capsule vidéo ?
// 1. Quizz d'une capsule vidéo
if (isset($page3)){
    $stmt = $conn->prepare("SELECT * FROM quizz WHERE id_classe = :id_classe AND id_video = :id_video");
    $stmt->bindParam(':id_classe', $id_classe);
    $stmt->bindParam(':id_video', $id_video);
    $stmt->execute();
    $quizzes = $stmt->fetchAll();
}else{ // 2. Quizz de la classe
    $stmt = $conn->prepare("SELECT * FROM quizz WHERE id_classe = :id_classe AND id_video IS NULL AND publie_quizz = 1");
    $stmt->bindParam(':id_classe', $id_classe);
    $stmt->execute();
    $quizzes = $stmt->fetchAll();
}

// verifier si eleve est inscrit à la classe
$verif = $conn->prepare("SELECT * FROM inscriptions WHERE id = :id_eleve AND id_classe = :id_classe");
$verif->bindParam(':id_eleve', $id_eleve);
$verif->bindParam(':id_classe', $id_classe);
$verif->execute();

?>

<!-- ====================================================== --> 
<!-- ============= Liste des quizz ajoutés ============= -->
<!-- ====================================================== -->
<?php if ($verif->rowCount() !== 0): ?>
<div class="quizzes classes">
    <!-- Ajouter un quizz -->
    <section class="ajouter-quizz ajout-classe space-between">
        <h2>Quizz</h2>
    </section>

    <!-- Quizz disponibles -->
    <section class="quizzes-container classes-container">
        <?php if (empty($quizzes)) {
            echo "<p>Aucun quiz disponible.</p>";
        }?>
        <?php foreach ($quizzes as $quiz) {?>
        <?php 
        $id_quizz = $quiz['id_quizz']; 
        // recuperer nombre de reponses de l'eleve dans ce quizz
        $stmt = $conn->prepare("SELECT COUNT(*) FROM reponses_etudiants WHERE id_quizz = :id_quizz AND id_eleve = :id_eleve");
        $stmt->execute([
            ':id_quizz' => $id_quizz,
            ':id_eleve' => $id_eleve
        ]);
        $nb_reponses_eleve = $stmt->fetchColumn();

        // recuperer le score de l'eleve de ce quizz
        $stmt = $conn->prepare("SELECT score FROM scores_etudiants WHERE id_eleve = :id_eleve AND id_quizz = :id_quizz");
        $stmt->execute([
            'id_eleve' => $_SESSION['user_id'],
            'id_quizz' => $id_quizz
        ]);
        $score = $stmt->fetchColumn();
        ?>

        <!-- Début du quizz -->
        <div class="quizz">
            <!-- Quizz -->
            <div class="quizz-header space-between">
                <h3><?=$quiz['titre_quizz'] ?></h3>
                <div>
                    <button class="btn-show-quizz"><i class="fa-solid fa-caret-down"></i></button>
                </div>
            </div>

            <div class="quizz-content">
                <!-- score du quizz si déjà répondu -->
                <?php if($nb_reponses_eleve > 0): ?>
                    <p class="quizz-score"><strong>Votre score: </strong><span><?= htmlspecialchars($score) ?> / 20</span></p>
                <?php endif; ?>

                <!-- Formulaire pour répondre aux questions du quizz -->
                <form method="post" action="../../actions/submitQuizz.php" class="repondre-question-form">
                    <input type="hidden" name="id_quizz" value="<?= $id_quizz ?>">
                    <?php if (isset($id_video)): ?>
                        <input type="hidden" name="id_video" value="<?= $id_video ?>">
                    <?php endif; ?>

                    <?php 
                    $count = 0;

                    // recuperer les questions du quizz
                    $stmt = $conn->prepare("SELECT * FROM questions WHERE id_quizz = :id_quizz");
                    $stmt->bindParam(':id_quizz', $id_quizz);
                    $stmt->execute();
                    $questions = $stmt->fetchAll();

                    // Affichage des questions
                    foreach ($questions as $question) {
                        $count++;
                        $id_question = $question['id_question'];
                    ?>
                    <div class="quizz-question">
                        <h4><?= $count ?>. <?= $question['texte_question'] ?></h4>

                        <?php 
                        // recuperer les réponses disponibles de cette question
                        $stmt2 = $conn->prepare("SELECT * FROM reponses WHERE id_question = :id_question");
                        $stmt2->bindParam(':id_question', $question['id_question']);
                        $stmt2->execute();
                        $reponses = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <ul>
                        <?php foreach ($reponses as $reponse) { ?>
                            <!-- réponse de la question -->
                            <?php if($nb_reponses_eleve == 0): ?>
                            <li class="quizz-reponse">
                                <label>
                                    <input type="checkbox" name="reponses[<?= $question['id_question'] ?>][]" value="<?= $reponse['id_reponse'] ?>">
                                    <?= htmlspecialchars($reponse['texte_reponse']) ?>
                                </label>
                            </li>
                            <?php else: 
                                $style = $reponse['est_correcte'] ? "style='background-color: var(--clear-green);'" : "";
                            ?>
                            <li class="quizz-reponse" <?= $style ?>>
                                <label>
                                    <?= htmlspecialchars($reponse['texte_reponse']) ?>
                                </label>
                            </li>
                            <?php endif; ?>

                        <?php } ?>
                        </ul>
                    </div>
                    <?php } 
                    if($nb_reponses_eleve == 0):?>
                        <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

                        <button type="submit" name="submitQuizz" class="bouton-standard">Soumettre le quizz</button>
                    <?php endif; ?>
                </form>

            </div>
        </div>
        <!-- Fin du quizz -->
        <?php } ?>
    </section>
</div>
<?php else: ?>
    <p class="negatif-msg">Vous devez vous inscrire pour accéder au contenu de cette classe.</p>
<?php endif; ?>


<script>
// ================ Bouton pour afficher un quizz ================
// ***************************************************************
document.querySelectorAll(".btn-show-quizz").forEach(function (button) {
    button.addEventListener("click", function () {
        const quizzContainer = button.closest(".quizz"); // Trouve le conteneur du quiz
        const form = quizzContainer.querySelector(".quizz-content"); // Trouve le formulaire dans ce quiz
        const form2 = quizzContainer.querySelector(".delete-quizz-form");
        if (form) {
            form.classList.toggle("show-block"); // Affiche ou cache le formulaire
        }
        if (form2) {
            form2.classList.toggle("show-block"); // Affiche ou cache le formulaire
        }
    });
});
</script>