<form action="../../actions/inscriptionClass.php" method="post">
    <!-- id classe -->
    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

    <!-- code classe -->
    <label for="nom_classe">Entrez le code de la classe</label>
    <p>(Le code vous est fourni par l'enseignant)</p>
    <input type="text" name="code_classe" placeholder="Code de la classe" required>

    <button type="submit" name="submit">Rejoindre la classe</button>
</form>