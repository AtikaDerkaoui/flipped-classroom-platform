<?php
session_start();
require_once '../connexion.php';

// Vérifier que le formulaire est bien soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre_support = $_POST['titre_support'];
    $type = $_POST['type_support'];
    $id_classe = $_POST['id_classe'];

    // Dossier de destination
    $dossier = '../assets/uploads/';
    $nom_fichier = basename($_FILES['fichier_url_support']['name']);
    $chemin_fichier_serveur = $dossier . $nom_fichier; // Pour déplacer le fichier
    $chemin_fichier_url = '/Memoire/assets/uploads/' . $nom_fichier; // Pour l'enregistrement dans la base

    // Upload du fichier
    if (move_uploaded_file($_FILES['fichier_url_support']['tmp_name'], $chemin_fichier_serveur)) {
        // Sauvegarder les infos dans la base de données
        $stmt = $conn->prepare("INSERT INTO supports (titre_support, fichier_url_support, type_support, id_classe) 
                                VALUES (:titre_support, :url, :type, :id_classe)");
        $stmt->bindParam(':titre_support', $titre_support);
        $stmt->bindParam(':url', $chemin_fichier_url);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':id_classe', $id_classe);
        $stmt->execute();

        //header("Location: ../enseignant/pages/supports.php?id_classe=$id_classe");
        header("Location: ../enseignant/pages/classe-detail.php?page2=supports&id_classe=$id_classe");
        exit;
    } else {
        echo "Erreur lors de l’upload du fichier.";
    }
}
?>
