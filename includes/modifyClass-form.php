<!-- ========= Formulaire pour ajouter une classe ========= --> 
<div class="ajout-classe-form flex-centered" id="modifier-classe-form">
 <form action="../../actions/modifyClass.php" method="post" class="form flex-centered">
    <!-- Header du formulaire -->
    <div class="header space-between">
        <div class="left-part">
            <img src="../../assets/img/class-scene-black.svg">
            <h3>Modifier la classe</h3>
        </div>

        <button type="button" id="btn-fermer-classe" class="close-button"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <!-- Le formulaire -->
    <div class="input-container">
        <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

        <label for="nom_classe">Nom de votre classe</label>
        <p>Ce nom est celui que vous et vos élèves verront</p>
        <input type="text" name="nom_classe" value="<?= $classe['nom_classe'] ?>" placeholder="Ex: Analyse mathématique - Section B " required>
    
        <label for="id_departement">Département</label>
        <p>Choisissez l'un de ces départements</p>
        <p class="modifier-classe">(Département actuel : <?= htmlspecialchars($classe['nom_departement'])  ?>)</p>
        <select name="id_departement" class="form-select" required>
        <?php 
            $departement = $conn->query("SELECT * FROM departements");

            foreach ($departement as $row) {
                echo "<option value='" . $row['id_departement'] . "'>" . $row['nom_departement'] . "</option>";
            }
        ?>
        </select>

        <label for="id_niveau">Niveau</label>
        <p>Choisissez le niveau enseigné dans cette classe</p>
        <p class="modifier-classe">(Niveau actuel : <?= htmlspecialchars($classe['nom_niveau'])  ?>)</p>
        <select name="id_niveau" class="form-select" required>
        <?php 
            $niveau = $conn->query("SELECT * FROM niveaux");

            foreach ($niveau as $row) {
                echo "<option value='" . $row['id_niveau'] . "'>" . $row['nom_niveau'] . "</option>";
            }
        ?>
        </select>

        <label for="module">Matière (Ou contenu pédagogique)</label>
        <p>Ex: Mathématique ou Les verbes du 1er groupe</p>
        <input type="text" name="module" value="<?= $classe['module'] ?>" placeholder="Ex: Mathématique" required>

         <!-- Code de la classe -->
        <label for="code_classe">Code de la classe</label>
        <p>C'est le code que vos élèves doivent entrer pour rejoindre la classe, il doit être unique.</p>
        <input type="text" name="code_classe" value="<?= $classe['code_classe'] ?>" placeholder="Ex: AMX586" required>

        <div class="btn-container">
            <button type="submit" name="modifier">Modifier la classe</button>
        </div>

    </div>
</form>
</div>