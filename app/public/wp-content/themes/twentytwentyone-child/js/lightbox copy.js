document.addEventListener('DOMContentLoaded', function() {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxRef = document.getElementById('lightbox-ref');
    const lightboxCategory = document.getElementById('lightbox-category');
    const closeBtn = document.querySelector('.closelightbox');
    const prevLink = document.getElementById('prev-link');
    const nextLink = document.getElementById('next-link');

    let currentIndex = 0;
    const photoLinks = document.querySelectorAll('.lightbox-trigger'); // Sélectionner tous les déclencheurs de la lightbox

    // Ouvrir la lightbox
    photoLinks.forEach((link, index) => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le comportement par défaut
            currentIndex = index; // Met à jour l'index actuel
            openLightbox(link);
        });
    });

    function openLightbox(link) {
        const photoUrl = link.dataset.photoUrl; // Utiliser l'URL de l'image depuis les données
        const reference = link.querySelector('.photo-info .photo-ref') ? link.querySelector('.photo-info .photo-ref').innerText : 'Référence non disponible';
        const category = link.querySelector('.photo-info .photo-category') ? link.querySelector('.photo-info .photo-category').innerText : 'Catégorie non disponible';
        
        lightboxImage.src = photoUrl;
        lightboxRef.textContent = reference;
        lightboxCategory.textContent = category;

        // Afficher la lightbox
        lightbox.style.display = 'flex';

        // Mettre à jour les liens précédent et suivant
        updateNavigation();
    }

    // Fermer la lightbox
    closeBtn.onclick = function() {
        lightbox.style.display = 'none';
    };

    // Navigation précédente et suivante
    prevLink.onclick = function(e) {
        e.preventDefault();
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : photoLinks.length - 1; // Boucle à la dernière image
        openLightbox(photoLinks[currentIndex]);
    };

    nextLink.onclick = function(e) {
        e.preventDefault();
        currentIndex = (currentIndex < photoLinks.length - 1) ? currentIndex + 1 : 0; // Boucle à la première image
        openLightbox(photoLinks[currentIndex]);
    };

    // Mettre à jour la navigation
    function updateNavigation() {
        prevLink.style.display = currentIndex === 0 ? 'none' : 'block';
        nextLink.style.display = currentIndex === photoLinks.length - 1 ? 'none' : 'block';
    }
});