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
    $('#load-more').on('click', function() {
        let button = $(this);
        let page = button.data('page');
        let ajaxUrl = button.data('url');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                page: page + 1,
                action: 'load_more_photos'
            },
            success: function(response) {
                if (response.success) {
                    $('.photo-grid').append(response.data.content); 
                    button.data('page', page + 1);

                    // Vérifier si toutes les photos sont chargées
                    if (response.data.photos_loaded >= response.data.total_photos) {
                        button.hide();
                    }
                } else {
                    console.log('Pas de nouvelles photos à afficher.');
                    button.hide();
                }
            },
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

