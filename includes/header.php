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
              <a href="#">Ressources <i class="fa-solid fa-caret-down"></i></a>
              <!-- Dropdown des ressources -->
              <div class="dropdown">
                <!-- Partie gauche des ressources (classe inversée) -->
                <ul>
                  <li> <!-- Ressource 1 -->
                    <img src="assets/img/ressources-pic1.png">
                    <div>
                      <a href="#">Comprendre la classe inversée</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>
                  <!-- Ressource 2 -->
                  <li>
                    <img src="assets/img/ressources-pic2.png">
                    <div>
                      <a href="#">La classe inversée dans le monde</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>
                  <!-- Ressource 3 -->
                  <li>
                    <img src="assets/img/ressources-pic3.png">
                    <div>
                      <a href="#">La classe inversée en Algérie</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>
                </ul>

                <!--  Partie droite des ressources (plateforme) -->
                <ul>
                  <!-- Ressource 1 -->
                  <li>
                    <img src="assets/img/ressources-pic3.png">
                    <div>
                      <a href="#">Apprendre à utiliser la plateforme</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>
                  <!-- Ressource 2 -->
                  <li>
                    <img src="assets/img/ressources-pic3.png">
                    <div>
                      <a href="#">FAQ</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>
                </ul>
              </div>
            </li>

            <?php 
              if(isset($_SESSION['role']) && $_SESSION['role'] === 'eleve'){
                echo"<li><a href='eleve/dashboard.php'>Hello Eleve, " . $_SESSION['nom'] . "<i class='fa-solid fa-caret-down'></i></a></li>";
              }
              elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'enseignant') {
                echo"<li class='dropdown-parent'><a href='enseignant/dashboard.php'>" . $_SESSION['nom'] . " <i class='fa-solid fa-caret-down'></i></a>
                        <ul class='dropdown'>
                          <li><a href='#'>Mon Profil</a></li>
                          <li><a href='#'>Mes Classes</a></li>
                          <li><a href='../actions/logoutAction.php'>Déconnexion</a></li>
                        </ul>
                </li>";
              }else{
                echo"<li><a href='pages/login.php'>Se connecter</a></li>
                <li><a href='pages/register.php' class='btn'>S'inscrire</a></li>
                ";
              }
            ?>
        </ul>

        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
          <i class="fa-solid fa-bars" id="bars"></i>
          <i class="fa-solid fa-xmark" id="xmark"></i>
        </div>
  </nav>
</header>