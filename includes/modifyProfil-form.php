<div class="profil">
    <div class="photo-container flex-centered">
        <div class="photo"></div>
        <h4><?= $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?></h4>
        <h5><?= $_SESSION['role'] ?></h5>
    </div>
    <form action="../actions/modifyProfil.php" method="post" class="profil-content form" onsubmit="return confirm('Êtes-vous sûr de vouloir modifier les informations de votre compte ?');">
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
                <?php if ($_SESSION['role'] === 'eleve') : ?>
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
                <tr>
                    <td colspan="2">
                        <select name="id_departement" class="form-select">
                            <option value="">Choisir un département</option>
                        <?php
                            $stmt2 = $conn->query("SELECT id_departement, nom_departement FROM departements");
                            while ($row = $stmt2->fetch()) {
                                $selected2 = ($row['id_departement'] == $id_departement_actuel) ? "selected" : "";
                            echo "<option value='{$row['id_departement']}' $selected2>{$row['nom_departement']}</option>";
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
            <button type="submit" name="modifier" class="bouton-standard btn-blue">Confirmer la modification</button>

    </form>
</div>