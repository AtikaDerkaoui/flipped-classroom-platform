<?php
session_start();
include '../connexion.php'; // ou ton fichier de connexion DB

if (isset($_POST['submitQuizz'])) {

$id_classe = intval($_POST['id_classe']);
$id_eleve = $_SESSION['user_id'];
$id_quizz = $_POST['id_quizz'];
$reponses_utilisateur = $_POST['reponses'];

// Vérifier si l'élève a déjà répondu à ce quizz
$stmt = $conn->prepare("SELECT COUNT(*) FROM reponses_etudiants WHERE id_eleve = :id_eleve AND id_quizz = :id_quizz");
$stmt->execute(['id_eleve' => $id_eleve, 'id_quizz' => $id_quizz]);
$deja_repondu = $stmt->fetchColumn();

if ($deja_repondu > 0) {
    echo "<p>Vous avez déjà répondu à ce quizz.</p>";
    exit;
}

$note = 0;
$total_questions = 0;

foreach ($reponses_utilisateur as $id_question => $ids_reponses_donnees) {
    // Récupérer les bonnes réponses
    $stmt = $conn->prepare("SELECT id_reponse FROM reponses WHERE id_question = :id_question AND est_correcte = 1");
    $stmt->execute(['id_question' => $id_question]);
    $bonnes_reponses = $stmt->fetchAll(PDO::FETCH_COLUMN);

    sort($bonnes_reponses);
    sort($ids_reponses_donnees);

    // Comparer les tableaux (exact match)
    if ($bonnes_reponses == $ids_reponses_donnees) {
        $note++;
    }

    // Enregistrer chaque réponse de l'élève
    foreach ($ids_reponses_donnees as $id_reponse) {
        // Vérifier si cette réponse est correcte
        $stmt_check = $conn->prepare("SELECT est_correcte FROM reponses WHERE id_reponse = :id_reponse");
        $stmt_check->execute(['id_reponse' => $id_reponse]);
        $est_correcte = $stmt_check->fetchColumn();

        // Insérer la réponse de l'élève
        $stmt_insert = $conn->prepare("INSERT INTO reponses_etudiants 
                        (id_eleve, id_quizz, id_question, id_reponse, est_correcte_etudiant) 
                        VALUES (:id_eleve, :id_quizz, :id_question, :id_reponse, :est_correcte_etudiant)");
        $stmt_insert->execute([
        'id_eleve' => $id_eleve,
        'id_quizz' => $id_quizz,
        'id_question' => $id_question,
        'id_reponse' => $id_reponse,
        'est_correcte_etudiant' => $est_correcte // 1 ou 0
        ]);
    }

    $total_questions++;
}

// Calcul de la note sur 20
$score = round(($note / $total_questions) * 20, 2);
// Insertion du score dans la table scores_etudiants
$stmt = $conn->prepare("INSERT INTO scores_etudiants (id_eleve, id_quizz, score) VALUES (:id_eleve, :id_quizz, :score)");
$stmt->execute([
    'id_eleve' => $id_eleve,
    'id_quizz' => $id_quizz,
    'score' => $score
]);

if (isset($_POST['id_video'])){
    $id_video = intval($_POST['id_video']);
    header("Location: ../eleve/pages/video.php?page3=video-feedback&id_classe=$id_classe&id_video=$id_video");
    exit;
}else{

    header("Location: ../eleve/pages/classe.php?page2=quizz-standard&id_classe=$id_classe");
    exit;
}
}
?>
