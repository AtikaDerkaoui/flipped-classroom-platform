<?php
session_start();
include '../connexion.php';

if ($_SESSION['role'] !== 'admin') {
    echo "Accès refusé.";
    exit;
}

// ====================== Créer une sous catégorie ======================
if (isset($_POST['createCategory'])) {
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

if (isset($_POST['createTopic'])) {
    $titre = htmlspecialchars($_POST['titre_sujet']);
    $contenu = htmlspecialchars($_POST['contenu_sujet']);
    $id = $_POST['id'];
    $id_categorie = $_POST['id_categorie'];

$stmt = $conn->prepare("INSERT INTO sujets (titre_sujet, contenu_sujet, date_creation_sujet, id, id_categorie) VALUES (:titre, :contenu, NOW(), :id, :id_categorie)");
$stmt->execute([
    'titre' => $titre,
    'contenu' => $contenu,
    'id' => $id,
    'id_categorie' => $id_categorie
]);

header("Location: /Memoire/pages/forum.php");
exit;
}


// ====================== Créer une sous catégorie ======================
if (isset($_POST['createSubCategory'])) {
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
    $id_categorie = $_POST['id_categorie'];

$stmt = $conn->prepare("INSERT INTO sujets (titre_sujet, contenu_sujet, date_creation_sujet, id, id_categorie) VALUES (:titre, :contenu, NOW(), :id, :id_categorie)");
$stmt->execute([
    'titre' => $titre,
    'contenu' => $contenu,
    'id' => $id,
    'id_categorie' => $id_categorie
]);

header("Location: /Memoire/pages/forum-pages.php?page=createTopic");
exit;
}