<form action="../../actions/addQuizz.php" method="post" class="delete-quizz-form" onsubmit="return confirm('Voulez-vous vraiment supprimer ce quizz ?');">
    <input type="hidden" name="id_quizz" value="<?= $id_quizz ?>">
    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
    
    <?php if (isset($page3)): ?>
        <input type="hidden" name="id_video" value="<?= $id_video ?>">
    <?php endif; ?>

    <button type="submit" name="deleteQuizz"><i class="fa-solid fa-trash"></i></button>
</form>