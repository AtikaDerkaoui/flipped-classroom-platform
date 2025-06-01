<div class="supports">
<h1>Listes des supports pédagogiques: </h1>
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

</div>