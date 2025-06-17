<?php
session_start();
require_once '../connexion.php';


if (isset($_POST['addCoursExt'])) {
    $titre_cours = $_POST['titre_cours'];
    $id = $_POST['id'];
    $role = $_SESSION['role'];

    $dossier = '../assets/uploads/';
    $nom_fichier = basename($_FILES['fichier_url_cours']['name']);
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
    if (move_uploaded_file($_FILES['fichier_url_cours']['tmp_name'], $chemin_fichier_serveur)) {
        $stmt = $conn->prepare("INSERT INTO cours_ext (titre_cours, fichier_url_cours, type_cours, id) 
                                VALUES (:titre_cours, :url, :type, :id)");
        $stmt->bindParam(':titre_cours', $titre_cours);
        $stmt->bindParam(':url', $chemin_fichier_url);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ../$role/dashboard.php?page=cours-ext");
        exit;
    } else {
        echo "Erreur lors de l’upload du fichier.";
    }
}

if (isset($_POST['deleteCoursExt'])) {
    $id_cours = $_POST['id_cours'];
    $role = $_SESSION['role'];

    $stmt = $conn->prepare("DELETE FROM cours_ext WHERE id_cours = :id_cours");
    $stmt->bindParam(':id_cours', $id_cours);
    $stmt->execute();

    header("Location: ../$role/dashboard.php?page=cours-ext");
    exit;
}
?>