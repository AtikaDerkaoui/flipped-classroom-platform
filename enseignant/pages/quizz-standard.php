<?php
// Inclure le fichier de connexion
require_once '../../connexion.php';

if (isset($page3)){
    $stmt = $conn->prepare("SELECT * FROM quizz WHERE id_classe = :id_classe AND id_video = :id_video");
    $stmt->bindParam(':id_classe', $id_classe);
    $stmt->bindParam(':id_video', $id_video);
    $stmt->execute();
    $quizzes = $stmt->fetchAll();
}else{
    $stmt = $conn->prepare("SELECT * FROM quizz WHERE id_classe = :id_classe AND id_video IS NULL");
    $stmt->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
    $stmt->execute();
    $quizzes = $stmt->fetchAll();
}
?>

<!-- ====================================================== --> 
<!-- ============= Liste des quizz ajoutés ============= -->
<!-- ====================================================== --> 
<div class="quizzes classes">
    <!-- Ajouter un quizz -->
    <section class="ajouter-quizz ajout-classe space-between">
        <h2>
            <?php 
            if(isset($page3)){
                echo "Quizz de la Capsule";
            }else{
                echo "Mes Quizz";
            }
            ?>
        </h2>
        <?php 
        if(isset($page3)):
            if (count($quizzes) < 1): ?>
                <p>Créer un quizz <button id="btn-ajout-quizz"><i class="fa-solid fa-plus"></i></button></p>
            <?php endif; ?>
        <?php else: ?>
            <p>Créer un quizz <button id="btn-ajout-quizz"><i class="fa-solid fa-plus"></i></button></p>
        <?php  endif; ?>
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
                    <!-- Supprimer le quiz -->
                    <?php include(__DIR__.'/../../includes/deleteQuizz-form.php'); ?>
                    <!-- Afficher le quiz -->
                    <button class="btn-show-quizz"><i class="fa-solid fa-caret-down fa-show-quizz"></i></button>
                </div>
            </div>

            <div class="quizz-content">
                <?php if($quiz['publie_quizz'] === "0"): ?>
                <div class="quizz-ajouter-publier">
                    <!-- Ajouter une question au quizz -->
                    <button class="btn-ajout-question bouton-standard" data-quizz-id="<?= $id_quizz ?>">
                        <i class="fa-solid fa-plus"></i> Ajouter une question
                    </button>
                    <!-- Publier le quizz si c'est pas déjà fait (publie_quizz = 0) -->
                    <form action="../../actions/publishQuizz.php" method="post">
                        <input type="hidden" name="id_quizz" value="<?= $quiz['id_quizz'] ?>">
                        <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
                        <?php if (isset($id_video)): ?>
                            <input type="hidden" name="id_video" value="<?= $id_video ?>">
                        <?php endif; ?>

                        <button type="submit" name="publishQuizz" class="bouton-standard">Publier le quizz</button>
                    </form>
                </div>
                <?php else: ?>
                    <p>Ce quiz est déjà publié, vous ne pouvez pas le modifier.</p>
                    <!-- Bouton pour consulter les notes des étudiants dans ce quiz, un pop up est affiché -->
                    <button class="btn-afficher-resultats-quizz"><i class="fa-solid fa-square-poll-vertical"></i> Consulter les résultats de vos étudiants</button>
                    <?php include(__DIR__.'/../../includes/resultatsQuizz.php'); ?>
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

                    <!-- Affichage les réponses de la question -->
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
<!-- ===================== SCRIPT ========================= -->
<!-- ====================================================== --> 
<script>

// Bouton pour afficher le formulaire de création d'un quizz
// ***************************************************************
const btnAjout = document.getElementById("btn-ajout-quizz");
if (btnAjout) {
    btnAjout.addEventListener("click", function () {
        document.getElementById("ajout-quizz-form").classList.toggle('show');
    });
};

// ================ Bouton pour afficher un quizz ================
// ***************************************************************
document.querySelectorAll(".btn-show-quizz").forEach(function (button) {
    button.addEventListener("click", function () {
        const quizzContainer = button.closest(".quizz"); // Trouve le conteneur du quiz
        const form = quizzContainer.querySelector(".quizz-content"); // Trouve le formulaire dans ce quiz
        const form2 = quizzContainer.querySelector(".delete-quizz-form");
        const btn = quizzContainer.querySelector(".fa-show-quizz");
        if (form) {
            form.classList.toggle("show-block"); // Affiche ou cache le formulaire
            btn.classList.toggle("rotate-180");
        }
        if (form2) {
            form2.classList.toggle("show-block"); // Affiche ou cache le formulaire
        }
    });
});

// Bouton pour afficher/fermer le formulaire d'ajout de questions aux quizz
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


// Bouton pour afficher/fermer les résultats du quizz
// ***************************************************************
document.querySelectorAll(".btn-afficher-resultats-quizz").forEach(function (button) {
    button.addEventListener("click", function () {
        const quizzContainer = button.closest(".quizz-content"); // Trouve le conteneur du quiz
        console.log(quizzContainer);
        const form = quizzContainer.querySelector(".resultats-container"); // Trouve le formulaire dans ce quiz
        console.log(form);
        if (form) {
            console.log("non non");
            form.classList.toggle("show"); // Affiche ou cache le formulaire
        }
    });
});
</script>