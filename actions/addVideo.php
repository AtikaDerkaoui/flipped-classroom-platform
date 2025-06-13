<?php
session_start();
require_once '../connexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre_video = $_POST['titre_video'];
    $description_video = $_POST['description_video'];
    $id_classe = $_POST['id_classe'];

    $dossier = '../assets/videos/';
    $nom_fichier = basename($_FILES['fichier_url_video']['name']);
    $chemin_fichier_serveur = $dossier . $nom_fichier;
    $chemin_fichier_url = '/Memoire/assets/videos/' . $nom_fichier;

    // Vérifier si le type du fichier est un video
    $allowedTypes = ['video/mp4', 'video/avi', 'video/mpeg', 'video/webm'];

    // Fichier temporaire téléchargé
    $tempFile = $_FILES['fichier_url_video']['tmp_name'];

    // Ouvrir fileinfo pour détecter le vrai type MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $tempFile);
    finfo_close($finfo);

    if (in_array($mimeType, $allowedTypes)) {
    // C'est une vidéo valide
        if (move_uploaded_file($_FILES['fichier_url_video']['tmp_name'], $chemin_fichier_serveur)) {
            $stmt = $conn->prepare("INSERT INTO videos (titre_video, description_video, fichier_url_video, id_classe)
                                VALUES (:titre_video, :description_video, :url, :id_classe)");
            $stmt->bindParam(':titre_video', $titre_video);
            $stmt->bindParam(':description_video', $description_video);
            $stmt->bindParam(':url', $chemin_fichier_url);
            $stmt->bindParam(':id_classe', $id_classe);
            $stmt->execute();
            $_SESSION['message'] = "La capsule vidéo a été ajoutée à la classe avec succés !";
        } else {
            $_SESSION['message'] = "Erreur dans l'upload de la vidéo, veuillez réessayer.";
        }
    } else {
        $_SESSION['message'] = "Fichier invalide : format non reconnu.";
    }

    header("Location: ../enseignant/pages/classe.php?page2=videos&id_classe=$id_classe");
    exit;
}


?>