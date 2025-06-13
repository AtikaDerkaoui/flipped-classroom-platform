<?php
  session_start();

  // Vérifier si l'utilisateur est déjà connecté
  if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['role'];
    // Si l'utilisateur est connecté, rediriger vers dashboard.php
    header("Location: $role/dashboard.php");
    exit(); 
  }
  // Le head
  $titre = "DzDucation - Accueil"; // titre de la page
  require_once(__DIR__.'/includes/head.php');
?>

<body>
    <!-- Le header -->
    <?php require_once(__DIR__.'/includes/header.php');
    ?>

    <section class="principal space-around">
      <div class="left-part flex-centered">
        <p>DzDucation : l'éducation repensée avec la classe inversée, 
        des cours interactifs, une communauté engagée, et des outils 
        pour apprendre, partager et échanger à votre rythme.
        </p>
      
        <a href="pages/register.php" class="btn">Commencez</a>
      </div>
    
      <div class="right-part flex-centered">
        <div class="img-container">
          <img src="assets/img/thumbs-up.png">
        </div>
      </div>

      <img src="/../Memoire/assets/img/wave.png" class="design-wave">
    </section>
    
    <section class="classe-inversee">
      <h1>Comment fonctionne<br> la classe inversée ?</h1>
      
      <div class="space-around">
        <div class="flex-centered">
          <img src="/../Memoire/assets/img/acc-sec2-1.png">
          <p>
            Permets à tes étudiants de découvrir les notions 
            clés avant la classe pour arriver préparés et prêts 
            à interagir.
          </p>
        </div>
        <div class="flex-centered">
          <img src="/../Memoire/assets/img/acc-sec2-2.png">
          <p>
            Prépare des vidéos capsules claires pour expliquer 
            les bases du cours, que les étudiants peuvent visionner 
            à leur rythme.
          </p>
        </div>
        <div class="flex-centered">
          <img src="/../Memoire/assets/img/acc-sec2-3.png">
          <p>
            Évalue la compréhension avec des quiz et donne 
            un feedback instantané pour aider les étudiants 
            à progresser efficacement.
          </p>
        </div>
      </div>
    </section>

    <section class="fonc">
      <h1>DzDucation : Transformer votre façon <br>d'enseigner</h1>

      <div class="partie space-around">
        <img src="/Memoire/assets/img/acc-sec3-1.png">
        <div>
          <h3>Ressources à portée de main</h3>
          <p>
            Organisez, téléchargez et partagez facilement vos 
            supports pédagogiques, qu’il s’agisse de cours, de 
            documents d’exercice ou de notes de révision. Vos 
            étudiants auront un accès instantané à tout le 
            matériel nécessaire pour réussir.
          </p>
        </div>
      </div>

      <div class="partie space-around">
        <img src="/Memoire/assets/img/acc-sec3-2.png">
        <div>
          <h3>Capsules vidéo avec Feedback</h3>
          <p>
            Créez des vidéos interactives avec des questions 
            intégrées pour vérifier en temps réel la compréhension 
            des étudiants et adapter votre enseignement.
          </p>
        </div>
      </div>

      <div class="partie space-around">
        <img src="/Memoire/assets/img/acc-sec3-3.png">
        <div>
          <h3>Docs et cartes mentales</h3>
          <p>
            Proposez des documents (Word, PDF) et des 
            cartes mentales pour aider vos étudiants à mieux 
            organiser et comprendre les concepts enseignés.
          </p>
        </div>
      </div>

      <div class="partie space-around">
        <img src="/Memoire/assets/img/acc-sec3-4.png">
        <div>
          <h3>Quizz et Feedback</h3>
          <p>
            Créez des quiz pour évaluer les progrès de vos étudiants 
            et obtenez des rapports détaillés afin de personnaliser 
            vos retours et ajuster l’enseignement.
          </p>
        </div>
      </div>

      <img src="/Memoire/assets/img/acc-sec3-design1.png" class="design1">
      <img src="/Memoire/assets/img/acc-sec3-design2.png" class="design2">
    </section>

    <section class="acc-forum">
      <h1>Discutez et échangez avec la communauté</h1>
      <div class="space-around">
        <img src="/Memoire/assets/img/forum.png">
        <div>
          <p>
            Le forum crée une communauté interactive où questions, idées 
            et échanges enrichissent l’apprentissage pour tous !
          </p>
          <a href="/Memoire/forum/forum.php" class="btn">Accéder au forum</a>
          
          <img src="/Memoire/assets/img/forum-vector.png">
        </div>
      </div>
    </section>

    <section class="rejoindre">
      
    </section>

    <footer>
      <div class="space-around">
      <ul>
        <li><h4>Ressources</h5></li>
        <li><a href="/Memoire/pages/ressources.php?page=ress1">Comprendre la classe inversée</a></li>
        <li><a href="/Memoire/pages/ressources.php?page=ress2">La classe inversée dans le monde</a></li>
        <li><a href="/Memoire/pages/ressources.php?page=ress3">La classe inversée en Algérie</a></li>
      </ul>

      <ul>
        <li><h4>Communauté</h5></li>
        <li><a href="#">Facebook</a></li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">Instagram</a></li>
      </ul>

      <ul>
        <li><h4>Communiquer</h5></li>
        <li><a href="/Memoire/pages/forum/forum.php">Forum</a></li>
      </ul>

      <ul>
        <li><h4>A propos</h5></li>
        <li><a href="#">A propos de nous</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      </div>

      <p>@ 2025 DzDucation</p>

    </footer>
</body>
</html>
