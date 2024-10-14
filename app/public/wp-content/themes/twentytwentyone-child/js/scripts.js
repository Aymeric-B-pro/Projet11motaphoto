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

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#ajax_call').addEventListener('click', function() {
        let formData = new FormData();
        formData.append('action', 'request_photos');
        // Exécute l'appel AJAX
        fetch(child_style_js.ajax_url, {
            method: 'POST',
            body: formData,
        }).then(function(response) {
            if (!response.ok) {
                throw new Error('Network response error.');
            }

            return response.json();
        }).then(function(data) {
            data.forEach(function(photo) {
                // Insère chaque photo avec un élément <img>
                document.querySelector('#ajax_return').insertAdjacentHTML('beforeend', 
                    '<div class="col-12 mb-5">' + 
                    '<img src="' + photo.guid + '" alt="' + photo.post_title + '" />' + 
                    '<h3>' + photo.post_title + '</h3>' +
                    '</div>'
                );
            });
        }).catch(function(error) {
            console.error('There was a problem with the fetch operation: ', error);
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

