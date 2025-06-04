<?php
// Inclure le fichier de connexion
require_once '../../connexion.php';
?>

<!-- ====================================================== --> 
<!-- ============= Liste des quizz ajoutés ============= -->
<!-- ====================================================== --> 
<div class="quizzes classes">
    <!-- Ajouter un quizz -->
    <section class="ajouter-quizz ajout-classe space-between">
        <h2>Quizz de la capsule</h2>
        <p>Créer un quizz <button id="btn-ajout-quizz"><i class="fa-solid fa-plus"></i></button></p>
    </section>

    <!-- Quizz disponibles -->
    <section class="quizzes-container classes-container">
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
                <h3>Quizz: la notion de limite</h3>
                <div>
                    <?php include(__DIR__.'/../../includes/deleteQuizz-form.php'); ?>
                    <button class="btn-show-quizz"><i class="fa-solid fa-caret-down"></i></button>
                </div>
            </div>

            <div class="quizz-content">
                <div class="quizz-ajouter-publier">
                <!-- Ajouter une question au quizz -->
                <button class="btn-ajout-question bouton-standard" >
                    <i class="fa-solid fa-plus"></i> Ajouter une question
                </button>
                <!-- Publier le quizz si c'est pas déjà fait (publie_quizz = 0) -->
                <form action="../../actions/publishQuizz.php" method="post">
                    <input type="hidden" name="id_quizz">
                    <input type="hidden" name="id_classe">

                    <button type="submit" name="publishQuizz" class="bouton-standard">Publier le quizz</button>
                </form>
                </div>

                <!-- Affichage des questions du quizz -->
                <div class="quizz-question">
                    <h4>Quelle condition n’est pas obligatoire pour que la limite existe ?</h4>
                    <ul>
                        <li class="quizz-reponse">
                            La fonction est définie autour du point étudié 
                        </li>
                        <li class="quizz-reponse" style='background-color: var(--clear-green);'>
                            La fonction prend une valeur exacte à ce point
                        </li>
                        <li class="quizz-reponse">
                            La fonction est définie sauf peut-être exactement à ce point
                        </li>
                    </ul>

                    <!-- supprimer/modifier la question -->
                    <?php 
                    
                        include(__DIR__.'/../../includes/deleteQuestion-form.php');
                        include(__DIR__.'/../../includes/modifyQuestion-form.php');
                    ?>
                </div>
                <p><span>Date de création: </span>  2025-05-20 19:00:12</p>
            </div>
        </div>
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