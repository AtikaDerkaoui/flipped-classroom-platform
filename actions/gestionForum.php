<?php
session_start();
include '../connexion.php';


// ====================== Créer une sous catégorie ======================
if (isset($_POST['createCategory'])) {
if ($_SESSION['role'] !== 'admin') {
    echo "Accès refusé.";
    exit;
}
$titre = htmlspecialchars($_POST['titre']);
$description = htmlspecialchars($_POST['description']);

$stmt = $conn->prepare("INSERT INTO categories (titre_categorie, description_categorie, date_creation_categorie) VALUES (:titre, :description, NOW())");
$stmt->execute([
    'titre' => $titre,
    'description' => $description
]);

header("Location: ../forum/forum.php?message=ajout_ok");
exit;
}


// ====================== Créer une sous catégorie ======================
if (isset($_POST['createSubCategory'])) {
if ($_SESSION['role'] !== 'admin') {
    echo "Accès refusé.";
    exit;
}
$titre = htmlspecialchars($_POST['titre']);
$description = htmlspecialchars($_POST['description']);
$id_categorie = htmlspecialchars($_POST['id_categorie']);

$stmt = $conn->prepare("INSERT INTO sub_categories (titre_sub, description_sub, date_creation_sub, id_categorie) VALUES (:titre, :description, NOW(), :id_categorie)");
$stmt->execute([
    'titre' => $titre,
    'description' => $description,
    'id_categorie' => $id_categorie
]);

header("Location: ../forum/forum.php?message=ajout_ok");
exit;
}


// ====================== Créer un sujet ======================
if (isset($_POST['createTopic'])) {
    $titre = htmlspecialchars($_POST['titre_sujet']);
    $contenu = htmlspecialchars($_POST['contenu_sujet']);
    $id = $_POST['id'];
    $id_sub = $_POST['id_sub'];

$stmt = $conn->prepare("INSERT INTO sujets (titre_sujet, contenu_sujet, date_creation_sujet, id, id_sub) VALUES (:titre, :contenu, NOW(), :id, :id_sub)");
$stmt->execute([
    'titre' => $titre,
    'contenu' => $contenu,
    'id' => $id,
    'id_sub' => $id_sub
]);

header("Location: /Memoire/forum/pages/sujets.php?id_sub=$id_sub");
exit;
}

if (isset($_POST['ajouterReponse'])) {
    if (!isset($_SESSION['user_id'])) {
        // Redirection si l'utilisateur n'est pas connecté
        header("Location: /Memoire/pages/login.php");
        exit;
    }

    $id = $_SESSION['user_id']; // ID de l'utilisateur connecté
    $id_sujet = $_POST['id_sujet'];
    $contenu = htmlspecialchars($_POST['contenu_reponse']);

    if (!empty($contenu)) {
        $stmt = $conn->prepare("INSERT INTO reponses_sujets (id, id_sujet, contenu_reponse_sujet, date_creation_reponse_sujet)
                                VALUES (:id, :id_sujet, :contenu, NOW())");
        $stmt->execute([
            'id' => $id,
            'id_sujet' => $id_sujet,
            'contenu' => $contenu
        ]);
    }

    // Retourner à la page du sujet
    header("Location: /Memoire/forum/pages/sujet.php?id_sujet=$id_sujet&id_sub=$id_sub");
    exit;
}