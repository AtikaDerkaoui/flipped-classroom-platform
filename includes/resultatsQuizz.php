<!-- ====================================================== --> 
<!-- ===== Consulter les notes des eleves ==== -->
<!-- ====================================================== --> 
<?php 
$stmt = $conn->prepare("
  SELECT s.id_eleve, s.score, u.nom, u.prenom
  FROM scores_etudiants s
  JOIN utilisateurs u ON s.id_eleve = u.id
  WHERE s.id_quizz = :id_quizz
");
$stmt->bindParam(':id_quizz', $id_quizz);
$stmt->execute();
$scores = $stmt->fetchAll();
?>

<div class="resultats-container">
<div class="resultats-content">
    <div class="resultats-header space-between">
        <h3>Résultats du Quizz</h3>
        <button class="close-button btn-afficher-resultats-quizz"><i class="fa-solid fa-xmark"></i></button>
    </div>
  <div class="resultats-liste">
    <?php foreach ($scores as $score): ?>
    <div class="resultat-item">
      <span class="eleve-nom"><?= $score['nom'] ?> <?= $score['prenom'] ?></span>
      <span class="eleve-score"><?= $score['score'] ?> / 20</span>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</div>