document.addEventListener('DOMContentLoaded', function() {
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementsByClassName('contactlink'); // Première occurrence de la classe 'myBtn'

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    Array.from(btn).forEach((el) => {
        el.onclick = function() {
            modal.style.display = "block";
        }
    });

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
} )

jQuery(document).ready(function($) {
    $.ajax({
        url: child_style_js.ajax_url, // Utilisation de l'URL injectée par wp_localize_script
        method: 'POST',
        data: {
            action: 'request_photos'
        },
        success: function(response) {
            if (response) {
                console.log('Photos:', response);
            } else {
                console.log('Aucune photo trouvée');
            }
        },
        error: function(error) {
            console.log('Erreur AJAX', error);
        }
    });
});

jQuery(document).ready(function($) {
    $('#load-more').on('click', function() {
        let button = $(this); // Le bouton "Charger plus"
        let page = button.data('page'); // Récupère la page actuelle
        let ajaxUrl = button.data('url'); // L'URL AJAX

        // Requête AJAX
        $.ajax({
            url: ajaxUrl, // URL vers admin-ajax.php
            type: 'POST',
            data: {
                action: 'load_more_photos', // Action définie dans WordPress pour récupérer les photos
                page: page, // Page actuelle
            },
            beforeSend: function() {
                button.text('Chargement...'); // Indique que le chargement est en cours
            },
            success: function(response) {
                if (response) {
                    // Insérer les nouvelles photos avant le bouton
                    $('#photo-gallery').append(response); 
                    
                    // Incrémente la page de 1 pour la prochaine requête
                    button.data('page', page + 1);

                    // Remettre le texte du bouton
                    button.text('Charger plus');
                } else {
                    // Si plus d'images, désactiver le bouton
                    button.text('Plus d\'images à charger');
                    button.prop('disabled', true); // Désactive le bouton
                }
            },
            error: function(error) {
                console.log('Erreur AJAX:', error);
                button.text('Erreur, réessayez');
            }
        });
    });
});

//Récupération Ref Photo
jQuery(document).ready(function($) {
    $('.contactlink').on('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut de l'ancre
        var refPhoto = $(this).data('ref-photo');
        $('input[name="your-subject"]').val(refPhoto);
        $('#myModal').fadeIn();
    });

    $('.close-button').on('click', function() {
        $('#myModal').fadeOut();
    });

    $(window).on('click', function(event) {
        if ($(event.target).is('#myModal')) {
            $('#myModal').fadeOut();
        }
    });
});

