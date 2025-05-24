<form action="../../actions/addQuestion.php" method="post" class="form">
    <button type="button" class="btn-fermer-ajout-question close-button"><i class="fa-solid fa-xmark"></i></button>
    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
    <input type="hidden" name="id_quizz" value="<?= $id_quizz ?>">

    <label>Question :</label><br>
    <textarea name="texte_question" required></textarea><br>

    <label>Réponses :</label><br>
    <input type="text" name="reponses[]" required> <input type="checkbox" name="correctes[]" value="0"> Correcte<br>
    <input type="text" name="reponses[]" required> <input type="checkbox" name="correctes[]" value="1"> Correcte<br>

    <button type="submit" name="addQuestion" >Ajouter la question</button>
</form>
