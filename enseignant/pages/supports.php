
<h1>Supports</h1>
<!-- Formulaire pour ajouter un nouveau support -->
<form action="/Memoire/actions/addSupport.php" method="post" enctype="multipart/form-data">
    <label for="titre_support">Titre de support pédagogique: </label>
    <input type="text" name="titre_support" placeholder="Ex: Les systèmes distribués - Explication" required>

    <label for="fichier_url_support">Fichier :</label>
    <input type="file" name="fichier_url_support" id="fichier_url_support" required>

    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

    <button type="submit">Ajouter le support</button>
</form>

<br><hr><br>
<?php if (count($supports) > 0): ?>
    <ul>
        <?php foreach ($supports as $support): ?>
            <li>
                <strong><?= htmlspecialchars($support['titre_support']) ?></strong> <br>
                Type : <?= htmlspecialchars($support['type_support']) ?> <br>
                <?php if ($support['type_support'] === 'pdf'): ?>
                    <iframe src="<?= htmlspecialchars($support['fichier_url_support']) ?>" width="100%" height="400px"></iframe>
                <?php elseif ($support['type_support'] === 'image'): ?>
                    <img src="<?= htmlspecialchars($support['fichier_url_support']) ?>" alt="Support image" style="max-width: 300px;">
                <?php elseif ($support['type_support'] === 'doc'): ?>
                    <a href="<?= htmlspecialchars($support['fichier_url_support']) ?>" download>Télécharger le document Word</a>
                <?php else: ?>
                    <a href="<?= htmlspecialchars($support['fichier_url_support']) ?>" download>Télécharger le fichier</a>
                <?php endif; ?>
            </li>
            <hr><br>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun support pédagogique ajouté pour cette classe.</p>
<?php endif; ?>
