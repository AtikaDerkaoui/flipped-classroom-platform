<form action="../../actions/addQuestion.php" method="post" class="form flex-centered">
    <div class="form-content">
    <button type="button" class="btn-ajout-question close-button"><i class="fa-solid fa-xmark"></i></button>
    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
    <input type="hidden" name="id_quizz" value="<?= $id_quizz ?>">
    <?php if (isset($id_video)): ?>
        <input type="hidden" name="id_video" value="<?= $id_video ?>">
    <?php endif; ?>

    <h2>Ajouter une question</h2>
    <label>Texte de la question: </label>
    <textarea name="texte_question" required></textarea>

    <label>Réponses :</label>
    <p>Cochez les réponses correctes</p>
    <div><input type="text" name="reponses[]" required> <input type="checkbox" name="correctes[]" value="0"></div>

    <div><input type="text" name="reponses[]" required> <input type="checkbox" name="correctes[]" value="1"></div>

    <div><input type="text" name="reponses[]" required> <input type="checkbox" name="correctes[]" value="2"></div>


    <button type="submit" name="addQuestion" class="btn ajout-question-button" >Ajouter la question</button>
    </div>
</form>
