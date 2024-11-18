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

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM chargé");

    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxRef = document.getElementById('lightbox-ref');
    const lightboxCategory = document.getElementById('lightbox-category');

    let currentImageIndex = -1; // Indice de l'image actuelle
    let imagesData = []; // Tableau des données des images à afficher
    let selectedCategory = ''; // Catégorie sélectionnée pour filtrer les images

    // Sélectionner toutes les icônes de plein écran
    const fullscreenIcons = document.querySelectorAll('.lightbox-trigger');
    
    // Récupérer toutes les images et leurs informations
    fullscreenIcons.forEach((icon, index) => {
        const photoUrl = icon.getAttribute('data-photo-url');
        const photoTitle = icon.getAttribute('data-photo-title');
        const photoCategory = icon.getAttribute('data-photo-category');

        // Ajouter chaque image au tableau
        imagesData.push({
            photoUrl: photoUrl,
            photoTitle: photoTitle,
            photoCategory: photoCategory
        });

        // Ajouter un événement au clic pour ouvrir la lightbox
        icon.addEventListener('click', function(event) {
            event.preventDefault();
            // Ouvrir la lightbox avec l'image cliquée
            selectedCategory = photoCategory; // Stocker la catégorie sélectionnée
            openLightbox(index);
        });
    });

    // Fonction pour ouvrir la lightbox
    function openLightbox(index) {
        if (index >= 0 && index < imagesData.length) {
            const imageData = imagesData[index];

            // Vérifier si l'image est dans la catégorie sélectionnée
            if (selectedCategory && imageData.photoCategory !== selectedCategory) {
                return; // Si la catégorie ne correspond pas, on ne change pas l'image
            }

            lightboxImage.src = imageData.photoUrl;
            lightboxRef.textContent = imageData.photoTitle || "Référence non disponible";
            lightboxCategory.textContent = imageData.photoCategory || "Catégorie non disponible";
            lightbox.style.display = 'flex'; // Afficher la lightbox
            currentImageIndex = index; // Mettre à jour l'indice de l'image actuelle
        }
    }

    // Fonction pour fermer la lightbox
    const closeBtn = document.querySelector('.closelightbox');
    if (closeBtn) {
        closeBtn.onclick = function() {
            lightbox.style.display = 'none'; // Cacher la lightbox
        };
    }

    // Fonction pour afficher l'image précédente
    function showPreviousImage(event) {
        event.preventDefault();
        let prevIndex = currentImageIndex - 1;

        // Gérer le retour au début
        if (prevIndex < 0) {
            prevIndex = imagesData.length - 1; // Aller à la dernière image
        }

        // Trouver une image qui correspond à la catégorie sélectionnée
        while (imagesData[prevIndex].photoCategory !== selectedCategory) {
            prevIndex--;
            if (prevIndex < 0) {
                prevIndex = imagesData.length - 1; // Aller à la dernière image
            }
        }

        openLightbox(prevIndex);
    }

    // Fonction pour afficher l'image suivante
    function showNextImage(event) {
        event.preventDefault();
        let nextIndex = currentImageIndex + 1;

        // Gérer le retour à la fin
        if (nextIndex >= imagesData.length) {
            nextIndex = 0; // Aller à la première image
        }

        // Trouver une image qui correspond à la catégorie sélectionnée
        while (imagesData[nextIndex].photoCategory !== selectedCategory) {
            nextIndex++;
            if (nextIndex >= imagesData.length) {
                nextIndex = 0; // Retour à la première image
            }
        }

        openLightbox(nextIndex);
    }

    // Attacher les fonctions aux flèches de navigation (Précédente / Suivante)
    const prevLink = document.querySelector('.prev-linklight');
    const nextLink = document.querySelector('.next-linklight');
    
    if (prevLink) {
        prevLink.addEventListener('click', showPreviousImage);
    }

    if (nextLink) {
        nextLink.addEventListener('click', showNextImage);
    }
});