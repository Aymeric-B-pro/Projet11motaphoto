document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM chargé et script prêt à s'exécuter.");

    // Sélectionner tous les éléments qui déclenchent la lightbox
    const imageLinks = document.querySelectorAll('.lightbox-trigger');
    console.log("Nombre de liens d'image trouvés :", imageLinks.length);

    if (imageLinks.length === 0) {
        console.warn("Aucun lien d'image trouvé. Vérifiez que les sélecteurs de liens sont corrects.");
        return;
    }

    // Créer un tableau pour stocker les URLs des images
    const images = [];

    // Itérer sur chaque élément pour ajouter les URLs dans le tableau
    imageLinks.forEach(link => {
        const photoUrl = link.getAttribute('data-photo-url');
        if (photoUrl) {
            images.push(photoUrl);
        }
    });

    console.log("Tableau des URLs d'image :", images);

    // Ajouter un événement de clic à chaque élément pour ouvrir la lightbox
    imageLinks.forEach((link, index) => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            console.log(`Image cliquée : Index ${index}, URL : ${images[index]}`);

            // Appeler la fonction pour ouvrir la lightbox avec l'URL de l'image
            openLightbox(images[index], link.getAttribute('data-photo-title'), link.getAttribute('data-photo-category'));
        });
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

    // Fermer la lightbox
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
});
