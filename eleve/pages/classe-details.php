<h1>La classe</h1>
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

echo "Nombre d'élèves inscrits : " . $result['nb_eleves'];
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
            echo "<p>Vous êtes inscrit(e) à cette classe.</p>";
            echo '
            <form action="/Memoire/actions/inscriptionClass.php" method="post">
                <input type="hidden" name="id_classe" value="' .   $id_classe  . '">
                <button type="submit" name="quitter-classe">Quitter la classe</button>
            </form>
            ';
        }else{
            // Formulaire pour s'inscrire à la classe
            require_once(__DIR__.'/../../includes/inscriptionClass-form.php');
            if (isset($_SESSION['message'])) {
                    echo "<p style='color:red;'>".$_SESSION['message']."</p>";
                    // Supprimer le message après l'affichage
                    unset($_SESSION['message']);
                }
        }
    }
?>