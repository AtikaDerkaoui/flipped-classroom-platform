<div class="classe-details">
<h1>Détails de la classe</h1>
<div class="classe-card">
<p><strong>Nom de la classe: </strong><?= htmlspecialchars($classe['nom_classe']) ?></p>
<p><strong>Département: </strong><?= htmlspecialchars($classe['nom_departement']) ?></p>
<p><strong>Niveau enseigné: </strong><?= htmlspecialchars($classe['nom_niveau']) ?></p>
<p><strong>Matière (Ou contenu pédagogique): </strong><?= htmlspecialchars($classe['module']) ?></p>
<p><strong>Enseignant: </strong><?= htmlspecialchars($classe['nom_enseignant'])?> <?=htmlspecialchars($classe['prenom_enseignant']) ?></p>
        
<!-- Nombre d'élèves inscrits dans la classe -->
<?php
$sql = "SELECT COUNT(*) AS nb_eleves FROM inscriptions WHERE id_classe = :id_classe";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<p><strong>Nombre d'élèves inscrits : </strong>" . $result['nb_eleves'] . "</p>";
?>

<!-- Etat d'inscription de l'élève et possibilité de s'inscrire à la classe -->
<?php 
    $id_eleve = $_SESSION['user_id'];

    if ($classe) {
        $id_classe = $classe['id_classe'];

        // Vérifier que l'élève n'est pas déjà inscrit
        $verif = $conn->prepare("SELECT * FROM inscriptions WHERE id = :id_eleve AND id_classe = :id_classe");
        $verif->bindParam(':id_eleve', $id_eleve);
        $verif->bindParam(':id_classe', $id_classe);
        $verif->execute();

        if ($verif->rowCount() !== 0) {
            // Vous êtes inscrit à cette classe !
            echo "<div class='inscription-message'>
                    <p> Vous êtes inscrit(e) à cette classe.</p>
                </div>";
            echo '
            <form action="/Memoire/actions/inscriptionClass.php" method="post">
                <input type="hidden" name="id_classe" value="' .   $id_classe  . '">
                <button type="submit" name="quitter-classe" class="btn-danger">Quitter la classe</button>
            </form>
            </div>
            ';
        }else{
            // Formulaire pour s'inscrire à la classe
            echo "<div class='form-inscription-container'>";
            require_once(__DIR__.'/../../includes/inscriptionClass-form.php');
            echo "</div>";
            if (isset($_SESSION['message'])) {
                    echo "<p style='color:red;'>".$_SESSION['message']."</p>";
                    // Supprimer le message après l'affichage
                    unset($_SESSION['message']);
                }
        }
    }
?>
</div>