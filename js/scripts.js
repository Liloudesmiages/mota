//Lien contact vers la modale
document.addEventListener("DOMContentLoaded", function () {
  var modal = document.getElementById("myModal"); // fenêtre modale
  var contactMenuLink = document.getElementById("menu-item-69"); // lien de menu
  var contactMenuLinkMobile = document.querySelector("#primary-menu2 .menu-item-69 a"); // lien de menu

  contactMenuLink.addEventListener("click", function (event) {
    event.preventDefault(); // Empêche la navigation vers le lien (ne recharge pas la page ou ne suit pas l'URL du lien)
    modal.style.display = "block"; // Affiche la fenêtre modale
  }); 

  contactMenuLinkMobile.addEventListener("click", function (event) {
    event.preventDefault(); // Empêche la navigation vers le lien (ne recharge pas la page ou ne suit pas l'URL du lien)
    modal.style.display = "block"; // Affiche la fenêtre modale
  });

// Fermer la modale lorsque l'utilisateur 
  var modal = document.getElementById("myModal");
  var closeModal = document.querySelector(".close-modal");

  if (closeModal) {
    closeModal.addEventListener("click", function () {
      modal.style.display = "none";
    });
  }

  // Obtenir le bouton qui ouvre la modale
  var btn = document.getElementById("myBtn");
  // Obtenir la modale
  var modal = document.getElementById("myModal");

  // Ouvrir la modale lorsque l'utilisateur clique sur le bouton
  btn.onclick = function () {
    modal.style.display = "block";
  };
});

// MENU
document.addEventListener("DOMContentLoaded", function () {
  // Sélection du conteneur du menu
  const menu = document.getElementById("menu-content");

  // Sélection du bouton du menu hamburger
  const button = document.querySelector(".menu-toggle");

  // Vérifie si les éléments nécessaires existent
  if (!menu || !button) {
    console.error(
      "Les éléments nécessaires pour le menu ne sont pas présents."
    );
    return;
  }

  // Fonction pour basculer l'affichage du menu et l'état du bouton
  function toggleMenu() {
    // Bascule la classe 'menu-opened' sur le bouton
    button.classList.toggle("menu-opened");

    // Bascule l'attribut 'aria-expanded' pour l'accessibilité
    const isExpanded = button.getAttribute("aria-expanded") === "true";
    button.setAttribute("aria-expanded", !isExpanded);

    // Bascule l'affichage du menu
    menu.classList.toggle("toggled");
  }

  // Ajoute un écouteur d'événements au bouton
  button.addEventListener("click", function (event) {
    toggleMenu();
  });

  // Ajoute des écouteurs d'événements aux liens pour fermer le menu après un clic
  let liens = document.querySelectorAll(".menu-liens a");
  liens.forEach((element) => {
    element.addEventListener("click", function () {
      toggleMenu();
    });
  });
});

// ajax accueil
let pagenumber = 1;

function loadajax() {
  var category = document.querySelector("#select1").value;
  var format = document.querySelector("#select2").value;
  var tri = document.querySelector("#select3").value;

  // données à envoyer
  var data = {
    action: "filter_photos",
    ajax_nonce: ajax_object.ajax_nonce,
    categorie: category,
    format: format,
    pagenumber: pagenumber,
    tri: tri,
  };
  fetch(ajax_object.ajax_url, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      "Cache-Control": "no-cache",
    },
    body: new URLSearchParams(data),
  })
    .then((response) => {
      console.log("Réponse reçue", response);
      if (!response.ok) {
        throw new Error("Erreur du réseau");
      }
      return response.text();
    })
    .then((data) => {
      // réponse Ajax
      document.querySelector("#photos-catalogues").innerHTML = data;

      let maxpages = document.querySelector("#maxpages"); // input
      let boutonm = document.querySelector("#charger-plus"); // bouton
      
      if (maxpages.value == 1) {
        boutonm.style.display = "none";
      } else {
        boutonm.style.display = "block";
      }
    })
    .catch((error) => {
      console.error("Erreur:", error);
    });
}

document.addEventListener("DOMContentLoaded", function () {
  loadajax();

  let boutonmore = document.querySelector("#charger-plus"); // bouton
  boutonmore.addEventListener("click", function () {
    pagenumber++;
    loadajax();
  });
  //Lorsqu'un select est modifié, réinitialisation de la p et appel de loadajax pour recharger les données avec les nouveaux filtres.
  let allselect = document.querySelectorAll("select");
  allselect.forEach((e) => {
    e.addEventListener("change", function () {
      pagenumber = 1;
      loadajax();
    });
  });
});

//Initialisation de la fancybox
document.addEventListener("DOMContentLoaded", function () {
  Fancybox.bind("[data-fancybox]", {
    buttons: ["close"],
    infobar: false,
    arrows: true,
    loop: false,
  });
});

//Miniatures avec flèches
document.addEventListener("DOMContentLoaded", function() {
  const flechePrecedente = document.getElementById("fleche-precedente");
  const flecheSuivante = document.getElementById("fleche-suivante");
  const previmg = document.querySelector("#conteneur-miniature .previmg");
  const nextimg = document.querySelector("#conteneur-miniature .nextimg");

  // Vérifiez si les éléments existent avant d'attacher les écouteurs d'événements
  if (flechePrecedente && previmg) {
      flechePrecedente.addEventListener("mouseover", function() {
          previmg.style.display = "block";
      });

      flechePrecedente.addEventListener("mouseout", function() {
          previmg.style.display = "none";
      });
  }

  if (flecheSuivante && nextimg) {
      flecheSuivante.addEventListener("mouseover", function() {
          nextimg.style.display = "block";
      });

      flecheSuivante.addEventListener("mouseout", function() {
          nextimg.style.display = "none";
      });
  }
});

