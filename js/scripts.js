document.addEventListener('DOMContentLoaded', function() {
    // Obtenir le bouton qui ouvre la modale
    var btn = document.getElementById("myBtn");

    // Obtenir la modale
    var modal = document.getElementById("myModal");

    // Ouvrir la modale lorsque l'utilisateur clique sur le bouton
   /* btn.onclick = function() {
        modal.style.display = "block";
    }

    // Fermer la modale lorsque l'utilisateur clique en dehors du contenu de la modale
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }*/

    //Lien contact du menu vers la modale
    var contactMenuLink = document.querySelector('.open-contact-modal'); // Utilisez la classe que vous avez ajoutée

    contactMenuLink.addEventListener('click', function(e) {
        e.preventDefault(); // Empêche la navigation par défaut
        document.getElementById('myBtn').click(); // Déclenche le clic sur le bouton
    });

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

//Requête AJAX
jQuery(document).ready(function($) {
  function filterPhotos() {
      var categorie = $('#categorie-select').val();
      var format = $('#format-select').val();

      $.ajax({
          url: ajaxurl, // variable doit être définie dans WordPress
          type: 'POST',
          data: {
              action: 'filter_photos', // Le nom de l'action WordPress à exécuter
              categorie: categorie,
              format: format
          },
          success: function(response) {
              $('#photos-container').html(response); // Mettez à jour la liste des photos
          }
      });
  }

  // Ajoutez des écouteurs d'événements pour les champs de sélection
  $('#categorie-select, #format-select').on('change', function() {
      filterPhotos();
  });
});
});

