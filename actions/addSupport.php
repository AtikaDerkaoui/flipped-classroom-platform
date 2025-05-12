<?php
session_start();
require_once '../connexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre_support = $_POST['titre_support'];
    $id_classe = $_POST['id_classe'];

    $dossier = '../assets/uploads/';
    $nom_fichier = basename($_FILES['fichier_url_support']['name']);
    $chemin_fichier_serveur = $dossier . $nom_fichier;
    $chemin_fichier_url = '/Memoire/assets/uploads/' . $nom_fichier;

    // Extraire l'extension
    $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));

    // Déterminer le type selon l'extension
    switch ($extension) {
        case 'pdf':
            $type = 'pdf';
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            $type = 'image';
            break;
        case 'doc':
        case 'docx':
        case 'txt':
            $type = 'doc';
            break;
        default:
            $type = 'autre';
            break;
    }

    // Upload
    if (move_uploaded_file($_FILES['fichier_url_support']['tmp_name'], $chemin_fichier_serveur)) {
        $stmt = $conn->prepare("INSERT INTO supports (titre_support, fichier_url_support, type_support, id_classe) 
                                VALUES (:titre_support, :url, :type, :id_classe)");
        $stmt->bindParam(':titre_support', $titre_support);
        $stmt->bindParam(':url', $chemin_fichier_url);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':id_classe', $id_classe);
        $stmt->execute();

        header("Location: ../enseignant/pages/classe-detail.php?page2=supports&id_classe=$id_classe");
        exit;
    } else {
        echo "Erreur lors de l’upload du fichier.";
    }
}
?>