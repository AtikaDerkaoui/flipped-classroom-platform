<form action="../actions/modifyProfil.php" method="post" class="form">
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
    
    <label for="nom">Nom</label>
    <input type="text" name="nom" value="<?= $_SESSION['nom'] ?>" placeholder="Nom" required>

    <label for="prenom">Prenom</label>
    <input type="text" name="prenom" value="<?= $_SESSION['prenom'] ?>" placeholder="Prenom" required>

    <label for="email">Email</label>
    <input type="text" name="email" value="<?= $_SESSION['email'] ?>" placeholder="Exemple@gmail.com" required>

    <label for="mot_de_passe">Mot de passe</label>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe">


    <!-- ====== Visible pour élèves ====== -->
    <?php if ($_SESSION['role'] === 'eleve') : ?>

    <label for="id_niveau">Votre niveau :</label>
    <select name="id_niveau" class="form-select">
        <option value="">-- Choisir un niveau --</option>
            <?php
            $stmt = $conn->query("SELECT id_niveau, nom_niveau FROM niveaux");
            while ($row = $stmt->fetch()) {
                $selected = ($row['id_niveau'] == $id_niveau_actuel) ? "selected" : "";
                echo "<option value='{$row['id_niveau']}' $selected>{$row['nom_niveau']}</option>";
            }
            ?>
    </select>

    <label for="id_departement">Votre niveau :</label>
    <select name="id_departement" class="form-select">
        <option value="">-- Choisir un département --</option>
            <?php
            require_once '../connexion.php';
            $stmt = $conn->query("SELECT id_departement, nom_departement FROM departements");
            while ($row = $stmt->fetch()) {
                $selected = ($row['id_departement'] == $id_departement_actuel) ? "selected" : "";
                echo "<option value='{$row['id_departement']}' $selected>{$row['nom_departement']}</option>";
            }
            ?>
    </select>
    <?php endif; ?>


    <button type="submit" name="modifier">Confirmer la modification</button>
</form>