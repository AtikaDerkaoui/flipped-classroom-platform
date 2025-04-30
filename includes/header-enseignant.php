<!--=============== HEADER ===============-->
<header class="header">
  <nav class="navbar">
        
    <div class="logo pacifico"><a href="dashboard.php">DzDucation</a></div>
        <ul class="nav-links" id="nav-links">
            <li><a href="#" class="btn">Messagerie</a></li>
            <li class="dropdown-parent ressources">
              <a href="#">Ressources <i class="fa-solid fa-caret-down"></i></a>
              <div class="dropdown">
                <ul>
                  <li>
                    <img src="../assets/img/ressources-pic1.png">
                    <div>
                      <a href="#">Comprendre la classe inversée</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>

                  <li>
                    <img src="../assets/img/ressources-pic2.png">
                    <div>
                      <a href="#">La classe inversée dans le monde</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>

                  <li>
                    <img src="../assets/img/ressources-pic3.png">
                    <div>
                      <a href="#">La classe inversée en Algérie</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>
                </ul>

                <ul>
                  <li>
                    <img src="../assets/img/ressources-pic3.png">
                    <div>
                      <a href="#">Apprendre à utiliser la plateforme</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>

                  <li>
                    <img src="../assets/img/ressources-pic3.png">
                    <div>
                      <a href="#">FAQ</a>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ipsam illo.</p>
                    </div>
                  </li>
                </ul>
              </div>
            </li>

            <li class='dropdown-parent'><a href='profil.php'><?php echo $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ; ?> <i class='fa-solid fa-caret-down'></i></a>
                <ul class='dropdown'>
                    <li><a href='profil.php'>Mon Profil</a></li>
                    <li><a href='dashboard.php'>Mon Espace</a></li>
                    <li><a href='/../Memoire/actions/logoutAction.php'>Déconnexion</a></li>
                </ul>
            </li>
              
        </ul>

        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
          <i class="fa-solid fa-bars" id="bars"></i>
          <i class="fa-solid fa-xmark" id="xmark"></i>
        </div>
  </nav>
</header>