<!--=============== HEADER ===============-->
<header class="header">
  <nav class="navbar">
        
    <div class="logo pacifico"><a href="/Memoire/<?= $_SESSION['role'] ?>/dashboard.php">DzDucation : Forum</a></div>
        <ul class="nav-links" id="nav-links">
            <li><a href="/Memoire/<?= $_SESSION['role'] ?>/dashboard.php">Accueil</a></li>
            <li class="dropdown-parent ressources">
              <a href="/Memoire/pages/ressources.php?page=ress1">Ressources <i class="fa-solid fa-caret-down"></i></a>
              <div class="dropdown">
                <ul>
                  <li>
                    <img src="/Memoire/assets/img/ressources-pic1.png">
                    <!--<img src="../assets/img/ressources-pic1.png">-->
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=ress1">Comprendre la classe inversée</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>

                  <li>
                    <img src="/Memoire/assets/img/ressources-pic2.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=ress2">La classe inversée dans le monde</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>

                  <li>
                    <img src="/Memoire/assets/img/ressources-pic3.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=ress3">La classe inversée en Algérie</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>
                </ul>

                <ul>
                  <li>
                    <img src="/Memoire/assets/img/ressources-pic3.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=guide">Apprendre à utiliser la plateforme</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>

                  <li>
                    <img src="/Memoire/assets/img/ressources-pic3.png">
                    <div>
                      <a href="/Memoire/pages/ressources.php?page=faq">FAQ</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>
                </ul>
              </div>
            </li>

            <li class='dropdown-parent'>
              <a href='/Memoire/<?= $_SESSION['role'] ?>/profil.php?page=infos'><?= $_SESSION['nom'] ?> <i class='fa-solid fa-caret-down'></i></a>
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