<div class="profil">
    <div class="photo-container flex-centered">
        <div class="photo"></div>
        <h4><?= $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?></h4>
        <h5><?= $_SESSION['role'] ?></h5>
    </div>
    <div class="profil-content">
        <table class="profil-table">
            <thead>  
                <tr>
                    <th colspan="2">
                        <h2>MES INFORMATIONS</h2>
                    </th>     
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><strong>Nom</strong></td>
                    <td><strong>Prenom</strong></td>
                </tr>
                <tr>
                    <td><?= $_SESSION['nom'] ?></td>
                    <td><?= $_SESSION['prenom'] ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Email</strong></td>
                </tr>
                <tr>
                    <td colspan="2"><?= $_SESSION['email'] ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Rôle</strong></td>
                </tr>
                <tr>
                    <td colspan="2"><?= $_SESSION['role'] ?></td>
                </tr>
            </tbody>
        </table>
        <form action="../actions/deleteAccount.php" method="post" class="profil-form-delete" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <button type="submit" name="supprimer-compte" class="bouton-standard btn-blue">Supprimer le compte</button>
        </form>
    </div>
</div>