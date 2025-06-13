<form action="../actions/modifyProfil.php" method="post" class="form" onsubmit="return confirm('Êtes-vous sûr de vouloir modifier les informations de votre compte ?');">
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
<div class="profil">
    <div class="photo-container flex-centered">
        <div class="photo"></div>
        <h4><?= $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?></h4>
        <h5><?= $_SESSION['role'] ?></h5>
    </div>
    <form action="../actions/modifyProfil.php" method="post" class="profil-content" onsubmit="return confirm('Êtes-vous sûr de vouloir modifier les informations de votre compte ?');">
        <table class="profil-table">
            <thead>  
                <tr>
                    <th colspan="2">
                        <h2>MODIFIER</h2>
                    </th>     
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><strong><label for="nom">Nom</label></strong></td>
                    <td><strong><label for="prenom">Prenom</label></strong></td>
                </tr>
                <tr>
                    <td><input type="text" name="nom" value="<?= $_SESSION['nom'] ?>" placeholder="Nom"></td>
                    <td><input type="text" name="prenom" value="<?= $_SESSION['prenom'] ?>" placeholder="Prenom"></td>
                </tr>
                <tr>
                    <td colspan="2"><strong><label for="email">Email</label></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="email" value="<?= $_SESSION['email'] ?>" placeholder="Exemple@gmail.com"></td>
                </tr>
                <tr>
                    <td colspan="2"><strong><label for="mot_de_passe">Mot de passe</label></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="password" name="mot_de_passe" placeholder="Mot de passe"></td>
                </tr>
                <!-- ====== Visible pour élèves ====== -->
                <?php if ($_SESSION['role'] === 'enseignant') : ?>
                <tr>
                    <td colspan="2"><strong><label for="id_niveau">Niveau</label></strong></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <select name="id_niveau" class="form-select">
                            <option value="">Choisir un niveau</option>
                        <?php
                            $stmt = $conn->query("SELECT id_niveau, nom_niveau FROM niveaux");
                            while ($row = $stmt->fetch()) {
                                $selected = ($row['id_niveau'] == $id_niveau_actuel) ? "selected" : "";
                            echo "<option value='{$row['id_niveau']}' $selected>{$row['nom_niveau']}</option>";
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><strong><label for="id_departement">Département</label></strong></td>
                </tr>
                
                <?php endif; ?>
            </tbody>
        </table>
            <button type="submit" name="modifier">Confirmer la modification</button>

    </form>
</div>