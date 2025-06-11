<form action="../../actions/addQuizz.php" method="POST" class="form flex-centered">
    <div class="header space-between">
        <div class="left-part">
            <img src="../../assets/img/class-scene-black.svg">
            <h3>Ajouter un quizz</h3>
        </div>
        <button type="button" id="btn-fermer-ajout-quizz" class="close-button"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
    <!-- id_video -->
    <?php if (isset($id_video)): ?>
        <input type="hidden" name="id_video" value="<?= $id_video ?>">
    <?php endif; ?>


    <div class="input-container">
        <label for="titre_quizz">Titre du quizz: </label>
        <input type="text" name="titre_quizz" placeholder="Titre du quiz" required>

        <div class="btn-container">
            <button type="submit" name="addQuizz" id="btn-test">Ajouter le quiz</button>
        </div>
    </div>
</form>

<script>
// =========================================================
// Bouton pour fermer le formulaire de création d'un quizz
// =========================================================
document.getElementById("btn-fermer-ajout-quizz").addEventListener("click", function () {
    document.getElementById("ajout-quizz-form").classList.toggle('show');
});


document.getElementById("btn-test").addEventListener("click", function () {
    console.log("Bouton test");
});
</script>