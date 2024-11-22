document.addEventListener('DOMContentLoaded', function() {
    function getAllImageUrls() {
        const imageLinks = document.querySelectorAll('.lightbox-trigger');
        const images = [];
        imageLinks.forEach(link => {
            const photoUrl = link.getAttribute('data-photo-url');
            if (photoUrl) {
                images.push(photoUrl);
            }
        });
        return images;
    }

    let images = getAllImageUrls();
    let currentIndex = -1;

    document.addEventListener('click', function(event) {
        const link = event.target.closest('.lightbox-trigger');
        if (!link) return;

        event.preventDefault();
        images = getAllImageUrls();
        currentIndex = Array.from(document.querySelectorAll('.lightbox-trigger')).indexOf(link);

        if (currentIndex === -1) return;

        openLightbox(images[currentIndex], link.getAttribute('data-photo-title'), link.getAttribute('data-photo-category'));
    });

    function openLightbox(photoUrl, photoTitle, photoCategory) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const lightboxRef = document.getElementById('lightbox-ref');
        const lightboxCategory = document.getElementById('lightbox-category');

        if (!lightbox || !lightboxImage || !lightboxRef || !lightboxCategory) return;

        lightboxImage.src = photoUrl;
        lightboxRef.textContent = photoTitle || "Référence non disponible";
        lightboxCategory.textContent = photoCategory || "Catégorie non disponible";
        lightbox.style.display = 'flex';
    }

    const closeBtn = document.querySelector('.closelightbox');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            const lightbox = document.getElementById('lightbox');
            if (lightbox) {
                lightbox.style.display = 'none';
            }
        });
    }

    function goToNextImage() {
        if (currentIndex >= 0) {
            currentIndex = (currentIndex + 1) % images.length;
            updateLightboxWithImage(currentIndex);
        }
    }

    function goToPreviousImage() {
        if (currentIndex >= 0) {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateLightboxWithImage(currentIndex);
        }
    }

    function updateLightboxWithImage(index) {
        const photoUrl = images[index];
        const link = document.querySelectorAll('.lightbox-trigger')[index];
        const photoTitle = link ? link.getAttribute('data-photo-title') : "Référence non disponible";
        const photoCategory = link ? link.getAttribute('data-photo-category') : "Catégorie non disponible";

        openLightbox(photoUrl, photoTitle, photoCategory);
    }

    const nextBtn = document.getElementById('next-linklight');
    if (nextBtn) {
        nextBtn.addEventListener('click', function(event) {
            event.preventDefault();
            goToNextImage();
        });
    }

    const prevBtn = document.getElementById('prev-linklight');
    if (prevBtn) {
        prevBtn.addEventListener('click', function(event) {
            event.preventDefault();
            goToPreviousImage();
        });
    }
});