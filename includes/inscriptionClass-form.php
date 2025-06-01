<form action="../../actions/inscriptionClass.php" method="post" class="form-inscription">
    <!-- id classe -->
    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

    <!-- code classe -->
    <label for="nom_classe">Entrez le code de la classe</label>
    <p class="instruction">(Le code vous est fourni par l'enseignant)</p>
    <input type="text" name="code_classe" placeholder="Code de la classe" class="input-code" required>

    <button type="submit" name="submit" class="btn-submit">Rejoindre la classe</button>
</form>