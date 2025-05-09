
<h1>Supports</h1>
<hr><br>
<?php if (count($supports) > 0): ?>
    <ul>
        <?php foreach ($supports as $support): ?>
            <li>
                <strong><?= htmlspecialchars($support['titre_support']) ?></strong> <br>
                Type : <?= htmlspecialchars($support['type_support']) ?> <br>
                <a href="<?= htmlspecialchars($support['fichier_url_support']) ?>" target="_blank">Voir le fichier</a>
                <a href="<?= htmlspecialchars($support['fichier_url_support']) ?>" download>Télécharger</a>
            </li>
            <hr><br>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun support pédagogique ajouté pour cette classe.</p>
<?php endif; ?>

<br><br><br>
<hr>
<form action="/Memoire/actions/addSupport.php" method="post" enctype="multipart/form-data">
    <label for="titre_support">Titre de support pédagogique: </label>
    <input type="text" name="titre_support" placeholder="Ex: Les systèmes distribués - Explication" required>

    <label for="fichier_url_support">Fichier :</label>
    <input type="file" name="fichier_url_support" id="fichier_url_support" required>

    <label for="type_support">Type de support :</label>
    <select name="type_support" id="type_support" required>
        <option value="pdf">Pdf</option>
        <option value="image">Image</option>
        <option value="doc">Document</option>
        <option value="autre">Autre</option>
    </select>

    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

    <button type="submit">Ajouter le support</button>
</form>