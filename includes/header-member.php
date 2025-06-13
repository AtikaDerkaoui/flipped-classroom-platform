<!--=============== HEADER ===============-->
<header class="header">
  <nav class="navbar">
    <div class="logo pacifico"><a href="/Memoire/<?= $_SESSION['role'] ?>/dashboard.php">DzDucation <span>Flipped Classroom</span></a></div>
        <ul class="nav-links" id="nav-links">
            <li><a href="/Memoire/forum/forum.php" class="btn">Forum</a></li>
            <li><a href="/Memoire/<?= $_SESSION['role'] ?>/dashboard.php">Accueil</a></li>
            <li class="dropdown-parent ressources">
              <a href="/Memoire/pages/ressources.php?page=ress1">Ressources <i class="fa-solid fa-caret-down"></i></a>
              <div class="dropdown">
                <ul>
                  <li>
                    <img src="/Memoire/assets/img/ressources-pic1.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=ress1">Comprendre la classe inversée</a>
                      <p>Introduction simple au concept de la classe inversée.</p>
                    </div>
                  </li>

                  <li>
                    <img src="/Memoire/assets/img/ressources-pic2.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=ress2">La classe inversée dans le monde</a>
                      <p>Aperçu de l’adoption croissante de cette méthode dans plusieurs pays.</p>
                    </div>
                  </li>

                  <li>
                    <img src="/Memoire/assets/img/ressources-pic3.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=ress3">La classe inversée en Algérie</a>
                      <p>L’évolution progressive de la classe inversée en Algérie et son adoption dans les écoles algériennes.</p>
                    </div>
                  </li>
                </ul>

                <ul>
                  <li>
                    <img src="/Memoire/assets/img/ressources-pic3.png">
                    <div>
                      <a href="#">Apprendre à utiliser la plateforme</a>
                      <p>Instructions simples pour bien naviguer et utiliser la plateforme.</p>
                    </div>
                  </li>

                  <li>
                    <img src="/Memoire/assets/img/ressources-pic3.png">
                    <div>
                      <a href="#">FAQ</a>
                      <p>Réponses rapides aux questions fréquentes des utilisateurs.</p>
                    </div>
                  </li>
                </ul>
              </div>
            </li>

            <li class='dropdown-parent'><a href='/Memoire/<?= $_SESSION['role'] ?>/profil.php?page=infos'><?php echo $_SESSION['nom'] ; ?> <i class='fa-solid fa-caret-down'></i></a>
                <ul class='dropdown menu'>
                    <li><a href='/Memoire/<?= $_SESSION['role'] ?>/profil.php?page=infos'>Mon Profil</a></li>
                    <li><a href='/Memoire/<?= $_SESSION['role'] ?>/dashboard.php'>Mon Espace</a></li>
                    <li><a href='/Memoire/actions/logoutAction.php'>Déconnexion</a></li>
                </ul>
            </li>
              
        </ul>

        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
          <i class="fa-solid fa-bars" id="bars"></i>
          <i class="fa-solid fa-xmark" id="xmark"></i>
        </div>
  </nav>
</header>