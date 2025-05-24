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
        <p>Créer un quizz <button id="btn-ajout-quizz"><i class="fa-solid fa-plus"></i></button></p>
    </section>

    <!-- Quizz disponibles -->
    <section class="quizzes-container classes-container">
        <?php foreach ($quizzes as $quiz) {?>
        <?php $id_quizz = $quiz['id_quizz']; ?>

        <!-- Début du quizz -->
        <div class="quizz">
             <!-- Formulaire ajouter question -->
            <div class="ajout-question-form flex-centered">
                <?php
                include(__DIR__.'/../../includes/addQuestion-form.php');
                ?>
            </div>
            
            <!-- Quizz -->
            <div class="quizz-header space-between">
                <h3><?=$quiz['titre_quizz'] ?></h3>
                <div>
                    <?php include(__DIR__.'/../../includes/deleteQuizz-form.php'); ?>
                    <button class="btn-show-quizz"><i class="fa-solid fa-caret-down"></i></button>
                </div>
            </div>

            <div class="quizz-content">
                <?php if($quiz['publie_quizz'] === "0"): ?>
                <!-- Ajouter une question au quizz -->
                <button class="btn-ajout-question" data-quizz-id="<?= $id_quizz ?>">
                    <i class="fa-solid fa-plus"></i> Ajouter une question
                </button>
                <!-- Publier le quizz si c'est pas déjà fait (publie_quizz = 0) -->
                <form action="../../actions/publishQuizz.php" method="post">
                    <input type="hidden" name="id_quizz" value="<?= $quiz['id_quizz'] ?>">
                    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

                    <button type="submit" name="publishQuizz">Publier le quizz</button>
                </form>
                <?php else: ?>
                    <p>Ce quizz est déjà publié, vous ne pouvez pas le modifier.</p>
                <?php endif; ?>

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
                        <?php foreach ($reponses as $reponse) { 
                        $style = $reponse['est_correcte'] ? "style='background-color: var(--clear-green);'" : "";
                        ?>
                        <li class="quizz-reponse" <?= $style ?>><?= $reponse['texte_reponse'] ?></li>
                        <?php } ?>
                    </ul>

                    <!-- supprimer/modifier la question -->
                    <?php 
                    if($quiz['publie_quizz'] === "0"):
                        include(__DIR__.'/../../includes/deleteQuestion-form.php');
                        include(__DIR__.'/../../includes/modifyQuestion-form.php');
                    endif;
                    ?>
                </div>
                <?php } ?>

                <p><span>Date de création: </span> <?= $quiz['date_creation_quizz'] ?></p>
            </div>
        </div>
        <!-- Fin du quizz -->
        <?php } ?>
    </section>
</div>




<!-- ====================================================== --> 
<!-- ========== Formulaire pour ajouter un quizz ========== -->
<!-- ====================================================== --> 
<div class="ajout-classe-form flex-centered" id="ajout-quizz-form">
    <?php
        require_once(__DIR__.'/../../includes/addQuizz-form.php');
    ?>
</div>




<!-- ====================================================== --> 
<!-- ===== Ajout des questions après création du quizz ==== -->
<!-- ====================================================== --> 
<?php if (isset($_SESSION['quizz-added'])):
    if ($_SESSION['quizz-added'] === true)?>
        <script>
            // ??????
        </script>
<?php endif; ?>
<?php unset($_SESSION['quizz-added']); ?>





<!-- ====================================================== --> 
<!-- ===================== SCRIPT ========================= -->
<!-- ====================================================== --> 
<script>

// Bouton pour afficher le formulaire de création d'un quizz
// ***************************************************************
document.getElementById("btn-ajout-quizz").addEventListener("click", function () {
    document.getElementById("ajout-quizz-form").classList.toggle('show');
});

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
            console.log("delete");
            form2.classList.toggle("show-block"); // Affiche ou cache le formulaire
        }
    });
});

// Bouton pour afficher le formulaire d'ajout de questions aux quizz
// ***************************************************************
document.querySelectorAll(".btn-ajout-question").forEach(function (button) {
    button.addEventListener("click", function () {
        const quizzContainer = button.closest(".quizz"); // Trouve le conteneur du quiz
        const form = quizzContainer.querySelector(".ajout-question-form"); // Trouve le formulaire dans ce quiz
        if (form) {
            form.classList.toggle("show"); // Affiche ou cache le formulaire
        }
    });
});

// Bouton pour fermer le formulaire d'ajout de questions aux quizz
// ***************************************************************
document.querySelectorAll(".btn-fermer-ajout-question").forEach(function (button) {
    button.addEventListener("click", function () {
        const quizzContainer = button.closest(".quizz"); // Trouve le conteneur du quiz
        const form = quizzContainer.querySelector(".ajout-question-form"); // Trouve le formulaire dans ce quiz
        if (form) {
            form.classList.toggle("show"); // Affiche ou cache le formulaire
        }
    });
});
</script>