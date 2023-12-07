document.addEventListener('DOMContentLoaded', function() {
    // Obtenir le modal
    var modal = document.getElementById('myModal');

    // Obtenir le bouton qui ouvre le modal
    var btn = document.getElementById("myBtn");

    // Obtenir l'élément <span> qui ferme le modal
    var span = document.getElementsByClassName("close")[0];

    // Lorsque l'utilisateur clique sur le bouton, ouvrir le modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Lorsque l'utilisateur clique sur <span> (x), fermer le modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Lorsque l'utilisateur clique n'importe où en dehors du modal, le fermer
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
})
