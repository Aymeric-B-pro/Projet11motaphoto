document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM chargé");

    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxRef = document.getElementById('lightbox-ref');
    const lightboxCategory = document.getElementById('lightbox-category');
    const fullscreenIcons = document.querySelectorAll('.lightbox-trigger');

    // Ajoute un événement de clic à chaque icône pour déclencher la lightbox
    fullscreenIcons.forEach(icon => {
        icon.addEventListener('click', function(event) {
            event.preventDefault();
            console.log("Icône plein écran cliquée");

            const photoUrl = icon.getAttribute('data-photo-url');
            const photoTitle = icon.getAttribute('data-photo-title');
            const photoCategory = icon.getAttribute('data-photo-category');

            // Vérifie les valeurs extraites des attributs data-*
            console.log("URL de la photo:", photoUrl);
            console.log("Titre de la photo:", photoTitle);
            console.log("Catégorie de la photo:", photoCategory);

            // Ouvre la lightbox
            openLightbox(photoUrl, photoTitle, photoCategory);
        });
    });

    // Fonction pour ouvrir la lightbox
    function openLightbox(photoUrl, photoTitle, photoCategory) {
        if (lightbox) {
            lightboxImage.src = photoUrl;
            lightboxRef.textContent = photoTitle || "Référence non disponible";
            lightboxCategory.textContent = photoCategory || "Catégorie non disponible";
            lightbox.style.display = 'flex';
            console.log("Lightbox affichée avec l'URL:", photoUrl);
        } else {
            console.error("La lightbox n'a pas pu être affichée.");
        }
    }

    // Ferme la lightbox
    const closeBtn = document.querySelector('.closelightbox');
    if (closeBtn) {
        closeBtn.onclick = function() {
            lightbox.style.display = 'none';
            console.log("Lightbox fermée");
        };
    } else {
        console.error("Le bouton de fermeture .closelightbox n'a pas été trouvé dans le DOM.");
    }
});

