<!--=============== HEADER ===============-->
<header class="header">
  <nav class="navbar">
        
    <div class="logo pacifico"><a href="/Memoire/index.php">DzDucation <span>Flipped Classroom</span></a></div>
        
    <!-- Vérifier si l'user est dans les pages 'register/login' -->
    <?php
      $currentPage = basename($_SERVER['PHP_SELF']);
      if ($currentPage === 'register.php') {
        echo "
        <ul class='nav-links' id='nav-links'>
          <li><a href='login.php'>Vous avez déjà un compte ? Se connecter</a></li>
        </ul>
        </nav>
        </header>
        ";
      return; // arrête ici pour ne pas afficher le reste du header
      }elseif($currentPage === 'login.php'){
        echo "
        <ul class='nav-links' id='nav-links'>
          <li><a href='register.php'>Vous n'êtes pas encore membre ? S'inscrire</a></li>
        </ul>
        </nav>
        </header>
        ";
        return;
      }
    ?>
        <!-- La partie droite du navbar (ressources et inscription) -->
        <ul class="nav-links" id="nav-links">
            <li class="dropdown-parent ressources">
              <a href="/Memoire/pages/ressources.php?page=ress1">Ressources <i class="fa-solid fa-caret-down"></i></a>
              <!-- Dropdown des ressources -->
              <div class="dropdown">
                <!-- Partie gauche des ressources (classe inversée) -->
                <ul>
                  <li> <!-- Ressource 1 -->
                    <img src="/Memoire/assets/img/ressources-pic1.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=ress1">Comprendre la classe inversée</a>
                      <p>Introduction simple au concept de la classe inversée.</p>
                    </div>
                  </li>
                  <!-- Ressource 2 -->
                  <li>
                    <img src="/Memoire/assets/img/ressources-pic2.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=ress2">La classe inversée dans le monde</a>
                      <p>Aperçu de l’adoption croissante de cette méthode dans plusieurs pays.</p>
                    </div>
                  </li>
                  <!-- Ressource 3 -->
                  <li>
                    <img src="/Memoire/assets/img/ressources-pic3.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=ress3">La classe inversée en Algérie</a>
                      <p>L’évolution progressive de la classe inversée en Algérie et son adoption dans les écoles algériennes.</p>
                    </div>
                  </li>
                </ul>

                <!--  Partie droite des ressources (plateforme) -->
                <ul>
                  <!-- Ressource 1 -->
                  <li>
                    <img src="/Memoire/assets/img/ressources-pic3.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=guide">Apprendre à utiliser la plateforme</a>
                      <p>Instructions simples pour bien naviguer et utiliser la plateforme.</p>
                    </div>
                  </li>
                  <!-- Ressource 2 -->
                  <li>
                    <img src="/Memoire/assets/img/ressources-pic3.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=faq">FAQ</a>
                      <p>Réponses rapides aux questions fréquentes des utilisateurs.</p>
                    </div>
                  </li>
                </ul>
              </div>
            </li>

            
              <li><a href='/Memoire/pages/login.php'>Se connecter</a></li>
                <li><a href='/Memoire/pages/register.php' class='btn'>S'inscrire</a></li>
              

          
        </ul>

        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
          <i class="fa-solid fa-bars" id="bars"></i>
          <i class="fa-solid fa-xmark" id="xmark"></i>
        </div>
  </nav>
</header>