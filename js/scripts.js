document.addEventListener('DOMContentLoaded', function() {
    /*
    // Obtenir le bouton qui ouvre la modale
    var btn = document.getElementById("myBtn");

    // Obtenir la modale
    var modal = document.getElementById("myModal");

    // Ouvrir la modale lorsque l'utilisateur clique sur le bouton
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Fermer la modale lorsque l'utilisateur clique en dehors du contenu de la modale
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    //Lien contact du menu vers la modale
    var contactMenuLink = document.querySelector('.open-contact-modal'); // Utilisez la classe que vous avez ajoutée

    contactMenuLink.addEventListener('click', function(e) {
        e.preventDefault(); // Empêche la navigation par défaut
        document.getElementById('myBtn').click(); // Déclenche le clic sur le bouton
    });

    // Image aléatoire pour le hero
    var hero = document.getElementById('hero');
    var images = [
        '../assets/amoureux-dansant.jpg', 
        '../assets/concert.jpg', 
        '../assets/dansons.jpg', 
        '../assets/preparatifs.jpg', 
        '../assets/trinquons.jpg', 
        '../assets/buvons.jpg', 
        '../assets/mariage.jpg', 
        '../assets/demoiselles-d-honneur.jpg', 
        '../assets/maries.jpg', 
        '../assets/match.jpg', 
        '../assets/anniversaire.jpg', 
        '../assets/baiser-des-maries.jpg', 
        '../assets/bal-masque.jpg', 
        '../assets/maries.jpg', 
    ];

    var bgImage = images[Math.floor(Math.random() * images.length)];

    // Définissez l'image comme fond du hero
    hero.style.backgroundImage = 'url(' + bgImage + ')';
*/
    //MENU
  const menu = document.getElementById("menu-content"); // Utilisation de l'ID du conteneur du menu
  // Sélection du bouton
  const button = document.querySelector(".menu-toggle"); // Utilisation du sélecteur de classe pour le bouton

  // Fonction pour changer basculer(toggle) le menu et l'icône du bouton
  function toggleMenu() {
    button.classList.toggle("menu-opened");
    menu.classList.toggle("toggled");
    const isExpanded = button.getAttribute("aria-expanded") === "true";
    button.setAttribute("aria-expanded", !isExpanded);
  }
  // Écouteur d'événement pour le bouton
  button.addEventListener("click", function (event) {
    toggleMenu();
  });

  //redirection des liens
  let liens = document.querySelectorAll(".menu-liens a");
  liens.forEach((element) => {
    element.addEventListener("click", function () {
      toggleMenu();
    });
  });
});



