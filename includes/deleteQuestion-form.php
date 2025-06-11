<form action="../../actions/addQuestion.php" method="post" class="form delete-question-form">
    <input type="hidden" name="id_question" value="<?= $question['id_question'] ?>">
    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
    <!-- id_video -->
    <?php if (isset($id_video)): ?>
        <input type="hidden" name="id_video" value="<?= $id_video ?>">
    <?php endif; ?>

    <button type="submit" name="deleteQuestion" class="bouton-standard">Supprimer la question</button>
</form>