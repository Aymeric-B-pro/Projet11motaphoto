document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM chargé");

    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxRef = document.getElementById('lightbox-ref');
    const lightboxCategory = document.getElementById('lightbox-category');
    
    if (!lightbox || !lightboxImage || !lightboxRef || !lightboxCategory) {
        console.error("La lightbox ou ses éléments manquent dans le DOM.");
        return;
    }

    // Sélectionner toutes les icônes de plein écran
    const fullscreenIcons = document.querySelectorAll('.lightbox-trigger');

    // Ajouter un événement de clic à chaque icône pour déclencher la lightbox
    fullscreenIcons.forEach(icon => {
        icon.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien si nécessaire
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
        lightboxImage.src = photoUrl;
        lightboxRef.textContent = photoTitle || "Référence non disponible";
        lightboxCategory.textContent = photoCategory || "Catégorie non disponible";
        lightbox.style.display = 'flex';
        console.log("Lightbox affichée avec l'URL:", photoUrl);
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

