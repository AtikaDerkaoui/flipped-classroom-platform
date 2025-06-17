<section class="faq-section">
  <h2 class="faq-title">Foire Aux Questions (FAQ)</h2>
  <div class="faq-item">
    <button class="faq-question">Q1. Qui peut utiliser cette plateforme ?</button>
    <div class="faq-answer">Les enseignants, les élèves, et les visiteurs. Chaque rôle a des fonctionnalités spécifiques.</div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Q2. Comment accéder aux vidéos et supports ?</button>
    <div class="faq-answer">Une fois connecté, l’élève accède aux contenus partagés par son enseignant dans sa classe.</div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Q3. Les étudiants peuvent-ils publier sur le forum ?</button>
    <div class="faq-answer">Oui, les élèves et enseignants peuvent créer ou répondre à des sujets.</div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Q4. Comment s'inscrire à une classe ?</button>
    <div class="faq-answer">Dans "Classes", il suffit de choisir une classe et d'entrer le code unique donné par l'enseignant
      pour accéder y accéder ?
    </div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Q5. Des étudiants non inscrits à une classe peuvent il avoir accès à son contenu ?</button>
    <div class="faq-answer">Non, seuls les étudiants inscrits à une classe peuvent accéder à son contenu (Supports, quizz, vidéos...)
    </div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Q6. Y'a t'il une messagerie dans cette plateforme ?</button>
    <div class="faq-answer">Pour le moment, le seul moyen de communication est le forum mais une messagerie peut être envisagée dans le futurr prochain.
    </div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Q7. L'étudiant peut il partager du contenu lui même ?</button>
    <div class="faq-answer">Oui, cela se fait par la section de Cours extérieurs.</div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Q5. Pourquoi le contenu que j'ai partagé a été supprimé soudainement ?</button>
    <div class="faq-answer">Un administrateur peut supprimer du contenu (classes, supports pédagogiques, quizz, vidéo, sujet forum) si celui là était non approprié pour la plateforme.
    </div>
  </div>
</section>


<script>
  const questions = document.querySelectorAll('.faq-question');

  questions.forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.parentElement;
      item.classList.toggle('active');
    });
  });
</script>
