function toggleMenu(){
    document.getElementById("nav-links").classList.toggle('show');
    document.getElementById("bars").classList.toggle('hide');
    document.getElementById("xmark").classList.toggle('show');
}

/* Inscription utilisateur: si role = eleve, il doit choisir son niveau */
function toggleStudent(role) {
    document.getElementById('student-field').style.display = (role === 'eleve') ? 'flex' : 'none';
}

/* Affichagee du formulaire pour ajouter une nouvelle classe */
function afficherFormulaireClasse(){
    document.getElementById("ajout-classe-form").classList.toggle('show');
}