document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM chargé et script prêt à s'exécuter.");

    // Fonction pour récupérer toutes les URLs d'image
    function getAllImageUrls() {
        const imageLinks = document.querySelectorAll('.lightbox-trigger');
        const images = [];

        imageLinks.forEach(link => {
            const photoUrl = link.getAttribute('data-photo-url');
            if (photoUrl) {
                images.push(photoUrl);
            }
        });

        console.log("Tableau des URLs d'image :", images);
        return images;
    }

    // Initialisation des URLs d'image et de l'index actuel
    let images = getAllImageUrls();
    let currentIndex = -1;

    // Utiliser Event Delegation pour écouter les clics sur le document
    document.addEventListener('click', function(event) {
        const link = event.target.closest('.lightbox-trigger');
        if (!link) return; // Si l'élément cliqué n'est pas un déclencheur de lightbox, on ignore

        event.preventDefault();
        images = getAllImageUrls(); // Mettre à jour la liste des images
        currentIndex = Array.from(document.querySelectorAll('.lightbox-trigger')).indexOf(link);

        if (currentIndex === -1) {
            console.error("Index de l'image cliquée non trouvé.");
            return;
        }

        console.log(`Image cliquée : Index ${currentIndex}, URL : ${images[currentIndex]}`);

        // Ouvrir la lightbox avec l'image correspondante
        openLightbox(images[currentIndex], link.getAttribute('data-photo-title'), link.getAttribute('data-photo-category'));
    });

    // Fonction pour ouvrir la lightbox
    function openLightbox(photoUrl, photoTitle, photoCategory) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const lightboxRef = document.getElementById('lightbox-ref');
        const lightboxCategory = document.getElementById('lightbox-category');

        if (!lightbox || !lightboxImage || !lightboxRef || !lightboxCategory) {
            console.error("La lightbox ou ses éléments ne sont pas présents dans le DOM.");
            return;
        }

        lightboxImage.src = photoUrl;
        lightboxRef.textContent = photoTitle || "Référence non disponible";
        lightboxCategory.textContent = photoCategory || "Catégorie non disponible";
        lightbox.style.display = 'flex';
        console.log("Lightbox ouverte avec l'image :", photoUrl);
    }

    // Gestion de la fermeture de la lightbox
    const closeBtn = document.querySelector('.closelightbox');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            const lightbox = document.getElementById('lightbox');
            if (lightbox) {
                lightbox.style.display = 'none';
                console.log("Lightbox fermée.");
            }
        });
    } else {
        console.error("Le bouton de fermeture .closelightbox n'a pas été trouvé.");
    }

    // Fonction pour gérer la navigation "Suivant"
    function goToNextImage() {
        if (currentIndex >= 0) {
            currentIndex = (currentIndex + 1) % images.length; // Passe à l'image suivante
            updateLightboxWithImage(currentIndex);
            console.log("Navigué vers l'image suivante : Index", currentIndex);
        }
    }

    // Fonction pour gérer la navigation "Précédent"
    function goToPreviousImage() {
        if (currentIndex >= 0) {
            currentIndex = (currentIndex - 1 + images.length) % images.length; // Passe à l'image précédente
            updateLightboxWithImage(currentIndex);
            console.log("Navigué vers l'image précédente : Index", currentIndex);
        }
    }

    // Mettre à jour la lightbox avec les informations de l'image correspondante
    function updateLightboxWithImage(index) {
        const photoUrl = images[index];
        const link = document.querySelectorAll('.lightbox-trigger')[index];
        const photoTitle = link ? link.getAttribute('data-photo-title') : "Référence non disponible";
        const photoCategory = link ? link.getAttribute('data-photo-category') : "Catégorie non disponible";

        // Ouvrir la lightbox avec les bonnes informations
        openLightbox(photoUrl, photoTitle, photoCategory);
    }

    // Gestion de la navigation "Suivant"
    const nextBtn = document.getElementById('next-linklight');
    if (nextBtn) {
        nextBtn.addEventListener('click', function(event) {
            event.preventDefault();
            goToNextImage();
        });
    } else {
        console.error("Le bouton 'Suivant' n'a pas été trouvé.");
    }

    // Gestion de la navigation "Précédent"
    const prevBtn = document.getElementById('prev-linklight');
    if (prevBtn) {
        prevBtn.addEventListener('click', function(event) {
            event.preventDefault();
            goToPreviousImage();
        });
    } else {
        console.error("Le bouton 'Précédent' n'a pas été trouvé.");
    }
});
