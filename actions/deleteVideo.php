<?php
session_start();
require_once '../connexion.php';


if (isset($_POST['deleteVideo'])) {
    $id_video = $_POST['id_video'];
    $id_classe = $_POST['id_classe'];
    $role = $_SESSION['role'];
    

    $stmt = $conn->prepare("DELETE FROM videos WHERE id_video = :id_video");
    $stmt->bindParam(':id_video', $id_video);
    $stmt->execute();

    header("Location: ../$role/pages/classe.php?page2=videos&id_classe=$id_classe");
}

?>